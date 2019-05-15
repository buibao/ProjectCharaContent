<?php

defined('BASEPATH') or exit('No direct script access allowed');

$aColumns = [
	'tblcontents.id as id',
	'subject',
	'task_title',
	'datestart',
	'dateend',
	'status',
	'project_id',
	'assignto',
];

$sIndexColumn = 'id';
$sTable = 'tblcontents';

$join = [

];

$where = [];
$filter = [];

$statusIds = [];

foreach ($this->ci->contents_model->get_content_statuses() as $status) {
	if ($this->ci->input->post('content_status_' . $status['id'])) {
		array_push($statusIds, $status['id']);
	}
}
$custom_fields = get_table_custom_fields('contents');

foreach ($custom_fields as $key => $field) {
	$selectAs = (is_cf_date($field) ? 'date_picker_cvalue_' . $key : 'cvalue_' . $key);
	array_push($customFieldsColumns, $selectAs);
	array_push($aColumns, 'ctable_' . $key . '.value as ' . $selectAs);
	array_push($join, 'LEFT JOIN tblcustomfieldsvalues as ctable_' . $key . ' ON tblcontents.id = ctable_' . $key . '.relid AND ctable_' . $key . '.fieldto="' . $field['fieldto'] . '" AND ctable_' . $key . '.fieldid=' . $field['id']);
}

$aColumns = do_action('contents_table_sql_columns', $aColumns);

// Fix for big queries. Some hosting have max_join_limit
if (count($custom_fields) > 4) {
	@$this->ci->db->query('SET SQL_BIG_SELECTS=1');
}

$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, ['tblcontents.id', 'hash']);

$output = $result['output'];
$rResult = $result['rResult'];

foreach ($rResult as $aRow) {
	$row = [];
	$link = admin_url('contents/view/' . $aRow['id']);
	// if ($aRow['status'] == 1) {

	$row[] = $aRow['id'];

	$name = '<a href="' . $link . '">' . $aRow['subject'] . '</a>';

	$name .= '<div class="row-options">';
	$name .= '<a href="' . $link . '">' . _l('view') . '</a>';
	// $name .= '<a href="' . site_url('content/' . $aRow['id'] . '/' . $aRow['hash']) . '" target="_blank">' . _l('view') . '</a>';

	// if ($hasPermissionEdit) {
	//     $name .= ' | <a href="'.admin_url('contents/content/'. $aRow['id']).'">'._l('edit').'</a>';
	// }
	if ($aRow['status'] == 1) {
		if (has_permission('contents', '', 'edit')) {
			$name .= ' | <a href="' . admin_url('contents/content/' . $aRow['id']) . '">' . _l('edit') . '</a>';
		}
	}

	// if ($hasPermissionDelete) {
	//     $name .= ' | <a href="'.admin_url('contents/delete/'. $aRow['id']).'" class="text-danger _delete">'._l('delete').'</a>';
	// }
	if (has_permission('contents', '', 'delete')) {
		$name .= ' | <a href="' . admin_url('contents/delete/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
	}

	$name .= '</div>';

	$row[] = $name;
// FIX
	if ($aRow['task_title'] == 0) {
		$row[] = "#";
	} else {
		foreach ($ids as $rows) {
			if ($rows['id'] == $aRow['task_title']) {
				$row[] = $rows['name'];
				break;
			}
		}

	}

	// $row[] = 'Hello';
	// END FIX

	if ($aRow['datestart'] == 0) {
		$row[] = "#";
	} else {
		$row[] = _d($aRow['datestart']);

	}

	if ($aRow['dateend'] == 0) {
		$row[] = "#";
	} else {
		$row[] = _d($aRow['dateend']);

	}
	// $row[] = _d($aRow['datestart']);

	//$row[] = _d($aRow['dateend']);

	$status = get_content_status_by_id($aRow['status']);
	$row[] = '<span class="label label inline-block project-status-' . $aRow['status'] . '" style="color:' . $status['color'] . ';border:1px solid ' . $status['color'] . '">' . $status['name'] . '</span>';
	//$row[] = $aRow['status'];
	if ($aRow['project_id'] == 0) {
		$row[] = "#";
	} else {
		foreach ($project_id as $value1) {
			if ($value1['id'] == $aRow['project_id']) {
				$row[] = $value1['name'];
				break;
			}

		}
	}

	// fix assignto

	foreach ($staff as $value) {
		if ($value['staffid'] == $aRow['assignto']) {
			$row[] = $value['firstname'] . " " . $value['lastname'];
			break;
		}
	}

	$row[] = $aRow['assignto'];

	//$row[] = $aRow['project_id'];
	// Custom fields add values
	foreach ($customFieldsColumns as $customFieldColumn) {
		$row[] = (strpos($customFieldColumn, 'date_picker_') !== false ? _d($aRow[$customFieldColumn]) : $aRow[$customFieldColumn]);
	}

	$hook = do_action('contents_table_row_data', [
		'output' => $row,
		'row' => $aRow,
	]);

	$row = $hook['output'];
	$row['DT_RowClass'] = 'has-row-options';
	$output['aaData'][] = $row;
// }
}
