<?php

/**
 * -============dash model-------------------
 */
class Dash_model extends CI_Model
{
    
    function __construct()
    {
        # code...
        parent::__construct();
    }


    function register_user($name,$address,$phone){
      $data = array(
        'name' => $name ,
        'address' => $address ,
        'phone' => $phone
        );

        $status = $this->db->insert('users', $data); 
        if($status){
            return true;
        }else{
            return false;
        }
    }

    function update_user($id){
        $data = array(
               'name' => $this->input->post('name'),
               'address' => $this->input->post('address'),
               'phone' => $this->input->post('phone')
            );
        $res = $this->db->update('users', $data, array('id' => $id));
        if($res) {
            return true;
        }else{
            return false;
        }
    }
    function getAlluser(){
        $res = $this->db->query("SELECT * FROM users");
        if($res->num_rows()>0){
            return $res->result();
        }
    }

    function delete_user($id){
       $res = $this->db->delete('users', array('id' => $id));
       if($res){
           return true;
       } else{
           return false;
       }
    }

    function get_settings(){
      $res = $this->db->query("SELECT * FROM settings");
      if($res->num_rows()>0){
        return $res->row();
      }
    }
     function getsettings(){
      $res = $this->db->query("SELECT * FROM settings");
      if($res->num_rows()>0){
        return $res;
      }
    }
    function save_settings($id,$fat,$snf){
      if($id){
           $data = array(
                     'snf' => $snf,
                     'fat' => $fat
                  );

        $this->db->where('id', $id);
        $res = $this->db->update('settings', $data); 
        if($res){
          return true;
        }else{
          return false;
        }
      }else{
         $data = array(
                     'snf' => $snf,
                     'fat' => $fat
                  );
         $res = $this->db->insert('settings', $data);
         if($res){
          return true;
         } else {
          return false;
         }
      }
   
    }

    function saveRecord($id,$date,$milkType,$quantity,$fat,$snf,$ts,$price_for_one_litre,$price_for_one_litre_with_ts,$totalprice){
      $data = array(
         'user_id' => $id ,
         'date' => $date ,
         'milktype'=>$milkType,
         'quantity'=>$quantity,
         'fat' => $fat,
         'snf'=> $snf,
         'raw_price'=>$price_for_one_litre,
         'ts'=> $ts,
         'price_with_ts'=>$price_for_one_litre_with_ts,
         'totalprice'=>$totalprice
      );
     $this->db->trans_start();
     $this->db->insert('report', $data); 
     $reportinsert=$this->db->insert_id();
     if($reportinsert==TRUE){
      return true;
     }
     // $this->db->query("INSERT INTO ledger(user_id,debit,credit,balance) VALUES($id,'0','$total','$totalBalance')");
     // $ledger = $this->db->insert_id();
     // $this->db->trans_complete();
     // if($reportinsert==TRUE && $ledger==TRUE){
     //  return true;
     // } 
    }
    // get specific farmer data for daily entry
    function getDataForDailyEntry($searchkey){
      $query=$this->db->query("SELECT * FROM report WHERE user_id='$searchkey' ORDER BY date DESC");
      return $query->result();
    }
    function reportCount($searchkey){
      $query=$this->db->query("SELECT COUNT(*) as nor FROM report WHERE user_id='$searchkey");
      return $query->result();
    }
    function getDataForReport($fromdate,$todate,$userid,$order,$sort,$offset,$rows){
      $query=$this->db->query("SELECT * FROM report WHERE (date BETWEEN '$fromdate' AND '$todate') AND(user_id='$userid') ORDER BY $sort $order limit $offset,$rows");
      return $query->result();
    }
    function reportForledger($rows,$sort,$offset,$order,$userid){
      $query=$this->db->query("SELECT ledger.*,users.id,(users.name) as fname FROM ledger, users WHERE ledger.user_id='$userid' AND users.id='$userid' ORDER BY ledger.id DESC LIMIT 1");
      return $query->result();
    }
    function ledgeramount($id){
      $query=$this->db->query("SELECT * FROM ledger WHERE user_id='$id' ORDER BY id DESC LIMIT 1");
      foreach($query->result() as $row){
        return $row->balance;
      }
    }
    function ledgerPayment($id,$amount,$totalBalance){
      $query=$this->db->query("INSERT INTO ledger(user_id,debit,credit,balance) VALUES('$id','$amount','0','$totalBalance')");
      return true;
    }






}//end class
