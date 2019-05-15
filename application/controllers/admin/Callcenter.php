<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Callcenter extends Admin_controller {

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
        $this->load->model('Callcenter_model');
        $this->load->library('session');
       
       
    }
    
    public function callcenter() {

         if (!has_permission('customers', '', 'view')) {
            if (!have_assigned_customers() && !has_permission('customers', '', 'create')) {
                access_denied('customers');
            }
        }
              
        $this->load->model('contracts_model');
        $data['contract_types'] = $this->contracts_model->get_contract_types();
        $data['groups']         = $this->clients_model->get_groups();
        $data['title']          = _l('clients');

        $this->load->model('proposals_model');
        $data['proposal_statuses'] = $this->proposals_model->get_statuses();

        $this->load->model('invoices_model');
        $data['invoice_statuses'] = $this->invoices_model->get_statuses();

        $this->load->model('estimates_model');
        $data['estimate_statuses'] = $this->estimates_model->get_statuses();

        $this->load->model('projects_model');
        $data['project_statuses'] = $this->projects_model->get_project_statuses();

        $data['customer_admins'] = $this->clients_model->get_customers_admin_unique_ids();

        $whereContactsLoggedIn = '';
        if (!has_permission('customers', '', 'view')) {
            $whereContactsLoggedIn = ' AND userid IN (SELECT customer_id FROM tblcustomeradmins WHERE staff_id=' . get_staff_user_id() . ')';
        }

        $data['contacts_logged_in_today'] = $this->clients_model->get_contacts('', 'last_login LIKE "' . date('Y-m-d') . '%"' . $whereContactsLoggedIn);

        $data['countries'] = $this->clients_model->get_clients_distinct_countries();

        $this->load->view('callcenter_index',array('type' => $type, 'content' => $content));
    }
    public function all_contacts()
    {
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('call_all_contacts');
        }

        if (is_gdpr() && get_option('gdpr_enable_consent_for_contacts') == '1') {
            $this->load->model('gdpr_model');
            $data['consent_purposes'] = $this->gdpr_model->get_consent_purposes();
        }

        $data['title'] = _l('customer_contacts');
        $this->load->view('all_contacts', $data);
    }
      public function call_log()
    {
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('call_log');
        }

        if (is_gdpr() && get_option('gdpr_enable_consent_for_contacts') == '1') {
            $this->load->model('gdpr_model');
            $data['consent_purposes'] = $this->gdpr_model->get_consent_purposes();
        }

        $data['title'] = 'Call Log';
        $this->load->view('call_log', $data);
    }
     public function table()
    {
        if (!has_permission('customers', '', 'view')) {
            if (!have_assigned_customers() && !has_permission('customers', '', 'create')) {
                ajax_access_denied();
            }
        }

        $this->app->get_table_data('clientscallcenter');
    }
   
   public function getNameClient(){
    return "Hello";
   }
    public function getClient($phonenumber){

        $clientVHT = $this->Callcenter_model->getSingleClient($phonenumber);
        $id  = $clientVHT->userid;
        $url = base_url('/admin/clients/client/').$id;
        echo "<script language="."javascript".">
           window.location.href = '".$url."/?currentPopup=1';
         </script>";
        }
      
    public function install() {
        $basePath = callcenter_get_base_path();
        $installfile = $basePath.'/install.php';
        if (!file_exists($installfile)) exit("PERMISSION DENIED");
        include($installfile);
        exit("Callcenter installation done");
    }

    public function update() {
        $basePath = newsletter_get_base_path();
        $updatefile = $basePath.'/update.php';
        if (!file_exists($updatefile)) exit("PERMISSION DENIED");
        include($updatefile);
        exit("Newsletter update done!!!");
    }
public function updateVHT()
 {
     $user  = $GLOBALS['current_user'];
    $id  = $user->staffid;
     $users = $this->Callcenter_model->getSingle($id);
    
     $this->load->view('callcenter_settings_page',['users'=>$users]);
 }
 public function imageContact($phone){
$image = $this->Callcenter_model->getImageContact($phone);
$GLOBALS['userContact'] = $image;
$img = '';

if(is_null($image->profile_image) || $image == 0){
$img = 'https://static.stringee.com/web_phone/lastest/images/avatar.png';
}else{
    $img = base_url() . 'uploads/client_profile_images/'.$image->id. '/thumb_'.$image->profile_image;
}
//echo $image->profile_image;
echo $img;
 }
 public function getNameContact($phone){
$image = $this->Callcenter_model->getImageContact($phone);
if( $image == 0){
echo "Unknown";
}else{
echo $image->firstname ." ". $image->lastname;
}
 }

 public function imageVHT($tringg){
$_SESSION['image'] = $tringg;
echo $tringg;
 }
 // Input Data
    public function calllog($id){
     $user  = $GLOBALS['current_user'];
     $ids  = $user->staffid;
     $User = $this->Callcenter_model->getSingle($ids);
     //  $auth = base64_encode($User->APIKey .":". $User->APISecret);

       $auth = base64_encode("c095eddb30c14184c57a8c2d2d1ad4f4:943abdbe302aef5ce0af91e4462a2c50");
    $context = stream_context_create([
    "http" => [
        "header" => "Authorization: Basic " . $auth
    ]
]);

 $strings = 'https://acd-api.vht.com.vn/rest/cdrs?page='.$id."&limit=50&sort_type=DESC";

    if(strlen($_SESSION['keyState']) > 2 || strlen($_SESSION['keyFromNumber']) > 2 || strlen($_SESSION['keyToNumber']) > 2 || strlen($_SESSION['keyStartTime']) > 5 ||  strlen($_SESSION['keyEndTime']) > 5  ){
   
    if(strlen($_SESSION['keyState']) > 2){
         $strings = $strings . "&state=".$_SESSION['keyState'];
    }
    if(strlen($_SESSION['keyFromNumber']) > 2){
         $strings  = $strings . "&from_number=".$_SESSION['keyFromNumber'];
    }
     if(strlen($_SESSION['keyStartTime']) > 5){
         $strings  = $strings . "&date_started=".$_SESSION['keyStartTime'];
    }
    if(strlen($_SESSION['keyToNumber']) > 5){
         $strings  = $strings . "&date_ended=".$_SESSION['keyEndTime'];
    }
   
}else{
    $strings = "https://acd-api.vht.com.vn/rest/cdrs?page=".$id."&limit=50&sort_type=DESC";
}


   
    $homepage = file_get_contents($strings, false, $context);
    $results = json_decode($homepage);
    $pages = CEIL($results->total / 50);
    $dt = $results->items;  

    //    foreach ($dt as $value ) {
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

 $this->load->view('callcenter_calllogs',array( 'dt' => $dt, 'results'=>$results,'pages' => $pages,'idPage'=>$id));
  
}
 public function searchCall(){
     $data = $this->input->post();
     $data['Status'] =  $this->input->post('Status');
     $data['Timestarted'] = $this->input->post('startdate');
     $data['Endstarted'] = $this->input->post('enddate');

  //   echo    strtotime( $data['Timestarted'] );
    unset($data['submit']);
   // echo  $data['Status'];
     $user  = $GLOBALS['current_user'];
    $ids  = $user->staffid;
     $User = $this->Callcenter_model->getSingle($ids);
       $auth = base64_encode($User->APIKey .":". $User->APISecret);

    $context = stream_context_create([
    "http" => [
        "header" => "Authorization: Basic YzA5NWVkZGIzMGMxNDE4NGM1N2E4YzJkMmQxYWQ0ZjQ6OTQzYWJkYmUzMDJhZWY1Y2UwYWY5MWU0NDYyYTJjNTA="
    ]
]);
$_SESSION['keyState']  =   $data['Status'];
$_SESSION['keyFromNumber']  = $data['FromNumber'];
$_SESSION['keyToNumber']  = $data['ToNumber'];
$_SESSION['keyStartTime'] =    strtotime($data['Timestarted']);
$_SESSION['keyEndTime'] =    strtotime($data['Endstarted']);


    $strings = 'https://acd-api.vht.com.vn/rest/cdrs?page='.$id."&limit=50&sort_type=DESC";

    if(strlen($_SESSION['keyState']) > 2 || strlen($_SESSION['keyFromNumber']) > 2 || strlen($_SESSION['keyToNumber']) > 2 || strlen($_SESSION['keyStartTime']) > 5 ||  strlen($_SESSION['keyEndTime']) > 5  ){
   
    if(strlen($_SESSION['keyState']) > 2){
         $strings = $strings . "&state=".$_SESSION['keyState'];
    }
    if(strlen($_SESSION['keyFromNumber']) > 2){
         $strings  = $strings . "&from_number=".$_SESSION['keyFromNumber'];
    }
     if(strlen($_SESSION['keyStartTime']) > 5){
         $strings  = $strings . "&date_started=".$_SESSION['keyStartTime'];
    }
    if(strlen($_SESSION['keyEndTime']) > 5){
         $strings  = $strings . "&date_ended=".$_SESSION['keyEndTime'];
    }

   
}else{
    $strings = "https://acd-api.vht.com.vn/rest/cdrs?page=".$id."&limit=50&sort_type=DESC";
}
    $homepage = file_get_contents($strings, false, $context);
    $results = json_decode($homepage);
    $pages = CEIL($results->total / 50);
    $dt = $results->items;      

 $this->load->view('callcenter_calllogs',array( 'dt' => $dt, 'results'=>$results,'pages' => $pages));
}

 public function changeVHT()
 {
      $user  = $GLOBALS['current_user'];
    $id  = $user->staffid;
    $data = $this->input->post();
    $data['id']=$id;
    unset($data['submit']);
   
    $checkUser = $this->Callcenter_model->getSingle($id);
    if($checkUser == false){
        $this->Callcenter_model->insertVHT($data);
        $users['Exp']=$data['Exp'];
        $users['Pass']=$data['Pass'];
          $users['APIKey']=$data['APIKey'];
        $users['APISecret']=$data['APISecret'];
           $users['Token']=$data['Token'];
         $this->load->view('callcenter_settings_page',['users'=>$users]);

    }else{
        $this->Callcenter_model->updateVHTModel($data,$id);
        $users['Exp']=$data['Exp'];
        $users['Pass']=$data['Pass'];
          $users['APIKey']=$data['APIKey'];
        $users['APISecret']=$data['APISecret'];
           $users['Token']=$data['Token'];
         $this->load->view('callcenter_settings_page',['users'=>$users]);
    }
 }
    public function preInitAdmin() {
        $this->_current_version = $this->misc_model->get_current_db_version();


        //$language = load_admin_language();
        $this->load->model('authentication_model');
        $this->authentication_model->autologin();

        if (!is_staff_logged_in()) {
            if (strpos(current_full_url(), 'authentication/admin') === false) {
                $this->session->set_userdata(array(
                    'red_url' => current_full_url()
                ));
            }
            redirect(site_url('authentication/admin'));
        }

        // In case staff have setup logged in as client - This is important don't change it
        $this->session->unset_userdata('client_user_id');
        $this->session->unset_userdata('client_logged_in');
        $this->session->unset_userdata('logged_in_as_client');

        $this->load->model('staff_model');

        // Do not check on ajax requests
        if (!$this->input->is_ajax_request()) {
            // Check for just updates message

            add_action('before_start_render_content', 'show_just_updated_message');

            if (ENVIRONMENT == 'production' && is_admin()) {
                if ($this->config->item('encryption_key') === '') {
                    die('<h1>Encryption key not sent in application/config/config.php</h1>For more info visit <a href="http://www.perfexcrm.com/knowledgebase/encryption-key/">Encryption key explained</a> FAQ3');
                } elseif (strlen($this->config->item('encryption_key')) != 32) {
                    die('<h1>Encryption key length should be 32 charachters</h1>For more info visit <a href="http://www.perfexcrm.com/knowledgebase/encryption-key/">Encryption key explained</a>');
                }
            }

            add_action('before_start_render_content', 'show_development_mode_message');
            // Check if cron is required to be setup for some features
            add_action('before_start_render_content', 'is_cron_setup_required');
            // Check if timezone is set
            add_action('before_start_render_content', '_maybe_timezone_not_set');
            // Notice for cloudflare rocket loader
            add_action('before_start_render_content', '_maybe_using_cloudflare_rocket_loader');

            $this->init_quick_actions_links();
        }

        if (is_mobile()) {
            $this->session->set_userdata(array(
                'is_mobile' => true
            ));
        } else {
            $this->session->unset_userdata('is_mobile');
        }

        $auto_loaded_vars = array(
            '_staff' => $this->staff_model->get(get_staff_user_id()),
            '_notifications' => $this->misc_model->get_user_notifications(false),
            '_quick_actions' => $this->app->get_quick_actions_links(),
            '_started_timers' => $this->misc_model->get_staff_started_timers(),
            'google_api_key' => get_option('google_api_key'),
            'total_pages_newsfeed' => total_rows('tblposts') / 10,
            'locale' => get_locale_key($language),
            'tinymce_lang' => get_tinymce_language(get_locale_key($language)),
            '_pinned_projects' => $this->get_pinned_projects(),
            'total_undismissed_announcements' => $this->get_total_undismissed_announcements(),
            'current_version' => $this->_current_version,
            'tasks_filter_assignees' => $this->get_tasks_distinct_assignees(),
            'task_statuses' => $this->tasks_model->get_statuses(),
            'unread_notifications' => total_rows('tblnotifications',array('touserid'=>get_staff_user_id(),'isread'=>0))
        );

        $auto_loaded_vars = do_action('before_set_auto_loaded_vars_admin_area', $auto_loaded_vars);
        $this->load->vars($auto_loaded_vars);
    }

    private function init_quick_actions_links()
    {
        

        $this->app->add_quick_actions_link(array(
            'name' => _l('qa_create_invoice'),
            'permission' => 'invoices',
            'url' => 'invoices/invoice'
        ));

        $this->app->add_quick_actions_link(array(
            'name' => _l('qa_create_estimate'),
            'permission' => 'estimates',
            'url' => 'estimates/estimate'
        ));

        $this->app->add_quick_actions_link(array(
            'name' => _l('qa_new_expense'),
            'permission' => 'expenses',
            'url' => 'expenses/expense'
        ));

        $this->app->add_quick_actions_link(array(
            'name' => _l('new_proposal'),
            'permission' => 'proposals',
            'url' => 'proposals/proposal'
        ));

        $this->app->add_quick_actions_link(array(
            'name' => _l('new_project'),
            'url' => 'projects/project',
            'permission' => 'projects'
        ));


        $this->app->add_quick_actions_link(array(
            'name' => _l('qa_create_task'),
            'url' => '#',
            'custom_url' => true,
            'href_attributes' => array(
                'onclick' => 'new_task();return false;'
            ),
            'permission' => 'tasks'
        ));

        $this->app->add_quick_actions_link(array(
            'name' => _l('qa_create_client'),
            'permission' => 'customers',
            'url' => 'clients/client'
        ));

        $this->app->add_quick_actions_link(array(
            'name' => _l('qa_create_contract'),
            'permission' => 'contracts',
            'url' => 'contracts/contract'
        ));

        $this->app->add_quick_actions_link(array(
            'name' => _l('qa_create_lead'),
            'url' => '#',
            'custom_url' => true,
            'permission' => 'is_staff_member',
            'href_attributes' => array(
                'onclick' => 'init_lead(); return false;'
            )
        ));

        $this->app->add_quick_actions_link(array(
            'name' => _l('qa_new_goal'),
            'url' => 'goals/goal',
            'permission' => 'goals'
        ));

        $this->app->add_quick_actions_link(array(
            'name' => _l('qa_create_kba'),
            'permission' => 'knowledge_base',
            'url' => 'knowledge_base/article'
        ));

        $this->app->add_quick_actions_link(array(
            'name' => _l('qa_create_survey'),
            'permission' => 'surveys',
            'url' => 'surveys/survey'
        ));

        $tickets = array(
            'name' => _l('qa_create_ticket'),
            'url' => 'tickets/add'
        );
        if (get_option('access_tickets_to_none_staff_members') == 0 && !is_staff_member()) {
            $tickets['permission'] = 'is_staff_member';
        }
        $this->app->add_quick_actions_link($tickets);

        $this->app->add_quick_actions_link(array(
            'name' => _l('qa_create_staff'),
            'url' => 'staff/member',
            'permission' => 'staff'
        ));

        $this->app->add_quick_actions_link(array(
            'name' => _l('utility_calendar_new_event_title'),
            'url' => 'utilities/calendar?new_event=true&date='._d(date('Y-m-d')),
            'permission' => ''
        ));
    }

    public function get_tasks_distinct_assignees()
    {
        return $this->misc_model->get_tasks_distinct_assignees();
    }

    private function get_total_undismissed_announcements()
    {
        $this->load->model('announcements_model');

        return $this->announcements_model->get_total_undismissed_announcements();
    }

    private function get_pinned_projects()
    {
        $this->db->select('tblprojects.id,tblprojects.name');
        $this->db->join('tblprojects', 'tblprojects.id=tblpinnedprojects.project_id');
        $this->db->where('tblpinnedprojects.staff_id', get_staff_user_id());
        $projects = $this->db->get('tblpinnedprojects')->result_array();
        $i        = 0;
        $this->load->model('projects_model');
        foreach ($projects as $project) {
            $projects[$i]['progress'] = $this->projects_model->calc_progress($project['id']);
            $i++;
        }

        return $projects;
    }

    public function testEmail() {
        $this->load->library('email');
        $template = new StdClass();
        $template->message = get_option('email_header').'This is test SMTP email. <br />If you received this message that means that your SMTP settings is set correctly.'.get_option('email_footer');
        $template->fromname = get_option('companyname');
        $template->subject = 'SMTP Setup Testing';

        $template = parse_email_template($template);

        do_action('before_send_test_smtp_email');
        $user = (get_option('smtp_username') == '') ? trim(get_option('smtp_email')) : trim(get_option('smtp_username'));
        $this->email = new CI_Email();
        $this->email->initialize(array(
            'protocol' => get_option('email_protocol'),
            'smtp_host' => trim(get_option('smtp_host')),
            'smtp_port' => trim(get_option('smtp_port')),
            'smtp_user' => $user,
            'smtp_pass' => $this->encryption->decrypt(get_option('smtp_password')),
            'smtp_crypto' => get_option('smtp_encryption'),
            'wordwrap' => TRUE,
            'mailtype' => 'html',
            'mailpath' => '/usr/bin/sendmail',
            'useragent' => 'CodeIgniter',
            'charset' => 'UTF-8',
            'newline' => "\r\n",
            'crlf' => "\r\n"

        ));
        $this->email->set_newline("\r\n");
        $this->email->from(get_option('smtp_email'), $template->fromname);
        $this->email->to('tiamiyuwaliu1212@gmail.com');
        $this->email->subject($template->subject);
        $this->email->message($template->message);
        $this->email->send();
    }
}
