<?php
defined('BASEPATH') or exit('No direct script access allowed');

class exam extends CI_Controller{

function rest_client_example ($id=0) {
$this->load->library ('rest', array (
'server' => 'http://localhost:8080/charaproject/api/exam/',
'http_user' => 'admin',
'http_pass' => '1234',
'http_auth' => 'basic' // or 'digest'
));

// $user = $this->rest->get ('user_get', array ('id' => $id), 'json');
$user = $this->rest->get('user_get', array('id' => $id), 'application/json');
echo $user;
?>