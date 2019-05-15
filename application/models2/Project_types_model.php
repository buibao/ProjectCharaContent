<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Project_types_model extends CRM_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * Add new project type
    * @param mixed $data All $_POST data
    */
    public function add($data)
    {
        $this->db->insert('tblprojecttype', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            logActivity('New Project Type Added [' . $data['name'] . ']');

            return $insert_id;
        }

        return false;
    }

    /**
     * Edit project type
     * @param mixed $data All $_POST data
     * @param mixed $id project type id
     */
    public function update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tblprojecttype', $data);
        if ($this->db->affected_rows() > 0) {
            logActivity('Project Type Updated [' . $data['name'] . ', ID:' . $id . ']');

            return true;
        }

        return false;
    }

    /**
     * @param  integer ID (optional)
     * @return mixed
     * Get project type object based on passed id if not passed id return array of all types
     */
    public function get($id = '')
    {
        if (is_numeric($id)) {
            $this->db->where('id', $id);

            return $this->db->get('tblprojecttype')->row();
        }

        $types = $this->object_cache->get('project-types');

        if (!$types && !is_array($types)) {
            $types = $this->db->get('tblprojecttype')->result_array();
            $this->object_cache->add('project-types', $types);
        }

        return $types;
    }

    
}
