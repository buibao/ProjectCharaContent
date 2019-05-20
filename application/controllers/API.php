<?php

defined('BASEPATH') or exit('No direct script access allowed');
class API extends Admin_controller
{
    public function __construct()
    {
       parent::__construct();
        $this->load->model('authentication_model');
        $this->authentication_model->autologin();
        if (is_staff_logged_in()) {
            load_admin_language();
        } else {
            load_client_language();
        }
           $this->load->model('API_model');
              $this->load->model('Callcenter_model');
        $this->load->library('session');
       
       
    }
// Output Data test
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
// $header = array('cty' => "stringee-api;v=1");
//   $payload = array(
//       "jti" => $apiKeySid . "-" . $now,
//       "iss" => $apiKeySid,
//       "exp" => $exp,
//      "icc_api" => true,
//       "userId" => $username
//   );

    public function Contacts(){
        $model = array();
        
         $user  = $GLOBALS['current_user'];
    $ids  = $user->staffid;
     $User = $this->Callcenter_model->getSingle($ids);
   $auth =  base64_encode($User->APIKey .":". $User->APISecret);
  // echo json_encode($auth);
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
      public function Contact(){
        
        $inputFromNumber = $_POST['inputFromNumber'];
        $inputToNumber = $_POST['inputToNumber'];
        $reportrange = $_POST['reportrange'];
        $str_arr = explode (" - ", $reportrange);
        $check ='';  
        if(strcmp($str_arr[0], 'YYYY-MM-DD') ==0){
        $check = 'done have';
        }
        $calls = $this->Callcenter_model->callsChart($inputFromNumber,$inputToNumber,$str_arr[0],$str_arr[1]);
        $rowcount = count($calls);
        $callChart = $this->Callcenter_model->callByDayChart($inputFromNumber,$inputToNumber,$str_arr[0],$str_arr[1]);
        $callSum = $this->Callcenter_model->callSumChart($inputFromNumber,$inputToNumber,$str_arr[0],$str_arr[1]);
        $results2->data->callByDay = $callChart;
        $results2->data->callSum = gmdate("H:i:s", $callSum->total);
        $results2->data->total = $calls;
        $results2->data->totalCount = $rowcount;
        $results2->data->stringG1 = $str_arr[0];
        $results2->data->stringG2 = $str_arr[1];
        $results2->data->stringG3 = $check;
        echo json_encode($results2);
    }
    
}

?>