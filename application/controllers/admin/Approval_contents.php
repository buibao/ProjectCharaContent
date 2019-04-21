<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Approval_contents extends Admin_controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('contents_model');
	}

	/* List all contents */
	public function index() {
		$data['title'] = _l('approvecontent');
		$this->load->view('admin/approval_contents/manage', $data);
	}

	public function table($clientid = '') {
		if (!has_permission('approval_contents', '', 'view') && !has_permission('approval_contents', '', 'view_own')) {
			ajax_access_denied();
		}
		$idstaff = $this->db->get('tblstaff')->result_array();
		$idtask = $this->db->get('tblstafftasks')->result_array();
		$project = $this->db->get('tblprojects')->result_array();
		$this->app->get_table_data('approval_contents', [
			'clientid' => $clientid, 'ids' => $idtask, 'staff' => $idstaff, 'project_id' => $project,
		]);

	}
	public function view($id) {
		if ($this->input->post()) {
			$action = $this->input->post('action');
			switch ($action) {
			case 'approval3':
				$this->db->where('id', $id);
				$this->db->update('tblcontents', [
					'status' => 3,
				]);
				set_alert('success', _l('approve_and_send_to_customer'));
				redirect(admin_url('approval_contents'));

				break;
			case 'approval1':
				$this->db->where('id', $id);
				$this->db->update('tblcontents', [
					'status' => 1,
				]);
				set_alert('success', _l('not_approve_and_resubmited_to_writer'));
				redirect(admin_url('approval_contents'));
				break;
			}

		}

		$content = $this->contents_model->get($id);

		// fix show name for task title and assignto
		$staffTask = $this->db->get('tblstafftasks')->result_array();
		$data['staffTask'] = $staffTask;
		$staffInfo = $this->db->get('tblstaff')->result_array();
		$data['staffInfo'] = $staffInfo;
		$projectid = $this->db->get('tblprojects')->result_array();
		$data['projectid'] = $projectid;

		$data['content'] = $content;
		$data['title'] = $content->subject;
		$this->load->view('admin/approval_contents/view', $data);
	}
	public function approval_content($id = '') {
		$overview = [];
		unset($overview[0]);
		$overview = ['staff_id' => $staff_id, 'detailed' => $overview,
		];

		$data['tasksCustom'] = $this->tasks_model->get_user_tasks_assigned();

		if ($this->input->post()) {
			if ($id == '') {
				if (!has_permission('approval_contents', '', 'create')) {
					access_denied('approval_contents');
				}
				$id = $this->approval_content_model->add($this->input->post());
				if ($id) {
					set_alert('success', _l('added_successfully', _l('content')));
					// redirect(admin_url('contents'));
					redirect(admin_url('approval_contents'));
				}
			}
			// update
			else {
				if (!has_permission('approval_contents', '', 'edit')) {
					access_denied('approval_contents');
				}
				$success = $this->approval_content_model->update($this->input->post(), $id);
				if ($success) {
					set_alert('success', _l('updated_successfully', _l('content')));
				}
				redirect(admin_url('approval_content_model'));
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
		$data['content_merge_fields'] = $_content_merge_fields;
		$title = $data['content']->subject;

		$data['title'] = $title;
		// $data['title']         = _l('new_content');
		$data['bodyclass'] = 'content';
		$this->load->view('admin/approval_contents/content', $data);
	}
}
