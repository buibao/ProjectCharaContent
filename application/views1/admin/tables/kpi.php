<?php

defined('BASEPATH') or exit('No direct script access allowed');

$has_permission_delete = has_permission('staff', '', 'delete');

$custom_fields = get_custom_fields('staff', [
    'show_on_table' => 1,
    ]);
$aColumns = [
     'leader_id',
    'firstname',
      'staffid',
    'lastname',
     'phonenumber',
    'skype',
    'email',
    'datecreated',

  
   
    ];
$sIndexColumn = 'staffid';
$sTable       = 'tblstaff';
$join         = [];
$i            = 0;
$j =0;
// foreach ($custom_fields as $field) {
//     $select_as = 'cvalue_' . $i;
//     if ($field['type'] == 'date_picker' || $field['type'] == 'date_picker_time') {
//         $select_as = 'date_picker_cvalue_' . $i;
//     }
//     array_push($aColumns, 'ctable_' . $i . '.value as ' . $select_as);
//     array_push($join, 'LEFT JOIN tblcustomfieldsvalues as ctable_' . $i . ' ON tblstaff.staffid = ctable_' . $i . '.relid AND ctable_' . $i . '.fieldto="' . $field['fieldto'] . '" AND ctable_' . $i . '.fieldid=' . $field['id']);
//     $i++;
// }
            // Fix for big queries. Some hosting have max_join_limit
// if (count($custom_fields) > 4) {
//     @$this->ci->db->query('SET SQL_BIG_SELECTS=1');
// }

$where = do_action('staff_table_sql_where', []);

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, [
     'leader_id',
    'staffid',
    'firstname',
   
   
    ]);

$output  = $result['output'];
$rResult = $result['rResult'] ;

  // print_r($listId);
              // print_r($listLead);
              //  print_r($listName);
foreach ($rResult as $aRow) {
    $row = [];

     for ($i = 0; $i < count($aColumns); $i++) {
        
       
          if($aColumns[$i] == 'leader_id'){
        $_data =$listLead[$j];
        }
         if($aColumns[$i] == 'firstname'){
          $_data =$listName[$j];
        }
        if($aColumns[$i] == 'staffid'){
             $_data =$listMember[$j];
        }
         if($aColumns[$i] == 'lastname'){
        $_data =$listPersonalC[$j];
        }
          if($aColumns[$i] == 'phonenumber'){
        $_data =$listContents[$j];
        }
         if($aColumns[$i] == 'skype'){
        $_data =$personalKPI[$j];
        }
         if($aColumns[$i] == 'email'){
        $_data =$listKPI[$j];
        }
         if($aColumns[$i] == 'datecreated'){
        $_data =date("d-M-y");
        }
       
        
      


        $row[] = $_data;

    }
 $j++;
     
    $row['DT_RowClass'] = 'has-row-options';
    $output['aaData'][] = $row;
    if($j == count($index)){
             break;
    }
}

 