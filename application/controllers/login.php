<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('login_model');
	}
	public function index()
	{	
		$firstTime = $this->login_model->accountExist();
		if($firstTime){
			$this->load->view('setup');
		}else{
			$this->load->view('login');
		}
		
	}
	public function setup(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$res = $this->login_model->registerAdmin($username,$password);
		if($res){
			//redirect('/login');
			echo json_encode(array('Msg' => true));
		}else{
			echo json_encode(array('Msg' => false));
		}
	}
	public function check(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$currentdate=date("Y-m-d");
		$year=date("Y");
		$month=date("m");
		$day=date("d")+10;
		if($day>'32'){
			$newmonth=$month+1;
			$newday=$day-32;
		}else{
			$newmonth=$month;
			$newday=$day;
		}
		$expireDate=$year.'-'.$newmonth.'-'.$newday;
		if(strtotime($currentdate)<=strtotime($expireDate)){
						$data = $this->login_model->login($username,$password);
						
						if($data == true){
							$newdata = array(
				                   'username'  => $username,
				                   'logged_in' => TRUE
				               );
						$this->session->set_userdata($newdata);
							   
							//redirect('dashboard');
						  echo json_encode(array('Msg'=>'success'));
						}else{
							echo json_encode(array('Msg'=>'error'));
						}
		}else{
			echo json_encode(array('Msg'=>'expire'));
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */