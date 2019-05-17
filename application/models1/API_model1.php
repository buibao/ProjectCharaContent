<?php
defined('BASEPATH') or exit('No direct script access allowed');

class API_model extends CRM_Model {
   
    public function __construct()
    {
        parent::__construct();  
    }

    public function getStaffs() {
        $sql = "SELECT * FROM tblclients";
        $query = $this->db->query($sql);
        return $query->result();
    }
   
     public function getSingleVHT($Ext,$Pass)
    {
       
        $query = $this->db->get_where('tblconfigcall', array('Ext'=>$Ext,'Pass'=>$Pass));
        if($query->num_rows()>0)
                return $query->row();
            return false;
    }
    public function getContacts(){
      $sql = "SELECT * FROM tblcontacts";
        $query = $this->db->query($sql);
        if($query->num_rows()>0)
                return $query->result_array();
            return false;
}

   
}