<?php
$CI = get_instance();
$CI->load->add_package_path(callcenter_get_base_path());


function callcenter_get_base_path() {
    return str_replace("application".DIRECTORY_SEPARATOR, "", APPPATH).'plugins/callcenter';
}

?>
