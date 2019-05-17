<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

class apitest extends REST_Controller 
{

       public function __construct() {
               parent::__construct();
              $this->load->model('API_model');

       }    
       public function contacts(){
       $users = $this->API_model->getContacts();
          
       echo json_encode($use);
        //  if(!empty($users)){
        //     //set the response and exit
        //     $this->response($users, REST_Controller::HTTP_OK);
        // }else{
        //     //set the response and exit
        //     $this->response([
        //         'status' => FALSE,
        //         'message' => 'No user were found.'
        //     ], REST_Controller::HTTP_NOT_FOUND);
        // }

       }
       public function user(){
        //API URL
$url = 'http://localhost/codeigniter/api/example/user/';

//API key
$apiKey = 'keys';

//Auth credentials
$username = "admin";
$password = "1234";

//create a new cURL resource
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-API-KEY: " . $apiKey));
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");

$result = curl_exec($ch);

//close cURL resource
curl_close($ch);

       }
       public function user_put(){
           $id = $this->uri->segment(3);

           $data = array('name' => $this->input->get('name'),
           'pass' => $this->input->get('pass'),
           'type' => $this->input->get('type')
           );

            $r = $this->user_model->update($id,$data);
               $this->response($r); 
       }

       public function user_post(){
           $data = array('name' => $this->input->post('name'),
           'pass' => $this->input->post('pass'),
           'type' => $this->input->post('type')
           );
           $r = $this->user_model->insert($data);
           $this->response($r); 
       }
       public function user_delete(){
           $id = $this->uri->segment(3);
           $r = $this->user_model->delete($id);
           $this->response($r); 
       }