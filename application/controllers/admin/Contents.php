<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Contents extends Admin_controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('contents_model');
		$this->load->model('tasks_model');
	}

	/* List all contents */
	public function index() {
		$data['title'] = _l('contents');
		$this->load->view('admin/contents/manage', $data);

	}
	/* Edit contract or add new contract */
	public function content($id = '') {
		$overview = [];
		unset($overview[0]);
		$overview = ['staff_id' => $staff_id, 'detailed' => $overview,
		];

		$data['tasksCustom'] = $this->tasks_model->get_user_tasks_assigned();

		if ($this->input->post()) {
			if ($id == '') {
				if (!has_permission('contents', '', 'create')) {
					access_denied('contents');
				}


				$id = $this->contents_model->add($this->input->post());
				if ($id->id) {
					$uploadedFiles = handle_content_attachments_array($id->id);
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($id->id, 'content', [$file]);
                        }
					}
					set_alert('success', _l('added_successfully', _l('content')));
					// redirect(admin_url('contents'));
					redirect(admin_url('contents'));
				}
			}
			// update
			else {
				if (!has_permission('contents', '', 'edit')) {
					access_denied('contents');
				}
				$success = $this->contents_model->update($this->input->post(), $id);
				if ($success) {
					$uploadedFiles = handle_content_attachments_array($id);
                    if ($uploadedFiles && is_array($uploadedFiles)) {
                        foreach ($uploadedFiles as $file) {
                            $this->misc_model->add_attachment_to_database($id, 'content', [$file]);
                        }
					}
					set_alert('success', _l('updated_successfully', _l('content')));
				}
				redirect(admin_url('contents'));
				// redirect(admin_url('contents/content/' . $id));
			}

			//end update
		}
		$data['content'] = $this->contents_model->get($id, [], true);
		$content_merge_fields = get_available_merge_fields();
		$_content_merge_fields = [];
		foreach ($content_merge_fields as $key => $val) {
			foreach ($val as $type => $f) {
				if ($type == 'content') {
					foreach ($f as $available) {
						foreach ($available['available'] as $av) {
							if ($av == 'content') {
								array_push($_content_merge_fields, $f);

								break;
							}
						}

						break;
					}
				} elseif ($type == 'other') {
					array_push($_content_merge_fields, $f);
				} elseif ($type == 'clients') {
					array_push($_content_merge_fields, $f);
				}
			}
		}
		
		$hostname = $this->db->hostname;
		$username = $this->db->username;
		$password = $this->db->password;
		$database = $this->db->database;
		$conn = mysqli_connect($hostname,$username,$password,$database);
		$conn->set_charset('utf8mb4');
		$record_set = array();
		$sql = "SELECT description FROM tblcontents WHERE id = " . $id;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
    	while($row = $result->fetch_assoc()) {
        array_push($record_set, $row);
          }
        }
        $data['jsonData'] =  json_encode($record_set);
		
	
		// json get staff task
		// $task_id = $this->input->get("task_id");
		// $data['json'] = $this->contents->get_task_json($task_id);
		// end json get staff task
		$file_id = $data['content']->file_id;
		$data['id_content'] = $data['content']->id;
		$data['attachments'] = $this->contents_model->get_content_attachments($id, $file_id);
		$data['file_name'] = $data['attachments']->file_name;
		$data['staffid'] = $data['attachments']->staffid;
		$data['id_file'] = $data['attachments']->id;
		$data['dateadded'] = $data['attachments']->dateadded;
		$data['external'] = $data['attachments']->external;
		$data['filetype'] = $data['attachments']->filetype;
		$data['thumbnail_link'] = $data['attachments']->thumbnail_link;
		$data['contact_id'] = $data['attachments']->contact_id;
		// $data['id'] = $data['attachments']->id;
		// $data['id'] = $data['attachments']->id;
		// $data['id'] = $data['attachments']->id;
		// $data['id'] = $data['attachments']->id;

		$data['content_merge_fields'] = $_content_merge_fields;
		$title = $data['content']->subject;
		$data['title'] = $title;
		// $data['title']         = _l('new_content');
		$data['bodyclass'] = 'content';
		$this->load->view('admin/contents/content', $data);
	}
	public function get_task_json() {
		$task_id = $this->input->get("task_id");
		// $data['json'] = $this->contents_model->get_task_json($task_id);
		header('Content-Type: application/json;charset=utf-8');
		echo $this->contents_model->get_task_json($task_id);
	}
	// public function get_task_json() {
	// 	$this->db->select("*");
	// 	$this->db->from('tblstafftasks');
	// 	$query = $this->db->get();

	// 	foreach ($query->result() as $row) {
	// 		echo json_encode($row);
	// 	}
	// }

	public function table($clientid = '') {
		if (!has_permission('contents', '', 'view') && !has_permission('contents', '', 'view_own')) {
			ajax_access_denied();
		}
		// FIX
		$idstaff = $this->db->get('tblstaff')->result_array();
		$idtask = $this->db->get('tblstafftasks')->result_array();
		$project = $this->db->get('tblprojects')->result_array();
		$id  = $GLOBALS['current_user']->staffid;

		$this->app->get_table_data('contents', [
			'clientid' => $clientid, 'ids' => $idtask, 'staff' => $idstaff,'id'=>$id
		]);
		// END FIX

	}

	/* Delete content from database */
	public function delete($id) {
		if (!has_permission('contents', '', 'delete')) {
			access_denied('contents');
		}
		if (!$id) {
			redirect(admin_url('contents'));
		}
		$response = $this->contents_model->delete($id);
		if ($response == true) {
			set_alert('success', _l('deleted', _l('content')));
		} else {
			set_alert('warning', _l('problem_deleting', _l('contract_lowercase')));
		}
		if (strpos($_SERVER['HTTP_REFERER'], 'clients/') !== false) {
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect(admin_url('contents'));
		}
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
		$hostname = $this->db->hostname;
		$username = $this->db->username;
		$password = $this->db->password;
		$database = $this->db->database;
		$conn = mysqli_connect($hostname,$username,$password,$database);
		$conn->set_charset('utf8mb4');
		$record_set = array();
		$sql = "SELECT description FROM tblcontents WHERE id = " . $id;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
    	while($row = $result->fetch_assoc()) {
        array_push($record_set, $row);
          }
        }
        $data['jsonData'] =  json_encode($record_set);
		$content = $this->contents_model->get($id);
		//fix show name task title and assignto
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

		$task = $this->tasks_model->get($content->task_title);
		if ($task->rel_type == "project") {
				$project = $this->projects_model->get($task->rel_id);
				$data['fanpage_id'] = $project->fanpage_id;
				$data['link_fanpage'] = $project->link_page;
				$data['fanpage_name'] = $project->fanpage_name;
			}
		$this->load->view('admin/contents/view', $data);
	}
	public function remove_content_attachment()
    {
			$id = $_POST['id'];
			$success = $this->contents_model->remove_content_attachment($id);
			echo json_encode([
								'success' => $success,
								
							]);
        
    }
}
