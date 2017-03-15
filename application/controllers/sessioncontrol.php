<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sessioncontrol extends CI_Controller {
    function __construct() {
        parent::__construct();
       
    }

    public function index() {
        $sessionkey=$this->session->userdata('logged_in');
        if($sessionkey==''){
            echo "go";
        }
        else{
            echo "stay";
        }
    }
}