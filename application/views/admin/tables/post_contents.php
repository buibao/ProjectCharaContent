<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
	'tblcontents.id as id',
	'subject',
	'task_title',
	'datestart',
	'dateend',
	'status',
	'assignto',
];

$sIndexColumn = 'id';
$sTable = 'tblcontents';

$join = [

];

$where = [];
$filter = [];
$statusIds = [];

foreach ($this->ci->post_content_model->get_post_content_statuses() as $status) {
	if ($this->ci->input->post('content_status_' . $status['id'])) {
		array_push($statusIds, $status['id']);
	}
}

$custom_fields = get_table_custom_fields('post_contents');

foreach ($custom_fields as $key => $field) {
	$selectAs = (is_cf_date($field) ? 'date_picker_cvalue_' . $key : 'cvalue_' . $key);
	array_push($customFieldsColumns, $selectAs);
	array_push($aColumns, 'ctable_' . $key . '.value as ' . $selectAs);
	array_push($join, 'LEFT JOIN tblcustomfieldsvalues as ctable_' . $key . ' ON tblcontents.id = ctable_' . $key . '.relid AND ctable_' . $key . '.fieldto="' . $field['fieldto'] . '" AND ctable_' . $key . '.fieldid=' . $field['id']);
}

$aColumns = do_action('post_contents_table_sql_columns', $aColumns);

// Fix for big queries. Some hosting have max_join_limit
if (count($custom_fields) > 4) {
	@$this->ci->db->query('SET SQL_BIG_SELECTS=1');
}

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, ['tblcontents.id', 'hash']);

$output = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
	if($aRow['status'] >= 4){
	$row = [];
	$link = admin_url('post_contents/view/' . $aRow['id']);
	
		$row[] = '<a href="' . $link . '">' . $aRow['id'] . '</a>';

		$name = '<a href="' . $link . '">' . $aRow['subject'] . '</a>';

    	$name .= '<div class="row-options">';

    	$name .= '<a href="'.$link.'">'._l('view').'</a>';
		$name .= '</div>';

		$row[] = $name;
		$row[] = $aRow['task_title'];

		$row[] = _d($aRow['datestart']);

		$row[] = _d($aRow['dateend']);

		// $row[] = $aRow['status'];
		$status = get_content_status_by_id($aRow['status']);
		$row[] = '<span class="label label inline-block project-status-' . $aRow['status'] . '" style="color:' . $status['color'] . ';border:1px solid ' . $status['color'] . '">' . $status['name'] . '</span>';

		$row[] = $aRow['assignto'];

		// Custom fields add values
		foreach ($customFieldsColumns as $customFieldColumn) {
			$row[] = (strpos($customFieldColumn, 'date_picker_') !== false ? _d($aRow[$customFieldColumn]) : $aRow[$customFieldColumn]);
		}

		$hook = do_action('approval_contents_table_row_data', [
			'output' => $row,
			'row' => $aRow,
		]);

		$row = $hook['output'];
		$row['DT_RowClass'] = 'has-row-options';
		$output['aaData'][] = $row;
}
	
}
