<?php
/**
 *  Login Model
 */
class Login_model extends CI_Model
{
    
    function __construct()
    {
        parent::__construct();
    }
     function accountExist(){
         $data = $this->db->query('SELECT * FROM admin');
         if($data->num_rows() == 0){
             return true;
         }else{
             return false;
         }
     }
     function registerAdmin($username,$password){
         $password = md5($password);
        $sql = $this->db->query("INSERT INTO admin (username,password) VALUES ('$username','$password')");
        if($sql){
            return true;
        }else{
            return false;
        }
     }

     function login($username,$password){
         $password = md5($password);
       $data =  $this->db->query("SELECT * FROM admin WHERE username = '$username' AND password = '$password'");
       if($data->num_rows() == 1){
           return true;
       }else{
           return false;
       }
    }
}




?>