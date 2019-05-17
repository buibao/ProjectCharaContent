<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Post_content_model extends CRM_Model {
	public function __construct() {
		parent::__construct();

	}
	public function getDatabase() {
		$this->db->select('*');
		$ketqua = $this->db->get('tblcontents');
		//chuyen $ketqua thanh mang
		$ketqua = $ketqua->result_array();
		return $ketqua;
		// echo "<pre>";
		// var_dump($ketqua);// in ra
	}

	/**
	 * Get content/s
	 * @param  mixed  $id         contract id
	 * @param  array   $where      perform where
	 * @param  boolean $for_editor if for editor is false will replace the field if not will not replace
	 * @return mixed
	 */

	// public function get($id )
	// {
	//         $this->db->where('tblcontents.id', $id);
	//         $content = $this->db->get('tblcontents')->row();
	//         return $content;
	// }
	public function getAllContent($id) {
		$this->db->where('id', $id);

		return $this->db->get('tblcontents')->row();
	}
	public function get_task_json($task_id = '') {
		$this->db->select("*");
		$this->db->from('tblstafftasks');
		$this->db->where('id', $task_id);

		$query = $this->db->get();

		$resp = $query->result();
		return json_encode($resp);
	}
	public function get_status_name_by_id($id){
		
	}
	public function get($id = '', $where = [], $for_editor = false) {

		if (is_numeric($id)) {
			$this->db->where('tblcontents.id', $id);
			$content = $this->db->get('tblcontents')->row();
			if ($content) {
				$content->attachments = $this->get_content_attachments('', $content->id);
				if ($for_editor == false) {
					$merge_fields = [];
					$merge_fields = array_merge($merge_fields, get_content_merge_fields($id));
					$merge_fields = array_merge($merge_fields, get_client_contact_merge_fields($content->client));
					$merge_fields = array_merge($merge_fields, get_other_merge_fields());
					foreach ($merge_fields as $key => $val) {
						if (stripos($content->content, $key) !== false) {
							$content->content = str_ireplace($key, $val, $content->content);
						} else {
							$content->content = str_ireplace($key, '', $content->content);
						}
					}
				}
			}

			return $content;
		}
		$contents = $this->db->get('tblcontents')->result_array();
		$i = 0;
		foreach ($contents as $content) {
			$contents[$i]['attachments'] = $this->get_content_attachments('', $content['id']);
			$i++;
		}

		return $contents;
	}
	public function get_contents_years() {
		return $this->db->query('SELECT DISTINCT(YEAR(start_date)) as year FROM tblcontents')->result_array();
	}

	/**
	 * @param  integer ID
	 * @return object
	 * Retrieve contract attachments from database
	 */
	public function get_content_attachments($attachment_id = '', $id = '') {
		if (is_numeric($attachment_id)) {
			$this->db->where('id', $attachment_id);

			return $this->db->get('tblfiles')->row();
		}
		$this->db->order_by('dateadded', 'desc');
		$this->db->where('rel_id', $id);
		$this->db->where('rel_type', 'content');

		return $this->db->get('tblfiles')->result_array();
	}

	/**
	 * @param   array $_POST data
	 * @return  integer Insert ID
	 * Add new content
	 */
	public function add($data) {
		if (isset($data['status']) && ($data['status'] == 1 || $data['status'] === 'on')) {
			$data['status'] = 1;
		} else {
			$data['status'] = 2;
		}

		$data['hash'] = app_generate_hash();
		$this->db->insert('tblcontents', $data);
		$insert_id = $this->db->insert_id();
		if ($insert_id) {
			if (isset($custom_fields)) {
				handle_custom_fields_post($insert_id, $custom_fields);
			}
			do_action('after_contract_added', $insert_id);
			logActivity('New Contract Added [' . $data['subject'] . ']');

			return $insert_id;
		}

		return false;
	}

	/**
	 * @param  array $_POST data
	 * @param  integer Contract ID
	 * @return boolean
	 * Update content
	 */
	public function update($data, $id) {

		if (isset($data['status']) && ($data['status'] == 1 || $data['status'] === 'on')) {
			$data['status'] = 1;
		} else {
			$data['status'] = 2;
		}

		$_data = do_action('before_content_updated', [
			'data' => $data,
			'id' => $id,
		]);
		$this->db->where('id', $id);
		$this->db->update('tblcontents', $data);
		if ($this->db->affected_rows() > 0) {
			do_action('after_content_updated', $id);
			logActivity('Content Updated [' . $data['subject'] . ']');
			return true;
		}
		return false;
	}
	/**
	 * @param  integer ID
	 * @return boolean
	 * Delete content
	 */
	public function delete($id) {
		do_action('before_contract_deleted', $id);

		$this->db->where('id', $id);
		$this->db->delete('tblcontents');

		return true;
	}
	function search($keyword) {
		$this->db->like('subject', $keyword);
		$query = $this->db->get('tblcontents');
		$query = $query->result_array();
		return $query;
	}
	public function get_post_content_statuses() {
		$statuses = [
			[
				'id' => 1,
				'color' => '#03a9f4',
				'name' => _l('draft'),
				'order' => 0,
				'filter_default' => true,
			],
			[
				'id' => 2,
				'color' => '#84c529',
				'name' => _l('waiting_for_leader'),
				'order' => 1,
				'filter_default' => true,
			],
			[
				'id' => 3,
				'color' => '#FFA500',
				'name' => _l('waiting_for_customer'),
				'order' => 2,
				'filter_default' => false,
			],
			[
				'id' => 4,
				'color' => '#ff0000',
				'name' => _l('approvedcontent'),
				'order' => 2,
				'filter_default' => false,
			],
			[
				'id' => 5,
				'color' => '#ff0000',
				'name' => _l('content_posted'),
				'order' => 2,
				'filter_default' => false,
			],
		];

		return do_action('before_get_credit_notes_statuses', $statuses);
	}

	public function update_status($id) {

		$this->db->where('id', $id);
		$this->db->update('tblcontents', ['status' => 5]);
		return true;
	}

}
