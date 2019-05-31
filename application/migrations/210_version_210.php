<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Migration_Version_210 extends CI_Migration

{

         public function __construct()

    {

        parent::__construct();

    }

        public function up()
        {  
              if (!$this->db->table_exists('tbl_client_contact')) {

                     $this->db->query("
             
                    CREATE VIEW `tbl_client_contact` AS SELECT
                  cl.`company`,ct.`lastname`,ct.`firstname`,concat(ct.lastname,' ',ct.firstname) as fullname ,ct.phonenumber as phonecontact,cl.phonenumber as phoneclient
                  FROM `tblcontacts` AS ct 
                  INNER JOIN `tblclients` AS cl 
                  ON ct.userid = cl.userid

                    ");
          
                  }
            
        }
        public function down()
        {
               
        }
}