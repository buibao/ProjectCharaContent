<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Migration_Version_208 extends CI_Migration

{

         public function __construct()

    {

        parent::__construct();

    }

        public function up()
        {  
              if (!$this->db->table_exists('tblcustomerfields_in')) {

                     $this->db->query("
               
             
                    CREATE TABLE `tblcustomerfields_in` (
                    `id` int(10) NOT NULL,
                    `fieldid` int(10) NOT NULL,
                    `customer_id` int(10) NOT NULL
                  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

                ");


                 $this->db->query('ALTER TABLE `tblcustomerfields_in`
  ADD PRIMARY KEY (`id`);');                
                 $this->db->query('ALTER TABLE `tblcustomerfields_in`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;');
          
                  }
            
        }

        public function down()
        {
               
        }
}