<?php
defined('BASEPATH') or exit('No direct script access allowed');
class AccessToken_model extends CRM_Model
{
    public function __construct()
    {
        parent::__construct();
       
    }
    public function getCurrentToken(){
        
			$this->db->where('tblaccesstokens.status', 0);
			$token = $this->db->get('tblaccesstokens')->row();
			return $token;
    }
    public function update($id,$data)
    {
        $this->db->where('id', $id);
        $this->db->update('tblaccesstokens', $data);
        if ($this->db->affected_rows() > 0) {
            do_action('after_content_updated', $id);
            logActivity('Token Updated [' . $data['subject'] . ']');
            return true;
        }
        return false;
    }
    public function add($token){

        $data['status'] = 0;
        $data['token'] = $token;
        $data['modified_date'] = date('Y-m-d H:i:s');
        
        $insert_id = $this->db->insert('tblaccesstokens', $data);
        if ($insert_id) {
            do_action('after_token_added', $insert_id);
            logActivity('New Token Added [' . $data['token'] . ']');
            return $insert_id;
        }
        return false;
    }

}
