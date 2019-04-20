<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Approval_content_model extends CRM_Model
{
    public function __construct()
    {
        parent::__construct();
       
    }
   public function get($id = '', $where = [], $for_editor = false)
    {
       
        if (is_numeric($id)) {
            $this->db->where('tblcontents.id', $id);
            $approval_content = $this->db->get('tblcontents')->row();
            if ($approval_content) {
                $approval_content->attachments = $this->get_content_attachments('', $approval_content->id);
                if ($for_editor == false) {
                    $merge_fields = [];
                    $merge_fields = array_merge($merge_fields, get_content_merge_fields($id));
                    $merge_fields = array_merge($merge_fields, get_client_contact_merge_fields($approval_content->client));
                    $merge_fields = array_merge($merge_fields, get_other_merge_fields());
                    foreach ($merge_fields as $key => $val) {
                        if (stripos($approval_content->content, $key) !== false) {
                            $approval_content->content = str_ireplace($key, $val, $approval_content->content);
                        } else {
                            $approval_content->content = str_ireplace($key, '', $approval_content->content);
                        }
                    }
                }
            }

            return $approval_content;
        }
        $approval_contents = $this->db->get('tblcontents')->result_array();
        $i         = 0;
        foreach ($approval_contents as $approval_content) {
            $approval_contents[$i]['attachments'] = $this->get_content_attachments('', $approval_content['id']);
            $i++;
        }

        return $approval_contents;
    }
    public function get_contents_years()
    {
        return $this->db->query('SELECT DISTINCT(YEAR(start_date)) as year FROM tblcontents')->result_array();
    }
    public function update($data, $id)
    {

        if (isset($data['status']) && ($data['status'] == 1 || $data['status'] === 'on')) {
            $data['status'] = 3;
        } else {
            $data['status'] = 2;
        }


                $_data = do_action('before_content_updated', [
            'data' => $data,
            'id'   => $id,
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

}
