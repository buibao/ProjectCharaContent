<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Migration_Version_211 extends CI_Migration

{

         public function __construct()

    {

        parent::__construct();

    }

        public function up()
        {  
              if (!$this->db->table_exists('tblprojecttype')) {

$this->db->query("ALTER TABLE `tblclients` ADD `facebook` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL");
$this->db->query("ALTER TABLE `tblcontacts` ADD `facebook` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL");
$this->db->query("ALTER TABLE `tblcontracts` ADD `contract_status` int(11) NOT NULL");

$this->db->query("ALTER TABLE `tblprojects` ADD `addedfrom` int(11) NOT NULL,
 ADD  `project_type` int(11) NOT NULL,
 ADD `link_web` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
 ADD `link_page` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
 ADD `fanpage_id` varchar(50) DEFAULT NULL,
 ADD `fanpage_name` text");

$this->db->query("ALTER TABLE `tblstaff` ADD `leader_id` int(11) NOT NULL,ADD `intern` int(11) NOT NULL DEFAULT '0'");
$this->db->query("ALTER TABLE `tblstafftasks` ADD `count` int(11) NOT NULL, ADD `approveId` int(11) NOT NULL");

          
                  }
            
        }

        public function down()
        {
               
        }
}