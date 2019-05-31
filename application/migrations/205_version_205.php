<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Migration_Version_205 extends CI_Migration

{

         public function __construct()

    {

        parent::__construct();

    }

        public function up()
        {  
              if (!$this->db->table_exists('tblconfigkpi')) {

                     $this->db->query("
               
             
                    CREATE TABLE `tblconfigkpi` (
                      `id` int(11) NOT NULL,
                      `target` int(20) DEFAULT NULL
                    ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

                ");


                 $this->db->query('ALTER TABLE `tblconfigkpi`
                ADD PRIMARY KEY (`id`);');
          
                  }
            
        }

        public function down()
        {
               
        }
}