<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Settings extends Admin_controller

{

    public function __construct()

    {

        parent::__construct();

        $this->load->model('payment_modes_model');
        $this->load->model('AccessToken_model');
        $this->load->model('settings_model');
        $this->load->model('authentication_model');
        $this->load->model('Callcenter_model');
        $this->load->library('session');
    }



    /* View all settings */

    public function index()

    {

        if (!has_permission('settings', '', 'view')) {

            access_denied('settings');
        }

        if ($this->input->post()) {

            if (!has_permission('settings', '', 'edit')) {

                access_denied('settings');
            }

            $logo_uploaded     = (handle_company_logo_upload() ? true : false);

            $favicon_uploaded  = (handle_favicon_upload() ? true : false);

            $signatureUploaded = (handle_company_signature_upload() ? true : false);



            $post_data = $this->input->post();

            $tmpData   = $this->input->post(null, false);


            if ($post_data['settings']['access_token']) {

                $token = $post_data['settings']['access_token'];
                $curToken = $this->AccessToken_model->getCurrentToken();
                if ($token == $curToken->token) {
                    set_alert('success', 'Please Check New Token Again ', _l('content'));
                } else {
                    $dataCur = array(
                        'status' => 1
                    );
                    
                    if ($curToken) {
                        $update = $this->AccessToken_model->update($curToken->id, $dataCur);
                        $success = $this->AccessToken_model->add($token);
                        if ($success) {
                            set_alert('success', _l('settings_updated'));
                        } else {
                            set_alert('success', _l('fail', _l('content')));
                        }
                    }
                    else{
                        $success = $this->AccessToken_model->add($token);
                        if ($success) {
                            set_alert('success', _l('settings_updated'));
                        } else {
                            set_alert('success', _l('fail'));
                        }
                    }
                    
                    
                }
            }

            if ($post_data['settings']['Ext']) {
                $user  = $GLOBALS['current_user'];
                $id  = $user->staffid;
                $data['id'] = $id;
                $data['Ext'] = $post_data['settings']['Ext'];
                $data['Pass'] = $post_data['settings']['Pass'];
                $data['APIKey'] = $post_data['settings']['API_Key'];
                $data['APISecret'] = $post_data['settings']['API_Secret'];
                $data['Token'] = $post_data['settings']['Token'];
                
                $checkUser = $this->Callcenter_model->getSingle($id);
                if ($checkUser == false) {
                    $this->Callcenter_model->insertVHT($data);
                    set_alert('success', _l('settings_updated'));

                } else {
                    $this->Callcenter_model->updateVHTModel($data, $id);
                    set_alert('success', _l('settings_updated'));
                   
                }
            }
           
           
            if (isset($post_data['settings']['email_header'])) {

                $post_data['settings']['email_header'] = $tmpData['settings']['email_header'];
            }



            if (isset($post_data['settings']['email_footer'])) {

                $post_data['settings']['email_footer'] = $tmpData['settings']['email_footer'];
            }



            if (isset($post_data['settings']['email_signature'])) {

                $post_data['settings']['email_signature'] = $tmpData['settings']['email_signature'];
            }



            if (isset($post_data['settings']['smtp_password'])) {

                $post_data['settings']['smtp_password'] = $tmpData['settings']['smtp_password'];
            }



            $success = $this->settings_model->update($post_data);

            if ($success > 0) {

                set_alert('success', _l('settings_updated'));
            }



            if ($logo_uploaded || $favicon_uploaded) {

                set_debug_alert(_l('logo_favicon_changed_notice'));
            }



            // Do hard refresh on general for the logo

            if ($this->input->get('group') == 'general') {

                redirect(admin_url('settings?group=' . $this->input->get('group')), 'refresh');
            } elseif ($signatureUploaded) {

                redirect(admin_url('settings?group=pdf&tab=signature'));
            } else {

                redirect(admin_url('settings?group=' . $this->input->get('group')));
            }
        }



        $this->load->model('taxes_model');

        $this->load->model('tickets_model');

        $this->load->model('leads_model');

        $this->load->model('currencies_model');

        $data['taxes']                                   = $this->taxes_model->get();

        $data['ticket_priorities']                       = $this->tickets_model->get_priority();

        $data['ticket_priorities']['callback_translate'] = 'ticket_priority_translate';

        $data['roles']                                   = $this->roles_model->get();

        $data['leads_sources']                           = $this->leads_model->get_source();

        $data['leads_statuses']                          = $this->leads_model->get_status();

        $data['title']                                   = _l('options');

        if (!$this->input->get('group') || ($this->input->get('group') == 'update' && !is_admin())) {

            $view = 'general';
        } else {

            $view = $this->input->get('group');
        }



        $view = do_action('settings_group_view_name', $view);



        if ($view == 'update') {

            if (!extension_loaded('curl')) {

                $data['update_errors'][] = 'CURL Extension not enabled';

                $data['latest_version']  = 0;

                $data['update_info']     = json_decode('');
            } else {

                $data['update_info'] = $this->app->get_update_info();

                if (strpos($data['update_info'], 'Curl Error -') !== false) {

                    $data['update_errors'][] = $data['update_info'];

                    $data['latest_version']  = 0;

                    $data['update_info']     = json_decode('');
                } else {

                    $data['update_info']    = json_decode($data['update_info']);

                    $data['latest_version'] = $data['update_info']->latest_version;

                    $data['update_errors']  = [];
                }
            }



            if (!extension_loaded('zip')) {

                $data['update_errors'][] = 'ZIP Extension not enabled';
            }



            $data['current_version'] = $this->app->get_current_db_version();
        }



        $data['contacts_permissions'] = get_contact_permissions();

        $this->load->library('pdf');

        $data['payment_gateways'] = $this->payment_modes_model->get_online_payment_modes(true);

        $data['view_name']        = $view;

        $groups_path              = do_action('settings_groups_path', 'admin/settings/includes');

        $data['group_view']       = $this->load->view($groups_path . '/' . $view, $data, true);

        $this->load->view('admin/settings/all', $data);
    }



    public function delete_tag($id)

    {

        if (!$id) {

            redirect(admin_url('settings?group=tags'));
        }



        if (!has_permission('settings', '', 'delete')) {

            access_denied('settings');
        }



        $this->db->where('id', $id);

        $this->db->delete('tbltags');

        $this->db->where('tag_id', $id);

        $this->db->delete('tbltags_in');



        redirect(admin_url('settings?group=tags'));
    }



    public function remove_signature_image()

    {

        if (!has_permission('settings', '', 'delete')) {

            access_denied('settings');
        }



        $sImage = get_option('signature_image');

        if (file_exists(get_upload_path_by_type('company') . '/' . $sImage)) {

            unlink(get_upload_path_by_type('company') . '/' . $sImage);
        }



        update_option('signature_image', '');



        redirect(admin_url('settings?group=pdf&tab=signature'));
    }



    /* Remove company logo from settings / ajax */

    public function remove_company_logo($type = '')

    {

        do_action('before_remove_company_logo');



        if (!has_permission('settings', '', 'delete')) {

            access_denied('settings');
        }



        $logoName = get_option('company_logo');

        if ($type == 'dark') {

            $logoName = get_option('company_logo_dark');
        }



        $path = get_upload_path_by_type('company') . '/' . $logoName;

        if (file_exists($path)) {

            unlink($path);
        }



        update_option('company_logo' . ($type == 'dark' ? '_dark' : ''), '');

        redirect($_SERVER['HTTP_REFERER']);
    }



    public function remove_favicon()

    {

        do_action('before_remove_favicon');

        if (!has_permission('settings', '', 'delete')) {

            access_denied('settings');
        }

        if (file_exists(get_upload_path_by_type('company') . '/' . get_option('favicon'))) {

            unlink(get_upload_path_by_type('company') . '/' . get_option('favicon'));
        }

        update_option('favicon', '');

        redirect($_SERVER['HTTP_REFERER']);
    }



    public function delete_option($id)

    {

        if (!has_permission('settings', '', 'delete')) {

            access_denied('settings');
        }

        echo json_encode([

            'success' => delete_option($id),

        ]);
    }
}
