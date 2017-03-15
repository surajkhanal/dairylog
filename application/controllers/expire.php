<?php if(!defined('BASEPATH')) exit("No Direct Script Access Allowed");
Class Expire extends CI_Controller{
	function __construct(){
		parent:: __construct();
	}
	public function index(){
		$this->load->view('expiredate');
	}
}