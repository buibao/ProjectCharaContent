<?php

defined('BASEPATH') or exit('No direct script access allowed');

class API extends Clients_controller
{
    public function __construct()
    {
      parent::__construct();
           $this->load->model('API_model');
       
    }
// Output Data
    public function Clients(){
 	$Ext = $_GET['Ext'];
	$Pass = $_GET['Pass'];
  
    $user = $this->API_model->getSingleVHT($Ext,$Pass);
    if($user >0){
		$clients = $this->API_model->getStaffs();
    	echo json_encode($clients);
    }
    else{
    	$clients = array('Message'=>'UserVHT not exists !');
    	echo json_encode($clients);
    	
    }
}

    public function Contacts(){
        $model = array();
           $auth = base64_encode("c095eddb30c14184c57a8c2d2d1ad4f4:943abdbe302aef5ce0af91e4462a2c50");
    $context = stream_context_create([
    "http" => [
        "header" => "Authorization: Basic $auth"
    ]
]);

 $strings2 = 'https://acd-api.vht.com.vn/rest/cdrs?page=1&limit=50&sort_type=DESC'; 
  $homepage2 = file_get_contents($strings2, false, $context);
  $results2 = json_decode($homepage2);
  $dt = $results2->items;      

        $contacts = $this->API_model->getContacts();
        $model['contacts'] = $contacts;
        $model['historys'] =  $dt;
        echo json_encode($model);
    }
    public function getData(){
        $model = array();
//            $auth = base64_encode("c095eddb30c14184c57a8c2d2d1ad4f4:943abdbe302aef5ce0af91e4462a2c50");
//     $context = stream_context_create([
//     "http" => [
//         "header" => "Authorization: Basic $auth"
//     ]
// ]);

//  $strings2 = 'https://acd-api.vht.com.vn/rest/cdrs?page=1&limit=50&sort_type=DESC'; 
//   $homepage2 = file_get_contents($strings2, false, $context);
//   $results2 = json_decode($homepage2);
//   $dt = $results2->items;      

  $contacts = $this->API_model->getContacts();
        $model['contacts'] = $contacts;
      //  $model['historys'] =  $dt;
        echo json_encode($model);

      
    }
    
}

?>