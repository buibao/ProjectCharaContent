<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Migration_Version_206 extends CI_Migration

{

         public function __construct()

    {

        parent::__construct();

    }

        public function up()
        {  
              if (!$this->db->table_exists('tblcontents')) {

                     $this->db->query("
               
             
                    CREATE TABLE `tblcontents` (
                    `id` int(11) NOT NULL,
                    `subject` varchar(255) COLLATE utf8mb4_bin NOT NULL,
                    `task_title` varchar(255) COLLATE utf8mb4_bin NOT NULL,
                    `datestart` date NOT NULL,
                    `dateend` date NOT NULL,
                    `status` int(5) NOT NULL,
                    `description` mediumtext COLLATE utf8mb4_bin NOT NULL,
                    `assignto` varchar(255) COLLATE utf8mb4_bin NOT NULL,
                    `content_type` varchar(255) COLLATE utf8mb4_bin NOT NULL,
                    `hash` varchar(32) COLLATE utf8mb4_bin NOT NULL,
                    `task_id` int(11) DEFAULT NULL,
                    `project_id` int(11) NOT NULL,
                    `file_id` int(11) NOT NULL,
                    `post_id` varchar(200) COLLATE utf8mb4_bin DEFAULT NULL,
                    `publish_time` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
                    `clientid` int(11) NOT NULL
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

                ");


                 $this->db->query('ALTER TABLE `tblcontents`
                   ADD PRIMARY KEY (`id`);');
          
                  }
            
        }

        public function down()
        {
               
        }
}