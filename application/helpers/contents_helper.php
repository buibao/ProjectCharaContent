<?php  
function get_content_status_by_id($id)
{
    $CI = &get_instance();
    if (!class_exists('contents_model')) {
        $CI->load->model('contents_model');
    }

    $statuses = $CI->contents_model->get_content_statuses();

    $status = [
          'id'         => 0,
          'color' => '#333',
          'name'       => '[Status Not Found]',
          'order'      => 1,
      ];

    foreach ($statuses as $s) {
        if ($s['id'] == $id) {
            $status = $s;

            break;
        }
    }

    return $status;
}