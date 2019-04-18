<?php

$table_data = array(
   '#',
   _l('subject'),
   _l('task_title'),
   _l('content_start_date'),
   _l('content_end_date'),
   _l('content_status'),
   _l('assign_to'),
 
);

$custom_fields = get_custom_fields('approval_contents',array('show_on_table'=>1));

 foreach($custom_fields as $field){
   array_push($table_data,$field['name']);
 }

 $table_data = do_action('approval_contents_table_columns',$table_data);
 render_datatable($table_data, (isset($class) ? $class : 'approval_contents'),[],[
    'data-last-order-identifier' => 'approval_contents',
    'data-default-order'         => get_table_last_order('approval_contents'),
 ]);
 ?>
