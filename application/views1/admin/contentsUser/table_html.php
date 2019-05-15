<?php

$table_data = array(
	'#',
	_l('subject'),
	_l('task_title'),
	_l('content_start_date'),
	_l('content_end_date'),
	_l('content_status'),
	_l('project_id'),
	_l('assign_to'),

);

$custom_fields = get_custom_fields('contents', array('show_on_table' => 1));

foreach ($custom_fields as $field) {
	array_push($table_data, $field['name']);
}

$table_data = do_action('contents_table_columns', $table_data);
render_datatable($table_data, (isset($class) ? $class : 'contents'), [], [
	'data-last-order-identifier' => 'contents',
	'data-default-order' => get_table_last_order('contents'),
]);
?>
