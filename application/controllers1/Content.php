<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Content extends Clients_controller
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

    public function index($id, $hash)
    {
        $content = $this->contents_model->get($id);
        if ($this->input->post()) {
            $action = $this->input->post('action');

            switch ($action) {
                case 'approval4':
                    $this->db->where('id', $id);
                    $this->db->update('tblcontents', [
                        'status' => 4,
                    ]);
                    set_alert('success', _l('approvedcontent'));
                    redirect(site_url('clients/contents'));
            
                    break;
                case 'approval1':
                    $this->db->where('id', $id);
                    $this->db->update('tblcontents', [
                        'status' => 1,
                    ]);
                    set_alert('success', _l('not_approve_and_resubmited_to_writer'));
                    redirect(site_url('clients/contents'));
            
                    break;
                }
        }
        // $this->use_footer     = false;
        $this->use_navigation = false;
        $this->use_submenu    = false;
        $data['content']  = do_action('content_html_pdf_data', $content);
		$post_id = $content->post_id;
		$tokenGet = $this->AccessToken_model->getCurrentToken();
		$user_access_token = $tokenGet->token;
	
		if($post_id){
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
			if(empty($checkAccessToken)){
				break;
				}
			array_push($dataReaction, $checkAccessToken["reactions"]["summary"]["total_count"]);
			$total += $dataReaction[$i];
			$check = true;
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
			if(empty($checkAccessToken)){
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
		if(!$check){
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
        $this->data                = $data;
        $this->view = 'contenthtml';
        $this->layout();
    }
}
