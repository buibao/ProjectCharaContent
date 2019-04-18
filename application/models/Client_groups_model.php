<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Client_groups_model extends CRM_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Add new customer group
     * @param array $data $_POST data
     */
    public function add($data)
    {
        $this->db->insert('tblcustomersgroups', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            logActivity('New Customer Group Created [ID:' . $insert_id . ', Name:' . $data['name'] . ']');

            return $insert_id;
        }

        return false;
    }

// FIX SOURCE FIELD DONE
     public function addfield($data)
    {
        $this->db->insert('tblcustomerfields', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            logActivity('New Customer Field Created [ID:' . $insert_id . ', Name:' . $data['name'] . ']');

            return $insert_id;
        }

        return false;
    }

    /**
    * Get customer groups where customer belongs
    * @param  mixed $id customer id
    * @return array
    */
    public function get_customer_groups($id)
    {
        $this->db->where('customer_id', $id);

        return $this->db->get('tblcustomergroups_in')->result_array();
    }
    // FIX SOURCE
     public function get_customer_fields($id)
    {
        $this->db->where('customer_id', $id);

        return $this->db->get('tblcustomerfields_in')->result_array();
    }



    /**
     * Get all customer groups
     * @param  string $id
     * @return mixed
     */
    public function get_groups($id = '')
    {
        if (is_numeric($id)) {
            $this->db->where('id', $id);

            return $this->db->get('tblcustomersgroups')->row();
        }
        $this->db->order_by('name', 'asc');

        return $this->db->get('tblcustomersgroups')->result_array();
    }
    
      public function get_fields($id = '')
    {
        if (is_numeric($id)) {
            $this->db->where('id', $id);

            return $this->db->get('tblcustomerfields')->row();
        }
        $this->db->order_by('name', 'asc');

        return $this->db->get('tblcustomerfields')->result_array();
    }

    /**
     * Edit customer group
     * @param  array $data $_POST data
     * @return boolean
     */
    public function edit($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tblcustomersgroups', [
            'name' => $data['name'],
        ]);
        if ($this->db->affected_rows() > 0) {
            logActivity('Customer Group Updated [ID:' . $data['id'] . ']');

            return true;
        }

        return false;
    }
// FIX TASK #10
    /**
     * Edit customer field
     * @param  array $data $_POST data
     * @return boolean
     */
    public function editfield($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tblcustomerfields', [
            'name' => $data['name'],
        ]);
        if ($this->db->affected_rows() > 0) {
            logActivity('Customer Field Updated [ID:' . $data['id'] . ']');

            return true;
        }

        return false;
    }



    /**
     * Delete customer group
     * @param  mixed $id group id
     * @return boolean
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tblcustomersgroups');
        if ($this->db->affected_rows() > 0) {
            $this->db->where('groupid', $id);
            $this->db->delete('tblcustomergroups_in');
            logActivity('Customer Group Deleted [ID:' . $id . ']');

            return true;
        }

        return false;
    }
// FIX TASK #10
    /** 
     * Delete customer group
     * @param  mixed $id group id
     * @return boolean
     */
    public function deletefield($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tblcustomerfields');
        if ($this->db->affected_rows() > 0) {
            $this->db->where('fieldid', $id);
            $this->db->delete('tblcustomerfields_in');
            logActivity('Customer Field Deleted [ID:' . $id . ']');

            return true;
        }

        return false;
    }


    /**
    * Update/sync customer groups where belongs
    * @param  mixed $id        customer id
    * @param  mixed $groups_in
    * @return boolean
    */
    public function sync_customer_groups($id, $groups_in)
    {
        if ($groups_in == false) {
            unset($groups_in);
        }
        $affectedRows    = 0;
        $customer_groups = $this->get_customer_groups($id);
        //  $customer_fields = $this->get_customer_fileds($id);

        if (sizeof($customer_groups) > 0) {
            foreach ($customer_groups as $customer_group) {
                if (isset($groups_in)) {
                    if (!in_array($customer_group['groupid'], $groups_in)) {
                        $this->db->where('customer_id', $id);
                        $this->db->where('id', $customer_group['id']);
                        $this->db->delete('tblcustomergroups_in');
                        if ($this->db->affected_rows() > 0) {
                            $affectedRows++;
                        }
                    }
                } else {
                    $this->db->where('customer_id', $id);
                    $this->db->delete('tblcustomergroups_in');
                    if ($this->db->affected_rows() > 0) {
                        $affectedRows++;
                    }
                }
            }
            if (isset($groups_in)) {
                foreach ($groups_in as $group) {
                    $this->db->where('customer_id', $id);
                    $this->db->where('groupid', $group);
                    $_exists = $this->db->get('tblcustomergroups_in')->row();
                    if (!$_exists) {
                        if (empty($group)) {
                            continue;
                        }
                        $this->db->insert('tblcustomergroups_in', [
                            'customer_id' => $id,
                            'groupid'     => $group,
                        ]);
                        if ($this->db->affected_rows() > 0) {
                            $affectedRows++;
                        }
                    }
                }
            }
        } else {
            if (isset($groups_in)) {
                foreach ($groups_in as $group) {
                    if (empty($group)) {
                        continue;
                    }
                    $this->db->insert('tblcustomergroups_in', [
                        'customer_id' => $id,
                        'groupid'     => $group,
                    ]);
                    if ($this->db->affected_rows() > 0) {
                        $affectedRows++;
                    }
                }
            }
        }

        if ($affectedRows > 0) {
            return true;
        }

        return false;
    }

    // FIX SOURCE FIELD DONE
 /**
    * Update/sync customer fields where belongs
    * @param  mixed $id        customer id
    * @param  mixed $fields_in
    * @return boolean
    */
    public function sync_customer_fields($id, $fields_in)
    {
        if ($fields_in == false) {
            unset($fields_in);
        }
        $affectedRows    = 0;
        $customer_fields = $this->get_customer_fields($id);
        //  $customer_fields = $this->get_customer_fileds($id);

        if (sizeof($customer_fields) > 0) {
            foreach ($customer_fields as $customer_field) {
                if (isset($fields_in)) {
                    if (!in_array($customer_field['fieldid'], $fields_in)) {
                        $this->db->where('customer_id', $id);
                        $this->db->where('id', $customer_field['id']);
                        $this->db->delete('tblcustomerfields_in');
                        if ($this->db->affected_rows() > 0) {
                            $affectedRows++;
                        }
                    }
                } else {
                    $this->db->where('customer_id', $id);
                    $this->db->delete('tblcustomerfields_in');
                    if ($this->db->affected_rows() > 0) {
                        $affectedRows++;
                    }
                }
            }
            if (isset($fields_in)) {
                foreach ($fields_in as $field) {
                    $this->db->where('customer_id', $id);
                    $this->db->where('fieldid', $field);
                    $_exists = $this->db->get('tblcustomerfields_in')->row();
                    if (!$_exists) {
                        if (empty($field)) {
                            continue;
                        }
                        $this->db->insert('tblcustomerfields_in', [
                            'customer_id' => $id,
                            'fieldid'     => $field,
                        ]);
                        if ($this->db->affected_rows() > 0) {
                            $affectedRows++;
                        }
                    }
                }
            }
        } else {
            if (isset($fields_in)) {
                foreach ($fields_in as $field) {
                    if (empty($field)) {
                        continue;
                    }
                    $this->db->insert('tblcustomerfields_in', [
                        'customer_id' => $id,
                        'fieldid'     => $field,
                    ]);
                    if ($this->db->affected_rows() > 0) {
                        $affectedRows++;
                    }
                }
            }
        }

        if ($affectedRows > 0) {
            return true;
        }

        return false;
    }
}



