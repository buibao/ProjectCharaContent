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
$custom_fields = get_table_custom_fields('approval_contents');
foreach ($custom_fields as $key => $field) {
	$selectAs = (is_cf_date($field) ? 'date_picker_cvalue_' . $key : 'cvalue_' . $key);
	array_push($customFieldsColumns, $selectAs);
	array_push($aColumns, 'ctable_' . $key . '.value as ' . $selectAs);
	array_push($join, 'LEFT JOIN tblcustomfieldsvalues as ctable_' . $key . ' ON tblcontents.id = ctable_' . $key . '.relid AND ctable_' . $key . '.fieldto="' . $field['fieldto'] . '" AND ctable_' . $key . '.fieldid=' . $field['id']);
}
$aColumns = do_action('approval_contents_table_sql_columns', $aColumns);
// Fix for big queries. Some hosting have max_join_limit
if (count($custom_fields) > 4) {
	@$this->ci->db->query('SET SQL_BIG_SELECTS=1');
}
$result = data_tables_init($aColumns, $sIndexColumn, $sTable, $join, $where, ['tblcontents.id', 'hash']);
$output = $result['output'];
$rResult = $result['rResult'];
foreach ($rResult as $aRow) {
	$row = [];
	$link = admin_url('approval_contents/view/' . $aRow['id']);
	if ($aRow['status'] == 2) {
		$row[] = $aRow['id'];
		// $name = '<a href="' . admin_url('approval_contents/Approval_content/' . $aRow['id']) . '">' . $aRow['subject'] . '</a>';
		$name = '<a href="' . admin_url('approval_contents/view/' . $aRow['id']) . '">' . $aRow['subject'] . '</a>';
		$name .= '<div class="row-options">';
		// $name .= '<a href="' . site_url('approval_content/' . $aRow['id'] . '/' . $aRow['hash']) . '" target="_blank">' . _l('view') . '</a>';
		$name .= '<a href="' . $link . '">' . _l('view') . '</a>';
		// if ($hasPermissionEdit) {
		//     $name .= ' | <a href="'.admin_url('contents/content/'. $aRow['id']).'">'._l('edit').'</a>';
		// }
		// if (has_permission('approval_contents', '', 'edit')) {
		// $name .= ' | <a href="' . admin_url('approval_contents/approval_content/' . $aRow['id']) . '">' . _l('edit') . '</a>';
		// }
		// if ($hasPermissionDelete) {
		//     $name .= ' | <a href="'.admin_url('contents/delete/'. $aRow['id']).'" class="text-danger _delete">'._l('delete').'</a>';
		// }
		// if (has_permission('approval_contents', '', 'delete')) {
		//     $name .= ' | <a href="' . admin_url('approval_contents/delete/' . $aRow['id']) . '" class="text-danger _delete">' . _l('delete') . '</a>';
		// }
		$name .= '</div>';
		$row[] = $name;
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
		// foreach ($ids as $rows) {
		// 	if ($rows['id'] == $aRow['task_title']) {
		// 		$row[] = $rows['name'];
		// 		break;
		// 	}
		// }
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
		//$row[] = _d($aRow['datestart']);
		//$row[] = _d($aRow['dateend']);
		// $row[] = $aRow['status'];
		$status = get_content_status_by_id($aRow['status']);
		$row[] = '<span class="label label inline-block project-status-' . $aRow['status'] . '" style="color:' . $status['color'] . ';border:1px solid ' . $status['color'] . '">' . $status['name'] . '</span>';
		//$row[] = $aRow['project_id'];
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
//fix assignto
		foreach ($staff as $value) {
			if ($value['staffid'] == $aRow['assignto']) {
				$row[] = $value['firstname'] . " " . $value['lastname'];
				break;
			}
		}
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