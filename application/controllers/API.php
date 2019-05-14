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
    $context = stream_context_create([
    "http" => [
        "header" => "Authorization: Basic YzA5NWVkZGIzMGMxNDE4NGM1N2E4YzJkMmQxYWQ0ZjQ6OTQzYWJkYmUzMDJhZWY1Y2UwYWY5MWU0NDYyYTJjNTA="
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
        $model = array();
        
         $user  = $GLOBALS['current_user'];
    $ids  = $user->staffid;
     $User = $this->Callcenter_model->getSingle($ids);
   $auth =  base64_encode($User->APIKey .":". $User->APISecret);
    $context = stream_context_create([
    "http" => [
        "header" => "Authorization: Basic YzA5NWVkZGIzMGMxNDE4NGM1N2E4YzJkMmQxYWQ0ZjQ6OTQzYWJkYmUzMDJhZWY1Y2UwYWY5MWU0NDYyYTJjNTA="
    ]
]);

 $strings2 = 'https://acd-api.vht.com.vn/rest/cdrs?page=1&limit=50&sort_type=DESC'; 
  $homepage2 = file_get_contents($strings2, false, $context);
  $results2 = json_decode($homepage2);
  $dt = $results2->items;
 
 
    //   foreach ($dt as $value ) {
    //    $data['cdr_id']= $value->cdr_id;
    //    $data['call_id']= $value->call_id;
    //    $data['cause']= $value->cause;
    //    $data['q850_cause']= $value->q850_cause;
    //    $data['from_extension']= $value->from_extension;
    //    $data['to_extension']= $value->to_extension;
    //    $data['from_number']= $value->from_number;
    //    $data['to_number']= $value->to_number;
    //    $data['duration']= $value->duration;
    //    $data['direction']= $value->direction;


    //   //   $date1=date("Y-m-d",strtotime());
    //   // $date2=date("Y-m-d",strtotime();
    //   // $date3=date("Y-m-d",strtotime();


    //    $data['time_start']=date('Y-m-d',  $value->time_started); 
    //    $data['time_connect']=  date('Y-m-d', $value->time_connected);
    //    $data['time_end']=  date('Y-m-d', $value->time_ended);

    //    $data['time_started']= date('D m/d/Y H:i:s', $value->time_started);
    //    $data['time_connected']= date('D m/d/Y H:i:s', $value->time_connected);
    //    $data['time_ended']= date('D m/d/Y H:i:s', $value->time_ended);

    //    $data['recording_path']= $value->recording_path;
    //    $data['recording_url']= $value->recording_url;
    //    $data['record_file_size']= $value->record_file_size;

    //    $this->Callcenter_model->insertlog($data);
      
    // }


$callChart = $this->Callcenter_model->callByDay();
$callSum = $this->Callcenter_model->callSum();
$results2->data->callByDay = $callChart;
$results2->data->callSum = gmdate("H:i:s", $callSum->total);
$results2->data->total = $results2->limit;

       
      
        echo json_encode($results2);
    }
    
}

?>