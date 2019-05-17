<?php


defined('BASEPATH') or exit('No direct script access allowed');


class Migrations extends CI_Controller {

      public function __construct()

    {

        parent::__construct();

    }
    public function index()
    {
        // load migration library
        $this->load->library('migration');

        if ( ! $this->migration->current())
        {
            echo 'Error' . $this->migration->error_string();
        } else {
            echo 'Migrations ran successfully!';
        }  
    }    
}
?>