<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Post_contents extends Admin_controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('post_content_model');
		$this->load->model('Tasks_model');
		$this->load->model('projects_model');
		$this->load->model('contents_model');
	}

	/* List all contents */
	public function index() {
		$data['title'] = _l('post_contents');
		$this->load->view('admin/post_contents/manage', $data);
	}

	public function table($clientid = '') {
		if (!has_permission('post_contents', '', '') && !has_permission('post_contents', '', '')) {
			ajax_access_denied();
		}

		$idtask = $this->db->get('tblstafftasks')->result_array();
		$this->app->get_table_data('post_contents', [
			'clientid' => $clientid, 'ids' => $idtask,
		]);

    }
    


    public function view($id) {
		if ($this->input->post()) {
			$action = $this->input->post('action');
			switch ($action) {
			case 'approval0':
				redirect(admin_url('contents'));
				break;
			case 'approval1':
				$this->db->where('id', $id);
				$this->db->update('tblcontents', [
					'status' => 1,
				]);
				set_alert('success', _l('saved_draft'));
				redirect(admin_url('contents'));
				break;
			case 'approval2':
				$this->db->where('id', $id);
				$this->db->update('tblcontents', [
					'status' => 2,
				]);
				set_alert('success', _l('sent_to_leader'));
				redirect(admin_url('contents'));
				break;
			}

		}
		$content = $this->contents_model->get($id);

		//fix show name task title and assignto
		$staffTask = $this->db->get('tblstafftasks')->result_array();
		$data['staffTask'] = $staffTask;
		$staffInfo = $this->db->get('tblstaff')->result_array();
		$data['staffInfo'] = $staffInfo;
		$projectid = $this->db->get('tblprojects')->result_array();
		$data['projectid'] = $projectid;
		$file_id = $content->file_id;
		$data['attachments'] = $this->contents_model->get_content_attachments($id,$file_id);
		$data['id_content'] = $content->id;
		$data['content'] = $content;
        $data['title'] = $content->subject;
        $task = $this->tasks_model->get($content->task_title);

		if($task->rel_type == "project")
        {
		$project = $this->projects_model->get($task->rel_id);
		$data['fanpage_id'] = $project->fanpage_id;
		$data['link_fanpage'] = $project->link_page;
		}
		$this->load->view('admin/post_contents/view', $data);
	}
	
	public function post_content(){
    $success = false;
    $message = '';

    if(!empty($_POST['id_page']))
    {
        $id = $_POST['id'];
        $id_page = $_POST['id_page'];
        $user_access_token = $_POST['user_access_token'];
        $caption = $_POST['description'];
        $urlPhoto = $_POST['urlPhoto'];
        $endpoint   = $id_page."?fields=access_token,id,name&access_token=".$user_access_token;
        //Get access token page
        $url        = "https://graph.facebook.com/".$endpoint;
        $data       = array();
        $method     = "GET";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER , true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        $query = http_build_query($data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        $result = curl_exec($ch);
        print $result;
        //POST content
        $tab                = json_decode($result, true);
        $page_access_token  = $tab["access_token"];
        $endpoint1              = "photos";
        $url1                   = "https://graph.facebook.com/".$id_page."/".$endpoint1;
        $data["caption"]        = $caption;
        $data["url"]            = $urlPhoto;
        $data["access_token"]   = $page_access_token;
        $method1                = "POST";
        $ch1 = curl_init();
        curl_setopt($ch1, CURLOPT_URL, $url1);
        curl_setopt($ch1,CURLOPT_RETURNTRANSFER , true);
        curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER , false);
        curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, $method1);
        $query1 = http_build_query($data);
        curl_setopt($ch1, CURLOPT_POSTFIELDS, $query1);
        $result1 = curl_exec($ch1);
        $data = array(
               'status' => 5              
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
    }
    else{
    	set_alert('danger', _l('error_page_id', _l('project')));
        $id = $this->contents_model->add(null);
    }
 }

}
