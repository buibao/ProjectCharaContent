<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Tree extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
    }
    /* List all staff members */
    public function index()
    {
     // $connect = mysqli_connect('localhost', 'root', '', 'fromdev');
     //    $query = "
     //     SELECT * FROM tblstaff
     //    ";
     //    $result = mysqli_query($connect, $query);
       $result =   $this->staff_model->get_Tree('', ['active'=>1]);
        $output = array();
        // while($result)
        // {
        //  $sub_data["id"] = $result["staffid"];
        //  $sub_data["name"] = $result["firstname"];
        //  $sub_data["text"] = $result["lastname"];
        //  $sub_data["parent_id"] = $result["leader_id"];
        //  $data[] = $sub_data;
        // }
        foreach($result as $key => &$value)
        {
         $output[$value["id"]] = &$value;
        }
        foreach($result as $key => &$value)
        {
         if($value["parent_id"] && isset($output[$value["parent_id"]]))
         {
          $output[$value["parent_id"]]["nodes"][] = &$value;
         }
        }
        foreach($result as $key => &$value)
        {
         if($value["parent_id"] && isset($output[$value["parent_id"]]))
         {
          unset($result[$key]);
         }
        }
       echo json_encode($result);  
        //print_r($result);
    }
   
    
}