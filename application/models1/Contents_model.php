<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Contents_model extends CRM_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function getDatabase()
	{
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
	public function getAllContent($id)
	{
		$this->db->where('id', $id);

		return $this->db->get('tblcontents')->row();
	}
	public function get_task_json($task_id = '')
	{
		$this->db->select("*");
		$this->db->from('tblstafftasks');
		$this->db->where('id', $task_id);

		$query = $this->db->get();

		$resp = $query->result();
		return json_encode($resp);
	}
	public function get($id = '', $where = [], $for_editor = false)
	{

		if (is_numeric($id)) {
			// $this->db->where('tblcontents.id', $id);
			// $content = $this->db->get('tblcontents')->row();
			// if ($content) {
			// 	$content->attachments = $this->get_content_attachments('', $content->id);
			// 	if ($for_editor == false) {
			// 		$merge_fields = [];
			// 		$merge_fields = array_merge($merge_fields, get_content_merge_fields($id));
			// 		$merge_fields = array_merge($merge_fields, get_client_contact_merge_fields($content->client));
			// 		$merge_fields = array_merge($merge_fields, get_other_merge_fields());
			// 		foreach ($merge_fields as $key => $val) {
			// 			if (stripos($content->content, $key) !== false) {
			// 				$content->content = str_ireplace($key, $val, $content->content);
			// 			} else {
			// 				$content->content = str_ireplace($key, '', $content->content);
			// 			}
			// 		}
			// 	}
			// }

			// return $content;
			$this->db->where('tblcontents.id', $id);
			$content = $this->db->get('tblcontents')->row();
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
	public function get_contents_years()
	{
		return $this->db->query('SELECT DISTINCT(YEAR(start_date)) as year FROM tblcontents')->result_array();
	}

	/**
	 * @param  integer ID
	 * @return object
	 * Retrieve contract attachments from database
	 */
	public function get_content_attachments($id, $attachment_id)
	{
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
	public function add($data)
	{
		if (isset($data['status']) && ($data['status'] == 1 || $data['status'] === 'on')) {
			$status = 1;
		} else {
			$status = 2;
		}

		$hostname = $this->db->hostname;
		$username = $this->db->username;
		$password = $this->db->password;
		$database = $this->db->database;
		$conn = mysqli_connect($hostname, $username, $password, $database);
		$conn->set_charset('utf8mb4');
		$comment = isset($data['description']) ? trim($data['description']) : "";
		$subject = isset($data['subject']) ? $data['subject'] : "";
		$task_title = isset($data['task_title']) ? $data['task_title'] : "";
		$hash = app_generate_hash();
		$datestart = isset($data['datestart']) ? $data['datestart'] : "";
		$dateend = isset($data['dateend']) ? $data['dateend'] : "";
		$projectId = isset($data['project_id']) ? $data['project_id'] : "";
		
		$query = "INSERT INTO tblcontents(subject,task_title,description,status,assignto,hash,datestart,dateend,project_id) VALUES (?,?,?,?,?,?,?,?,?)";
		
		$assignto = $GLOBALS['current_user']->staffid;
		$sql_stmt = $conn->prepare($query);
		// d = number -- s = string
		$param_type = "sssssssss";
		$param_value_array = array(
			$subject,
			$task_title,
			$comment,
			$status,
			$assignto,
			$hash,
			$datestart,
			$dateend,
			$projectId
		);
		$param_value_reference[] = &$param_type;
		for ($i = 0; $i < count($param_value_array); $i++) {
			$param_value_reference[] = &$param_value_array[$i];
		}
		call_user_func_array(array(
			$sql_stmt,
			'bind_param'
		), $param_value_reference);

		$sql_stmt->execute();
		logActivity('New Content Added [' . $subject . ']');
		$last = $this->db->order_by('id',"desc")
		->limit(1)
		->get('tblcontents')
		->row();
		return $last;
	}

	/**
	 * @param  array $_POST data
	 * @param  integer Contract ID
	 * @return boolean
	 * Update content
	 */
	public function update($data, $id)
	{
		if (isset($data['status']) && ($data['status'] == 1 || $data['status'] === 'on')) {
			$status = 1;
		} else {
			$status = 2;
		}

		$hostname = $this->db->hostname;
		$username = $this->db->username;
		$password = $this->db->password;
		$database = $this->db->database;
		$conn = mysqli_connect($hostname, $username, $password, $database);
		$conn->set_charset('utf8mb4');
		$comment = isset($data['description']) ? trim($data['description']) : "";
		$subject = isset($data['subject']) ? $data['subject'] : "";
		$task_title = isset($data['task_title']) ? $data['task_title'] : "";
		$hash = app_generate_hash();
		$datestart = isset($data['datestart']) ? $data['datestart'] : "";
		$dateend = isset($data['dateend']) ? $data['dateend'] : "";
		$status =   $data['status'];
		$projectId = isset($data['project_id']) ? $data['project_id'] : "";
		$query = "UPDATE tblcontents SET subject = ?,task_title = ?, datestart=?,dateend=?,status=?,description=?,assignto=?,hash=?, project_id =? WHERE id = " . $id;
		$assignto = $GLOBALS['current_user']->staffid;
		$sql_stmt = $conn->prepare($query);
		// d = number -- s = string
		$param_type = "sssssssss";
		$param_value_array = array(
			$subject,
			$task_title,
			$datestart,
			$dateend,
			$status,
			$comment,
			$assignto,
			$hash,
			$projectId
		);
		$param_value_reference[] = &$param_type;
		for ($i = 0; $i < count($param_value_array); $i++) {
			$param_value_reference[] = &$param_value_array[$i];
		}
		call_user_func_array(array(
			$sql_stmt,
			'bind_param'
		), $param_value_reference);

		$sql_stmt->execute();
		logActivity('Content Updated [' . $subject . ']');
		return true;
	}
	/**
	 * @param  integer ID
	 * @return boolean
	 * Delete content
	 */
	public function delete($id)
	{
		do_action('before_contract_deleted', $id);

		$this->db->where('id', $id);
		$this->db->delete('tblcontents');

		return true;
	}
	function search($keyword)
	{
		$this->db->like('subject', $keyword);
		$query = $this->db->get('tblcontents');
		$query = $query->result_array();
		return $query;
	}
	public function get_content_statuses()
	{
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
				'color' => '#5f00bf',
				'name' => _l('waiting_for_post'),
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

	public function update_status($id)
	{

		$this->db->where('id', $id);
		$this->db->update('tblcontents', ['status' => 5]);
		return true;
	}

	public function remove_content_attachment($id)
	{
		$comment_removed = false;
		$deleted         = false;
		// Get the attachment
		$this->db->where('id', $id);
		$attachment = $this->db->get('tblfiles')->row();
		if ($attachment) {
			$this->db->where('id', $attachment->id);
			$this->db->delete('tblfiles');
			if ($this->db->affected_rows() > 0) {
				$deleted = true;
				logActivity('Content Image Deleted [ContentID: ' . $attachment->rel_id . ']');
			}
			if (is_dir(APP_BASE_URL . 'uploads/content/' . $attachment->rel_id)) {
				// Check if no attachments left, so we can delete the folder also
				$other_attachments = list_files(APP_BASE_URL . 'uploads/content/' . $attachment->rel_id);
				if (count($other_attachments) == 0) {
					// okey only index.html so we can delete the folder also
					delete_dir(APP_BASE_URL . 'uploads/content/' . $attachment->rel_id);
				}
			}
		}
		if ($deleted) {
			$this->db->set('file_id', 0);
			$this->db->where('id', $attachment->rel_id);
			$this->db->update('tblcontents');
		}
		return ['success' => $deleted];
	}
}
