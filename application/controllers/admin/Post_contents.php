<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Post_contents extends Admin_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('post_content_model');
		$this->load->model('Tasks_model');
		$this->load->model('projects_model');
		$this->load->model('contents_model');
		$this->load->model('AccessToken_model');
	}
	/* List all contents */
	public function index()
	{
		$data['title'] = _l('post_contents');
		$this->load->view('admin/post_contents/manage', $data);
	}
	public function table($clientid = '')
	{
		if (!has_permission('post_contents', '', '') && !has_permission('post_contents', '', '')) {
			ajax_access_denied();
		}
		$idstaff = $this->db->get('tblstaff')->result_array();
		$idtask = $this->db->get('tblstafftasks')->result_array();
		$project = $this->db->get('tblprojects')->result_array();
		$id  = $GLOBALS['current_user']->staffid;
		$this->app->get_table_data('post_contents', [
			'clientid' => $clientid, 'ids' => $idtask, 'staff' => $idstaff,'id'=>$id
		]);
	}
	public function update_token()
	{
		if (!empty($_POST['token'])) {
			$curToken = $this->AccessToken_model->getCurrentToken();
			if ($_POST['token'] == $curToken->token) {
				set_alert('success', 'Please Check New Token Again ', _l('content'));
			} else {
				$dataCur = array(
					'status' => 1
				);
				$update = $this->AccessToken_model->update($curToken->id, $dataCur);
				if ($update) {
					$success = $this->AccessToken_model->add($_POST['token']);
					if ($success) {
						set_alert('success', _l('successfully', _l('content')));
					} else {
						set_alert('success', _l('fail', _l('content')));
					}
				}
			}
		} else {
			set_alert('success', _l('posted_successfully', _l('content')));
		}
	}
	public function view($id)
	{
		$content = $this->contents_model->get($id);
		$post_id = $content->post_id;
		$tokenGet = $this->AccessToken_model->getCurrentToken();
		$user_access_token = $tokenGet->token;

		if ($post_id) {
			//Get access token page
			$arr = ["LIKE", "LOVE", "HAHA", "SAD", "ANGRY", "WOW",];
			$arr2 = ["comments", "shares",];
			$data       = array();
			$method     = "GET";
			$dataReaction = array();
			$dataCommentShare = array();
			$check = false;
			$total = 0;
			//GET REACTIONS
			for ($i = 0; $i < 6; $i++) {
				$url = "https://graph.facebook.com/" . $post_id . '?fields=reactions.type(' . $arr[$i] . ').limit(0).summary(total_count)&access_token=' . $user_access_token;
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
				$query = http_build_query($data);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
				$result = curl_exec($ch);
				$checkAccessToken  = json_decode($result, true);
				if (empty($checkAccessToken["reactions"])) {
					$check = true;
					break;
				}
				array_push($dataReaction, $checkAccessToken["reactions"]["summary"]["total_count"]);
				$total += $dataReaction[$i];
				
			}
			//GET COMMENTS & SHARES
			for ($y = 0; $y < 2; $y++) {
				if ($y == 0) {
					$url = "https://graph.facebook.com/" . $post_id . '?fields=' . $arr2[$y] . '.summary(total_count)&access_token=' . $user_access_token;
				} else {
					$url = "https://graph.facebook.com/" . $post_id . '?fields=' . $arr2[$y] . '&access_token=' . $user_access_token;
				}
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
				$query = http_build_query($data);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
				$result = curl_exec($ch);
				$checkAccessToken  = json_decode($result, true);
				if (empty($checkAccessToken["comments"])) {
					break;
				}
				if ($y == 0) {
					array_push($dataCommentShare, $checkAccessToken["comments"]["summary"]["total_count"]);
				} else {
					array_push($dataCommentShare, $checkAccessToken["shares"]["count"]);
				}
			}
			$data['like'] = $dataReaction[0];
			$data['love'] = $dataReaction[1];
			$data['haha'] = $dataReaction[2];
			$data['sad'] = $dataReaction[3];
			$data['angry'] = $dataReaction[4];
			$data['wow'] = $dataReaction[5];
			$data['total_reaction'] = $total;
			$data['comments'] = $dataCommentShare[0];
			$data['shares'] = $dataCommentShare[1];
			$data['total'] = $total + $data['comments'] + $data['shares'];
			if ($check) {
				set_alert('success', _l('get_token_to_update_infor', _l('content')));
			}
		}
		$staffTask = $this->db->get('tblstafftasks')->result_array();
		$data['staffTask'] = $staffTask;
		$staffInfo = $this->db->get('tblstaff')->result_array();
		$data['staffInfo'] = $staffInfo;
		$projectid = $this->db->get('tblprojects')->result_array();
		$data['projectid'] = $projectid;
		$file_id = $content->file_id;
		$data['attachments'] = $this->contents_model->get_content_attachments($id, $file_id);
		$data['file_name'] = $data['attachments']->file_name;
		$data['id_content'] = $content->id;
		$data['content'] = $content;
		$data['title'] = $content->subject;
		$hostname = $this->db->hostname;
		$username = $this->db->username;
		$password = $this->db->password;
		$database = $this->db->database;
		$conn = mysqli_connect($hostname, $username, $password, $database);
		$conn->set_charset('utf8mb4');
		$record_set = array();
		$sql = "SELECT description FROM tblcontents WHERE id = " . $id;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				array_push($record_set, $row);
			}
		}
		$data['jsonData'] =  json_encode($record_set);

		$task = $this->tasks_model->get($content->task_title);
		if ($task->rel_type == "project") {
			$project = $this->projects_model->get($task->rel_id);
			$data['fanpage_id'] = $project->fanpage_id;
			$data['link_fanpage'] = $project->link_page;
			$data['fanpage_name'] = $project->fanpage_name;
		}
		//GET PUBLISHED TIME
		if(empty($content->publish_time)){
		$url = "https://graph.facebook.com/" . $post_id . '?access_token=' . $user_access_token;
		$ch = curl_init();
		$method = "GET";
		$data1 = array();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		$query = http_build_query($data1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
		$result = curl_exec($ch);
		$checkAccessToken  = json_decode($result, true);
		$data['publish_time'] =  date_format(date_create($checkAccessToken['created_time']),"d-m-Y H:i:s");
		$dataUpdate = array(
			'publish_time' => $data['publish_time']
		);
		$this->db->where('id', $id);
		$this->db->update('tblcontents', $dataUpdate);
		}
		else{
		$data['publish_time'] = $content->publish_time;
		}

		$data['graph_link_page'] = "https://graph.facebook.com/v3.2/" . $project->fanpage_id;
		$this->load->view('admin/post_contents/view', $data);
	}
	
	public function post_content()
	{
		$success = false;
		$message = '';
		if (!empty($_POST['id_page'])) {
			$id = $_POST['id'];
			$id_page = $_POST['id_page'];
			$tokenGet = $this->AccessToken_model->getCurrentToken();
			$user_access_token = $tokenGet->token;
			$caption = $_POST['description'];
			$urlPhoto = $_POST['urlPhoto'];
			$endpoint   = $id_page . "?fields=access_token,id,name&access_token=" . $user_access_token;
			//Get access token page
			$url        = "https://graph.facebook.com/" . $endpoint;
			$data       = array();
			$method     = "GET";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
			$query = http_build_query($data);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
			$result = curl_exec($ch);
			//Check Access Token
			$checkAccessToken  = json_decode($result, true);
			if ($checkAccessToken['access_token']) {
				//POST content
				$tab                = json_decode($result, true);
				$page_access_token  = $tab["access_token"];
				$endpoint1              = "photos";
				$url1                   = "https://graph.facebook.com/" . $id_page . "/" . $endpoint1;
				$data["caption"]        = $caption;
				$data["url"]            = $urlPhoto;
				$data["access_token"]   = $page_access_token;
				$method1                = "POST";
				$ch1 = curl_init();
				curl_setopt($ch1, CURLOPT_URL, $url1);
				curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, $method1);
				$query1 = http_build_query($data);
				curl_setopt($ch1, CURLOPT_POSTFIELDS, $query1);
				$result1 = curl_exec($ch1);
				$checkImage  = json_decode($result1, true);
				if ($checkImage['post_id']) {
					$data = array(
						'status' => 5,
						'post_id' => $checkImage['post_id']
					);
					$this->db->where('id', $id);
					$success = $this->db->update('tblcontents', $data);
					if ($success) {
						set_alert('success', _l('posted_successfully', _l('content')));
						echo json_encode([
							'success' => $success,
							'message' => $message,
						]);
					}
				} else {
					echo json_encode([
						'success' => $success,
						'message' => $message,
					]);
					set_alert('success', _l('check_content_infor_again', _l('content')));
					$id = $this->contents_model->add(null);
				}
			} else {
				echo json_encode([
					'success' => $success,
					'message' => $message,
				]);
				set_alert('success', _l('add_new_token', _l('content')));
				$id = $this->contents_model->add(null);
			}
		} else {
			set_alert('danger', _l('error_page_id', _l('project')));
			$id = $this->contents_model->add(null);
		}
	}
}
