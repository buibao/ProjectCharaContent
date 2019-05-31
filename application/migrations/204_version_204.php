<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Migration_Version_204 extends CI_Migration

{

         public function __construct()

    {

        parent::__construct();

    }

        public function up()
        {  
              if (!$this->db->table_exists('tblconfigcall')) {

                     $this->db->query("
               
               CREATE TABLE `tblconfigcall` (
                `id` int(11) NOT NULL,
                `Ext` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
                `Pass` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
                `APIKey` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
                `APISecret` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
                `Token` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

                ");


                 $this->db->query('ALTER TABLE `tblconfigcall`
                                ADD PRIMARY KEY (`id`);');
          
                  }
            
        }

        public function down()
        {
               
        }
}