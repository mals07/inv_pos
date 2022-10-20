<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert_app($data){
      $this->db->query("call app_ins(?,?,?,?,?,@id,@err,@msg)",$data);
      $que = $this->db->query("SELECT @id as id,@err as error , @msg as msg");
      return $que->result();
    }

    public function load_codes(){
      $query = $this->db->query("SELECT * FROM app");
      return $query->result();
    }

    public function getappbyid($app_id){
      $query = $this->db->query("SELECT * FROM app WHERE app_id = ".$app_id." ");
      return $query->result();
    }

    public function update_app($data){
      $this->db->query("call app_upd(?,?,?,?,?,@err,@msg)",$data);
      $que = $this->db->query("SELECT @err as error , @msg as msg");
      return $que->result();
    }


}