<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Contents extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('contents_model');
    }

    /* List all contents */
    public function index()
    {

        $this->load->view('admin/contents/manage');
    }
    /* Edit contract or add new contract */
    public function content($id = '')
    {
        $overview=[];
        unset($overview[0]);
        $overview= ['staff_id' => $staff_id, 'detailed' => $overview,
        ];
    
        $data['tasksCustom'] = $this->tasks_model->get_user_tasks_assigned();

        if ($this->input->post()) {
            if ($id == '') {
                if (!has_permission('contents', '', 'create')) {
                    access_denied('contents');
                }
                $id = $this->contents_model->add($this->input->post());
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('content')));
                    // redirect(admin_url('contents'));
                    redirect(admin_url('contents'));
                }
            } 
            // update
            else {
                if (!has_permission('contents', '', 'edit')) {
                    access_denied('contents');
                }
                $success = $this->contents_model->update($this->input->post(), $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('content')));
                }
                redirect(admin_url('contents'));
                // redirect(admin_url('contents/content/' . $id));
            }
            
            //end update
        }
         $data['content'] = $this->contents_model->get($id, [], true);          
            $content_merge_fields  = get_available_merge_fields();
            $_content_merge_fields = [];
            foreach ($content_merge_fields as $key => $val) {
                foreach ($val as $type => $f) {
                    if ($type == 'content') {
                        foreach ($f as $available) {
                            foreach ($available['available'] as $av) {
                                if ($av == 'content') {
                                    array_push($_content_merge_fields, $f);

                                    break;
                                }
                            }

                            break;
                        }
                    } elseif ($type == 'other') {
                        array_push($_content_merge_fields, $f);
                    } elseif ($type == 'clients') {
                        array_push($_content_merge_fields, $f);
                    }
                }
            }
            $data['content_merge_fields'] = $_content_merge_fields;
            $title                         = $data['content']->subject;


        $data['title']         = $title;
        // $data['title']         = _l('new_content');
        $data['bodyclass']     = 'content';
        $this->load->view('admin/contents/content', $data);
    }
    public function table($clientid = '')
    {
        $this->app->get_table_data('contents', []);
    }

        /* Delete content from database */
    public function delete($id)
    {
        if (!has_permission('contents', '', 'delete')) {
            access_denied('contents');
        }
        if (!$id) {
            redirect(admin_url('contents'));
        }
        $response = $this->contents_model->delete($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('content')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('contract_lowercase')));
        }
        if (strpos($_SERVER['HTTP_REFERER'], 'clients/') !== false) {
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect(admin_url('contents'));
        }
    }
}
