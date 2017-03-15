<?php

/**
 * dashboard controller
 */
class Dashboard extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('dash_model');
        $this->load->helper('sessioncheck_helper');
        systemSessionCheck();
    }

    public function index(){

        $data['activation_key'] = 1;
       
       $this->load->view('header',$data);
       $this->load->view('dashboard');
       $this->load->view('footer');
    }

    public function register(){
         $data['activation_key'] = 2;
        $this->load->view('header',$data);
        $this->load->view('register');
       $this->load->view('footer');
    }
    public function entry(){
        $data['activation_key'] = 3;
        $data['user_list'] = $this->get_all_users();
        $this->load->view('header',$data);
         $this->load->view('footer');
        $this->load->view('daily_entry');
         // $this->load->view('dairyentry');
       
    }
    public function report(){
        $data['activation_key']=4;
        $this->load->view('header',$data);
        $this->load->view('footer');
        $this->load->view('report');
      
    }
    // function for reteriving user report
    public function getSpecificFarmerReport(){
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 15;
    $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'name';
    $order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
    $searchkey=isset($_POST['searchkey']) ? mysql_real_escape_string($_POST['searchkey']) :'';
    $offset = ($page-1)*$rows;
    $result=array();
    // $totalReportCount=$this->dash_model->reportCount($searchkey);
    $report=$this->dash_model->getDataForDailyEntry($searchkey);
    foreach($report as $row){
        array_push($result,$row);
    }
    echo json_encode($result);

    }
    public function payment(){
        $data['activation_key']=5;
        $this->load->view('header',$data);
        $this->load->view('payment');
    }
    public function paymentreport(){
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 15;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
        $userid=isset($_POST['userid']) ? mysql_real_escape_string($_POST['userid']) :'';
        $offset=($page-1)*$rows;
        $result=array();
        $data=$this->dash_model->reportForledger($rows,$sort,$offset,$order,$userid);
        foreach($data as $row){
            array_push($result,$row);
        }
        echo json_encode($result);
    }
    public function ledgerPayment(){
        $id=$this->input->get('id');
        $amount=$this->input->post('paymentamount');
        $ledgeramount=$this->dash_model->ledgeramount($id);
        $totalBalance=$ledgeramount-$amount;
        $data=$this->dash_model->ledgerPayment($id,$amount,$totalBalance);
        if($data==true){
            echo json_encode(array('successMsg'=>'Successfully saved!!'));
        }else{
            echo json_encode(array('errorMsg'=>'Internal Server Error!!'));
        }
    }
    public function settings(){
         $data['rate'] = $this->get_rate();
        $data['activation_key'] = 6;
        $this->load->view('header',$data);
        $this->load->view('footer');
        $this->load->view('settings');
    }

    public function saveSettings(){
        $id = $this->input->post('id');
        $fat = $this->input->post('fat');
        $snf = $this->input->post('snf');
        $data = $this->dash_model->save_settings($id,trim($fat),trim($snf));
        if($data){
            echo json_encode(array('successMsg'=>'success'));
        } else{
            echo json_encode(array('successMsg'=>'error'));
        }

    }
    public function register_user(){
        $name = $this->input->post('name');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $data = $this->dash_model->register_user($name,$address,$phone);
        if($data){
            echo json_encode(array('successMsg'=>'Successfully saved'));
        }else{
            echo json_encode(array('errorMsg'=>'Error! Cannot save data'));
        }
    }

    public function get_users(){
        $data = $this->dash_model->getAlluser();
        $items = array();
        foreach($data as $row){
            array_push($items,$row);
        }
        //return $items;
         echo json_encode($items);
    }

    public function get_all_users(){
         $data = $this->dash_model->getAlluser();
        $items = array();
        if(!empty($data)){
            foreach($data as $row){
                array_push($items,$row);
            }
            return $items;
        }else {
            return 'noUser';
        }
        
    }

    public function delete_user(){
        $id = $this->input->post('id');
        $data = $this->dash_model->delete_user($id);
        if($data){
            echo json_encode(array('success'=>'true'));
        }else{
            echo json_encode(array('errorMsg'=>'Cannot delete the user'));
        }
    }

    public function update_user(){
        $id = $this->input->get('id');
        $data = $this->dash_model->update_user($id);
        if($data){
            echo json_encode(array('success'=>'true'));
        }else{
            echo json_encode(array('errorMsg'=>'Cannot update data'));
        }
    }


    public function get_rate(){
        $data= $this->dash_model->get_settings();
       
        return $data;
    }
    public function getReportDatewise(){
        $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 14;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'user_id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'desc';
        $fromdate=isset($_POST['fromDate']) ? mysql_real_escape_string($_POST['fromDate']) :'';
        $todate=isset($_POST['toDate']) ? mysql_real_escape_string($_POST['toDate']) :'';
        $userid=isset($_POST['userid']) ? mysql_real_escape_string($_POST['userid']) :'';
        $offset=($page-1)*$rows;
        $result=array();
        $report=$this->dash_model->getDataForReport($fromdate,$todate,$userid,$order,$sort,$offset,$rows);
        foreach($report as $row){
            array_push($result, $row);
        }
        echo json_encode($result);
    }

/*--------------------------code for daily entry part--------------------------------------*/
public function insertRecord(){
    $id = $this->input->post('fid');
    $date = $this->input->post('date');
    $milkType = $this->input->post('milk_type');
    $quantity = $this->input->post('quantity');
    $fat = $this->input->post('fat');
    $snf = $this->input->post('snf');
    $ts = $this->input->post('ts');

    $fatcnf=$this->dash_model->getsettings();
    foreach($fatcnf->result() as $row){
        $fatRupee=$row->fat;
        $snfRupee=$row->snf;
    }

    $price_for_one_litre = ($fatRupee*$fat) + ($snfRupee*$snf);
    $price_for_one_litre_with_ts = $price_for_one_litre+$ts;
    $totalprice = $price_for_one_litre_with_ts*$quantity;

    $res = $this->dash_model->saveRecord($id,$date,$milkType,$quantity,$fat,$snf,$ts,$price_for_one_litre,$price_for_one_litre_with_ts,$totalprice);

    // $balance=$this->db->query("SELECT balance FROM ledger WHERE user_id='$id' ORDER BY id DESC LIMIT 1");
    // $totalbalance=0;
    // if($balance->num_rows()>0){
    //   foreach($balance->result() as $row){
    //     $totalbalance= $row->balance;
    //   }  
    // }
    // $totalBalance=$total+$totalbalance;
    // $res = $this->dash_model->saveRecord($id,$date,$fat,$snf,$ts,$total,$totalBalance);
    if($res==true){
        echo json_encode(array('successMsg'=>'success'));
        }
    }
}// end of class






?>