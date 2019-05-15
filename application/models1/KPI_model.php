<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KPI_model extends CRM_Model {
   
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
    public function getLead($Id){
      $sql = "SELECT staffid,leader_id,firstname,lastname
FROM tblstaff
WHERE FIND_IN_SET(`staffid`,(SELECT GROUP_CONCAT(lv SEPARATOR ',') FROM (
SELECT @pv:=(SELECT GROUP_CONCAT(`staffid` SEPARATOR ',') FROM tblstaff 
WHERE FIND_IN_SET(`leader_id`, @pv)) AS lv FROM tblstaff 
JOIN
(SELECT @pv:=".$Id.") tmp) a))";

        $query = $this->db->query($sql);
         if($query->num_rows()>0)
                return $query->result_array();
            return 0;
    
        }
// Get KPI cá nhân
        public function personalContents($id){
            $sql = "SELECT id
                    FROM tblcontents
                    WHERE (status = 4 OR status = 5) and assignto = " . $id ;
             $query = $this->db->query($sql);
             return $query->num_rows();
        }
        public function getFullname($id){
            $sql = "SELECT firstname ,lastname FROM tblstaff WHERE staffid =" . $id;
            $query = $this->db->query($sql);
            $fullname = $query->result_array();

             return  $fullname[0]['firstname'] . ' '. $fullname[0]['lastname'];
        }
        public function addTarget($id){
                 $sql = "INSERT INTO `tblconfigkpi`(`target`) VALUES (".$id.")" ;
                 $query = $this->db->query($sql);
        }
        public function getTarget(){
                $sql = "SELECT `target` FROM `tblconfigkpi` ORDER BY `id` DESC LIMIT 1";
                  $query = $this->db->query($sql);
                if($query->num_rows()>0)
                return $query->result_array();
            return 0;
    
        }

   
}