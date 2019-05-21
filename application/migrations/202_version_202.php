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
                if (!$this->db->table_exists('tblaccesstokens')) {

                     $this->db->query("
               
                 CREATE TABLE `tblaccesstokens` (
                  `id` int(11) NOT NULL,
                  `token` text NOT NULL,
                  `status` bit(1) NOT NULL,
                  `modified_date` datetime NOT NULL
                ) ENGINE=MyISAM DEFAULT CHARSET=latin1;

                ");


          $this->db->query('ALTER TABLE `tblaccesstokens`
                        MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;');

                  }

        }

        public function down()
        {
               // $this->dbforge->drop_table('blog');
        }
}