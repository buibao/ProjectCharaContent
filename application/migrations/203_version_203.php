<?php



defined('BASEPATH') or exit('No direct script access allowed');



class Migration_Version_203 extends CI_Migration

{

         public function __construct()

    {

        parent::__construct();

    }

        public function up()
        {  
              if (!$this->db->table_exists('tblcalllog')) {

                     $this->db->query("
               
                CREATE TABLE `tblcalllog` (
                  `cdr_id` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                  `call_id` varchar(100) DEFAULT NULL,
                  `cause` varchar(50) DEFAULT NULL,
                  `q850_cause` varchar(50) DEFAULT NULL,
                  `from_extension` varchar(100) DEFAULT NULL,
                  `to_extension` varchar(100) DEFAULT NULL,
                  `from_number` varchar(100) DEFAULT NULL,
                  `to_number` varchar(100) DEFAULT NULL,
                  `duration` int(11) DEFAULT '0',
                  `direction` varchar(100) DEFAULT NULL,
                  `time_start` date DEFAULT NULL,
                  `time_connect` date DEFAULT NULL,
                  `time_end` date DEFAULT NULL,
                  `time_started` varchar(50) DEFAULT NULL,
                  `time_connected` varchar(50) DEFAULT NULL,
                  `time_ended` varchar(50) DEFAULT NULL,
                  `recording_path` varchar(500) NOT NULL,
                  `recording_url` varchar(500) NOT NULL,
                  `record_file_size` varchar(100) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                ");


                 $this->db->query('ALTER TABLE `tblcalllog`
                ADD PRIMARY KEY (`cdr_id`);');
          
                  }
            
        }

        public function down()
        {
               
        }
}