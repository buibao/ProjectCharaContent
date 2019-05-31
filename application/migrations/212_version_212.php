<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Migration_Version_212 extends CI_Migration

{

         public function __construct()

    {

        parent::__construct();

    }

        public function up()
        {  
            

$this->db->query("DELETE FROM `tblpermissions` WHERE `permissionid` = 24");
$this->db->query("DELETE FROM `tblpermissions` WHERE `permissionid` = 25");
$this->db->query("DELETE FROM `tblpermissions` WHERE `permissionid` = 26");
$this->db->query("DELETE FROM `tblpermissions` WHERE `permissionid` = 27");
$this->db->query("DELETE FROM `tblpermissions` WHERE `permissionid` = 28");
$this->db->query("DELETE FROM `tblpermissions` WHERE `permissionid` = 28");
$this->db->query("INSERT INTO `tblpermissions` (`permissionid`, `name`, `shortname`) VALUES
(24, 'Approval Content', 'approval_content'),
(25, 'Contents', 'contents'),
(26, 'CallCenter', 'callcenter'),
(27, 'KPI', 'kpi'),
(28, 'Post Facebook', 'post_facebook')");          
        }

        public function down()
        {
               
        }
}