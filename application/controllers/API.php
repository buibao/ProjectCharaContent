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
   $token =$User->Token;
    $context = stream_context_create([
    "http" => [
        'method'=>"GET",
        "header" => "X-STRINGEE-AUTH: $token"
    ]
]);

 $strings2 = 'https://api.stringee.com/v1/call/log'; 
  $homepage2 = file_get_contents($strings2, false, $context);
  $results2 = json_decode($homepage2);
  $dt = $results2->data->calls;      

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
   $token =$User->Token;
    $context = stream_context_create([
    "http" => [
      'method'=>"GET",
        "header" => "X-STRINGEE-AUTH: $token"
    ]
]);

 $strings2 = 'https://api.stringee.com/v1/call/log'; 
  $homepage2 = file_get_contents($strings2, false, $context);
  $results2 = json_decode($homepage2);
  $dt = $results2->data->calls;    
  $stringCreateDate = "";
  $stringTotal = 0;

$arrayName =  array(
        '0' => array(
            'created_datetime' => '2019-05-07',
            'total' => '22',
        ),
        '1' => array(
            'created_datetime' => '2019-05-9',
            'total' => '1',
        ),
        '2' => array(
            'created_datetime' => '2019-05-10',
            'total' => '2',
        ),
        '3' => array(
            'created_datetime' => '2019-05-11',
            'total' => '3',
        ),
        '4' => array(
            'created_datetime' => '2019-05-12',
            'total' => '2',
        ),
        
    );
$results2->data->callByDay = $arrayName;


        //$contacts = $this->API_model->getContacts();
      //  $model['contacts'] = $contacts;
        $model['historys'] =  $dt;
        echo json_encode($results2);
    }
    public function downloadCall(){
        $user  = $GLOBALS['current_user'];
    $ids  = $user->staffid;
     $User = $this->Callcenter_model->getSingle($ids);
   $auth =  base64_encode($User->APIKey .":". $User->APISecret);
   $token =$User->Token;
       $context = stream_context_create([
    "http" => [
      'Content-Type'=> 'audio/mpeg',
        'method'=>"GET",
        "header" => "X-STRINGEE-AUTH: $token"
    ]
]);

 $strings2 = 'https://api.stringee.com/v1/call/recording/call-vn-1-2H2YSVI9R3-1557334338904'; 
  $homepage2 = file_get_contents($strings2, false, $context);

 // $results2 = json_decode($homepage2);
    echo json_encode($homepage2);
    }
    
}

?>