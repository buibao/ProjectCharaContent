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
  //date('D m/d/Y H:i:s', $dt[$i]->time_started)
   // $timeCheck = "";
   // $arrayName = array('' => , );
    //  foreach ($dt as $value ) {
      //   $data['cdr_id']= '252621249';
      // $this->Callcenter_model->insertlog($data);
  //  }

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
$results2->data->total = $results2->limit;

       
      
        echo json_encode($results2);
    }
    
}

?>