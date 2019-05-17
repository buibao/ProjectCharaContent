    <?php

    defined('BASEPATH') or exit('No direct script access allowed');
    $GLOBALS['sid'] = '';
    $GLOBALS['lead'] = '';
    $GLOBALS['name'] = '';
    class KPI extends Admin_controller
    {
        private $not_importable_clients_fields;

        public $pdf_zip;

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
            
            // last_active_time is from Chattr plugin, causing issue
              $this->load->model('KPI_model');
              $this->load->database();
        }

        /* List all clients */
        public function index()
        {
           // $client = $this->clients_model->get($GLOBALS['current_user']);
           //  if (!$client) {
           //      blank_page('Client Not Found');
           //  }
           //   $data['client'] = $client;
           //   print_r($client);
          $data = $this->input->post();
          unset($data['submit']);
         is_numeric($data['Target']) ? $this->KPI_model->addTarget($data['Target']) : $target = $this->KPI_model->getTarget();
          $target = $this->KPI_model->getTarget();
          $target = $target[0]['target'];
          $num= $this->KPI_model->getLead($GLOBALS['current_user']->staffid);
          $data['title']          = 'KPI';
              $datatree = [];
              $parent_key = $GLOBALS['current_user']->staffid;
              $row = $this->db->query('SELECT staffid, firstname from tblstaff');
             
              if($row->num_rows() > 0)
              {
                 $this->membersTree($parent_key, $target);
                  $listId = explode(' ', $GLOBALS['sid']);
                  $listLead = explode('|', $GLOBALS['lead']);
                  $listName = explode('|', $GLOBALS['name']);
                 $listContents = explode('|', $GLOBALS['TeamContents']);
                $listMember = explode(' ',   $GLOBALS['numMember']);
                $personalKPI = explode('|',    $GLOBALS['personalKPI']);
                $listPersonalC = explode(' ',  $GLOBALS['personalC']);
                $listKPI = explode('|', $GLOBALS['teamKPI']);
                // Leader Calculator
                // Total Member
              $this->treeKPI($GLOBALS['current_user']->staffid);
              $GLOBALS['memberTeamContent'] =    $GLOBALS['numContents']+$this->KPI_model->personalContents($parent_key);
               $GLOBALS['totalMembers'] = $GLOBALS['totalMember']+1;
                $GLOBALS['LeaderContents'] = $this->KPI_model->personalContents($parent_key);
                 $GLOBALS['LeaderKPI'] =     floor(($GLOBALS['LeaderContents']/$target)*1000)/1000;
                  $GLOBALS['LeaderTeamKPI'] = floor(($GLOBALS['memberTeamContent']/($GLOBALS['totalMembers']*$target)) * 1000) / 1000;
                 $GLOBALS['LeaderFullname'] = $this->KPI_model->getFullname($parent_key);
               $GLOBALS['totalMember']=0;
               $GLOBALS['numContents']=0;

                
              }else{
                  $datatree=["staffid"=>"0","firstname"=>"No Members presnt in list","text"=>"No Members is presnt in list","nodes"=>[]];
              }
          

            if ($this->input->is_ajax_request()) {
                 
                $this->app->get_table_data('kpi', [
                'listId'=>$listId,'index'=>$num, 'listLead'=>$listLead, 'listName'=>$listName,'treeview' => $datatree,'listPersonalC'=> $listPersonalC,'personalKPI'=> $personalKPI,'listContents'=> $listContents,'listMember'=> $listMember,'listKPI'=> $listKPI
            ]);
            }
            $data['staff_members'] = $this->staff_model->get('', ['active'=>1]);
           $GLOBALS['inputTarget']=  $dataInput['Target'];
          
          $this->load->view('admin/kpis/kpi',$data);

            
        }
       
        public function membersTree($parent_key,$targets)
        { 
            $row1 = [];
            $row = $this->db->query('SELECT staffid,leader_id,firstname,lastname from tblstaff WHERE leader_id='.$parent_key)->result_array();
            foreach($row as $key => $value)
            {
           $id = $value['staffid'];
           $row1[$key]['contentkpi']= ($this->treeKPI($id));
           $GLOBALS['personalC'] .= $this->KPI_model->personalContents($id) . ' ';
           $row1[$key]['id']= $value['staffid'];
           $GLOBALS['sid'] .=   ($value['staffid'] . ' ');
           $perKPI = $this->KPI_model->personalContents($id);
           $GLOBALS['personalKPI'] .= floor((($perKPI/$targets)*1000))/1000  . '|';
           $GLOBALS['TeamContents'] .=  ($GLOBALS['numContents']+$this->KPI_model->personalContents($id)). '|';
           $GLOBALS['lead'] .=   ($this->KPI_model->getFullname($value['leader_id']) . '|');
           $GLOBALS['name'] .=   ($value['firstname'] . ' '. $value['lastname'] . '|');
           $GLOBALS['numMember'] .=   (($GLOBALS['totalMember']+1) . ' ');
           $teamCon = ($GLOBALS['numContents']+$this->KPI_model->personalContents($id));
           $teamTarget = $targets*($GLOBALS['totalMember']+1);
           $GLOBALS['teamKPI'] .= floor((($teamCon/$teamTarget)*1000))/1000 . '|';
           $GLOBALS['numContents'] =0;
           $GLOBALS['totalMember']=0;
           $row1[$key]['nodes']= ($this->membersTree($value['staffid'],$targets));
            }
            return $listTree;
        }

           public function treeKPI($parent_key)
        { 
         
            $row1 = [];
            $row = $this->db->query('SELECT staffid,leader_id,firstname,lastname from tblstaff WHERE leader_id='.$parent_key)->result_array();
            foreach($row as $key => $value)
            {
              $id = $value['staffid'];
              $GLOBALS['numContents'] += $this->KPI_model->personalContents($id);
              $GLOBALS['totalMember'] ++;

             $row1[$key]['nodes']= ($this->treeKPI($value['staffid']));
            }
            return $listTree;
        }

        public function table()
        {
            if (!has_permission('customers', '', 'view')) {
                if (!have_assigned_customers() && !has_permission('customers', '', 'create')) {
                    ajax_access_denied();
                }
            }

            $this->app->get_table_data('kpi');
        }
        public function get(){
             $id  = $GLOBALS['current_user']->staffid;
          $us = $this->KPI_model->getLead($id);
         echo treeOut($us);
      
      }





    }
