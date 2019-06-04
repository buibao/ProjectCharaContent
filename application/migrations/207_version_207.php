<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Migration_Version_207 extends CI_Migration

{

         public function __construct()

    {

        parent::__construct();

    }

        public function up()
        {  
              if (!$this->db->table_exists('tblcustomerfields')) {

                     $this->db->query("
               
             
                    CREATE TABLE `tblcustomerfields` (
                      `id` int(10) NOT NULL,
                      `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
                    ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

                ");


                 $this->db->query('ALTER TABLE `tblcustomerfields`
                 ADD PRIMARY KEY (`id`);');

                   $this->db->query('ALTER TABLE `tblcustomerfields`
                   MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;');

          
                  }
            
        }

        public function down()
        {
               
        }
}