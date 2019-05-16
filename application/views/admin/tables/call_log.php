<?php

defined('BASEPATH') or exit('No direct script access allowed');



$aColumns =  [

      // 'ID',
      //   _l('direction'),
      //  _l('from_number'),
      //   _l('to_number'),
      //   _l('time_duration'),
      //  _l('recording'),
      //   _l('time_connected'),
      //   _l('time_ended'),

    'cdr_id',
    'direction',
    'from_number',
    'to_number',
    'duration',
    'recording_url',
    'time_connected',
    'time_ended'

];

$sIndexColumn = 'cdr_id';
$sTable       = 'tblcalllog';
//$join         = ['JOIN tblclients ON tblclients.userid=tblcontacts.userid'];

//$custom_fields = get_table_custom_fields('contacts');

// foreach ($custom_fields as $key => $field) {
//     $selectAs = (is_cf_date($field) ? 'date_picker_cvalue_' . $key : 'cvalue_' . $key);
//     array_push($customFieldsColumns, $selectAs);
//     array_push($aColumns, 'ctable_' . $key . '.value as ' . $selectAs);
//     array_push($join, 'LEFT JOIN tblcustomfieldsvalues as ctable_' . $key . ' ON tblcontacts.id = ctable_' . $key . '.relid AND ctable_' . $key . '.fieldto="' . $field['fieldto'] . '" AND ctable_' . $key . '.fieldid=' . $field['id']);
// }

$where = [];

// Add blank where all filter can be stored
$filter = [];

$join = [];

// if (!has_permission('customers', '', 'view')) {
//     array_push($where, 'AND tblcontacts.userid IN (SELECT customer_id FROM tblcustomeradmins WHERE staff_id=' . get_staff_user_id() . ')');
// }

// if ($this->ci->input->post('custom_view')) {
//     $filter = $this->ci->input->post('custom_view');
//     if (_startsWith($filter, 'consent_')) {
//         array_push($where, 'AND tblcontacts.id IN (SELECT contact_id FROM tblconsents WHERE purpose_id=' . strafter($filter, 'consent_') . ' and action="opt-in" AND date IN (SELECT MAX(date) FROM tblconsents WHERE purpose_id=' . strafter($filter, 'consent_') . ' AND contact_id=tblcontacts.id))');
//     }
// }

// // Fix for big queries. Some hosting have max_join_limit
// if (count($custom_fields) > 4) {
//     @$this->ci->db->query('SET SQL_BIG_SELECTS=1');
// }

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where);

$output  = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
    $row = [];

    // $rowName = '<img src="' . contact_profile_image_url($aRow['id']) . '" class="client-profile-image-small mright5"><a href="#" onclick="contact(' . $aRow['userid'] . ',' . $aRow['id'] . ');return false;">' . $aRow['firstname'] . '</a>';

    // $rowName .= '<div class="row-options">';

    // $rowName .= '<a href="#" onclick="contact(' . $aRow['userid'] . ',' . $aRow['id'] . ');return false;">' . _l('edit') . '</a>';

    // if (is_gdpr() && get_option('gdpr_enable_consent_for_contacts') == '1' && is_admin()) {
    //     $rowName .= ' | <a href="' . admin_url('clients/export/' . $aRow['id']) . '">
    //          ' . _l('dt_button_export') . ' ('._l('gdpr_short').')
    //       </a>';
    // }

    // if (has_permission('customers', '', 'delete') || is_customer_admin($aRow['userid'])) {
    //     if ($aRow['is_primary'] == 0 || ($aRow['is_primary'] == 1 && $aRow['total_contacts'] == 1)) {
    //         $rowName .= ' | <a href="' . admin_url('clients/delete_contact/' . $aRow['userid'] . '/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
    //     }
    // }

    // $rowName .= '</div>';
     $type = '';
     $urlRecording ='';
     if ($aRow['direction'] == 3 ) {
      $type = "<img src='https://developer.stringee.com/static/assets/images/icon-in2ex.png' class='icon-call' style='width: 50px;height: 20px;' />";
       } else {
       $type = "<img src='https://developer.stringee.com/static/assets/images/icon-ex2in.png' class='icon-call' style='width: 50px;height: 20px;' />";
      }
      if($aRow['recording_url'] ==""){
        $urlRecording = "No";
      }else{
       $urlRecording = "<td><a href='".$aRow['recording_url']."' class='btn btn-danger btn-xs text-white btnDownload' target='_blank' >Mở file</a></td>" ;
      }

    $row[] = $aRow['cdr_id'];
    $row[] = $type;
    $row[] = $aRow['from_number'];
    $row[] = $aRow['to_number'];
    $row[] = $aRow['duration'];
    $row[] = $urlRecording;
    $row[] = $aRow['time_connected'];
    $row[] = $aRow['time_ended'];

//     $row[] = $aRow['lastname'];

//     if (is_gdpr() && $consentContacts == '1') {
//         $consentHTML = '<p class="bold"><a href="#" onclick="view_contact_consent(' . $aRow['id'] . '); return false;">' . _l('view_consent') . '</a></p>';
//         $consents    = $this->ci->gdpr_model->get_consent_purposes($aRow['id'], 'contact');
//         foreach ($consents as $consent) {
//             $consentHTML .= '<p style="margin-bottom:0px;">' . $consent['name'] . (!empty($consent['consent_given']) ? '<i class="fa fa-check text-success pull-right"></i>' : '<i class="fa fa-remove text-danger pull-right"></i>') . '</p>';
//         }
//         $row[] = $consentHTML;
//     }
// // FIX SOURCE
//      $row[] = '<a href="mailto:' . $aRow['email'] . '">' . $aRow['email'] . '</a>';
//      $stringfb = str_replace('https://www.', '', $aRow['facebook']); 
//        $row[] = '<a href="https://www.' . $stringfb . '" target="_blank">' . $stringfb . '</a>';
//     // FIX SOURCE
//      // $row[] = '<a href="mailto:' . $aRow['facebook'] . '">' . $aRow['facebook'] . '</a>';

//     if (!empty($aRow['company'])) {
//         $row[] = '<a href="' . admin_url('clients/client/' . $aRow['userid']) . '">' . $aRow['company'] . '</a>';
//     } else {
//         $row[] = '';
//     }

//     $row[] = '<a href="tel:' . $aRow['phonenumber'] . '">' . $aRow['phonenumber'] . '</a>';

//       $row[] = $aRow['title'];

//     $row[] = (!empty($aRow['last_login']) ? '<span class="text-has-action" data-toggle="tooltip" data-title="' . _dt($aRow['last_login']) . '">' . time_ago($aRow['last_login']) . '</span>' : '');

//     $outputActive = '<div class="onoffswitch">
//                 <input type="checkbox"'.($aRow['registration_confirmed'] == 0 ? ' disabled' : '').' data-switch-url="' . admin_url() . 'clients/change_contact_status" name="onoffswitch" class="onoffswitch-checkbox" id="c_' . $aRow['id'] . '" data-id="' . $aRow['id'] . '"' . ($aRow['active'] == 1 ? ' checked': '') . '>
//                 <label class="onoffswitch-label" for="c_' . $aRow['id'] . '"></label>
//             </div>';
//     // For exporting
//     $outputActive .= '<span class="hide">' . ($aRow['active'] == 1 ? _l('is_active_export') : _l('is_not_active_export')) . '</span>';

//     $row[] = $outputActive;
    // Custom fields add values
   
    $row['DT_RowClass'] = 'has-row-options';

    // if ($aRow['registration_confirmed'] == 0) {
    //     $row['DT_RowClass'] .= ' alert-info requires-confirmation';
    //  $row['Data_Title']  = _l('customer_requires_registration_confirmation');
    //     $row['Data_Toggle'] = 'tooltip';
    // }
    $output['aaData'][] = $row;
}
