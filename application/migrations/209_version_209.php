<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Migration_Version_209 extends CI_Migration

{

         public function __construct()

    {

        parent::__construct();

    }

        public function up()
        {  
              if (!$this->db->table_exists('tblprojecttype')) {

                     $this->db->query("
               
             
                    CREATE TABLE `tblprojecttype` (
                      `id` int(11) NOT NULL,
                      `name` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
                    ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

                ");


                 $this->db->query('ALTER TABLE `tblprojecttype`
  ADD PRIMARY KEY (`id`);');   
                 $this->db->query('ALTER TABLE `tblprojecttype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');
          
                  }
            
        }

        public function down()
        {
               
        }
}