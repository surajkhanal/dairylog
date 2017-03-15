<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dbsetup extends CI_Controller {
    public function index(){
        
        $fp = file('database/diarylog.sql', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$query = '';
$u=0;
foreach ($fp as $line) {
    if ($line != '' && strpos($line, '--') === false) {
        $query .= $line;
        if (substr($query, -1) == ';') {
            $this->db->query($query);
            $query = '';
        }
    }
    $u++;
}
if($u>0){
    redirect('login');
}
    }
}
