<?php
 if( !defined('BASEPATH')) exit('No direct script acess allowed');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if(!function_exists('systemSessionCheck')){
     function systemSessionCheck() 
    {
        
        
        $ci=& get_instance();
        $ci->load->library('session');
      
      if($ci->session->userdata('logged_in')==FALSE)
                {
                   $ci->session->sess_destroy();
                 redirect('login');
                    exit();
                }
                else
                {
                    return false;
                }
}
function sessioncheckonsubmit(){
     $ci=& get_instance();
        $ci->load->library('session');
       // print_r($ci->session->all_userdata());
     
  if($ci->session->userdata('logged_in')==FALSE)
                {
              echo json_encode(array('errorMsg' => 'Your Session Has Been Expired Please Login'));
 exit();
  } else{
      return TRUE;
  } 
}
}
?>