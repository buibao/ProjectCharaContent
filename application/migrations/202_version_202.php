<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Migration_Version_202 extends CI_Migration

{

    public function __construct()

    {

        parent::__construct();

    }



    public function up()

    {

      


        if (!$this->db->table_exists('tblcontents')) {

            $this->db->query("CREATE TABLE `tblcontents` (

             `id` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `task_title` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `datestart` date DEFAULT NULL,
  `dateend` date DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `description` varchar(5000) COLLATE utf8mb4_bin DEFAULT NULL,
  `assignto` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `content_type` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  `hash` varchar(32) COLLATE utf8mb4_bin DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;");



 


            $this->db->query('ALTER TABLE `tblcontents`
  ADD PRIMARY KEY (`id`);');

            $this->db->query('ALTER TABLE `tblcontents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;');

        }





        if (file_exists(FCPATH . 'pipe.php')) {

            @chmod(FCPATH . 'pipe.php', 0755);

        }

    }
     public function down()
    {
        $this->dbforge->drop_table('tblcontents');
    }

}

