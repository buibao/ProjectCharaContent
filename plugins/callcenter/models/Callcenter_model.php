<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Callcenter_model extends CRM_Model {
   
    public function __construct()
    {
        parent::__construct();  
    }

    public function getStaffs($online = false) {
        $sql = "SELECT * FROM tblstaff WHERE active='1' ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function callByDay() {
        $sql = "SELECT  time_start AS created_datetime,SUM(CAST(`duration`/60 AS DECIMAL(18,2))) AS total FROM tblcalllog WHERE duration > 0 GROUP BY time_start";
        $query = $this->db->query($sql);
        return $query->result_array();
    } 
    public function callSum() {
        $sql = "SELECT SUM(duration) AS total FROM tblcalllog";
        $query = $this->db->query($sql);
        return $query->row();
    } 
    public function calls() {
        $sql = "SELECT *  FROM tblcalllog ";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

     public function callByDayChart($inputFromNumber='',$inputToNumber='',$reportrange='') {
        $stringQuery ='';
        
        if($inputFromNumber != ''){
            $stringQuery += ' && from_number = ' . $inputFromNumber; 
        }
        if($inputToNumber != ''){
            $stringQuery += ' && inputToNumber = ' . $inputToNumber; 
        }

        $sql = "SELECT  time_start AS created_datetime,SUM(CAST(`duration`/60 AS DECIMAL(18,2))) AS total FROM tblcalllog WHERE duration > 0 ".$stringQuery." GROUP BY time_start";
        $query = $this->db->query($sql);
        return $query->result_array();
    } 
    public function callSumChart($inputFromNumber='',$inputToNumber='',$reportrange='') {
         $stringQuery ='';
         $sql="";

        if($inputFromNumber != ''){
            $stringQuery += ' from_number = ' . $inputFromNumber; 
            if($inputToNumber != ''){
            $stringQuery += ' && inputToNumber = ' . $inputToNumber; 
            }
        }else{
            if($inputToNumber != ''){
            $stringQuery += ' inputToNumber = ' . $inputToNumber; 
            }
        }
        
        if($stringQuery == ''){
            $sql = "SELECT SUM(duration) AS total FROM tblcalllog";
        }else{
          $sql = "SELECT SUM(duration) AS total FROM tblcalllog WHERE " . $stringQuery;   
        }
       
        $query = $this->db->query($sql);
        return $query->row();
    } 
    public function callsChart($inputFromNumber='',$inputToNumber='',$reportrange='') {
           $stringQuery ='';
         $sql="";

        if($inputFromNumber != ''){
            $stringQuery += ' from_number = ' . $inputFromNumber; 
            if($inputToNumber != ''){
            $stringQuery += ' && inputToNumber = ' . $inputToNumber; 
            }
        }else{
            if($inputToNumber != ''){
            $stringQuery += ' inputToNumber = ' . $inputToNumber; 
            }
        }
        
        if($stringQuery == ''){
           $sql = "SELECT *  FROM tblcalllog ";
        }else{
          $sql = "SELECT *  FROM tblcalllog WHERE " . $stringQuery;   
        }
       
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    // FIX CODE
    public function insertVHT($data)
    {
        $this->db->insert('tblconfigcall', $data);
        return 1;
        
    }
    public function updateVHTModel($data,$id)
    {
        # code...
        return $this->db->where('id',$id)
                    ->update('tblconfigcall',$data);

    }
    public function getSingle($id)
    {
        # code...
        $query = $this->db->get_where('tblconfigcall', array('id'=>$id));
        if($query->num_rows()>0)
                return $query->row();
            return false;
    }
     public function getSingleVHT($id)
    {
        # code...
        
        $query = $this->db->get_where('tblconfigcall', array('id'=>$id));
        if($query->num_rows()>0)
                return $query->row();
            return false;
    }
     public function getImageContact($number)
    {
      
        $query = $this->db->get_where('tblcontacts', array('phonenumber'=>$number));
        if($query->num_rows()>0)
                return $query->row();
            return 0;
    }

     public function getSingleClient($phonenumber)
    {
        # code...
        $query = $this->db->get_where('tblcontacts', array('phonenumber'=>$phonenumber));
        if($query->num_rows()>0)
                return $query->row();
            return false;
    }
     public function insertlog($data)
    {
        $this->db->insert('tblcalllog', $data);
        return 1;
        
    }

// FIX CODE


   
}