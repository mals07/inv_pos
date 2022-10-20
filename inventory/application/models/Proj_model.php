<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proj_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function search_code($id){
      $query = $this->db->query("SELECT * FROM app WHERE app_id  = ".$id." ");
      return $query->result();
    }

    public function insert_proj($data){
      $this->db->query("call proj_ins(?,?,?,?,?,@id,@err,@msg)",$data);
      $que = $this->db->query("SELECT @id as id,@err as error , @msg as msg");
      return $que->result();
    }


    public function update_proj($data){
      $this->db->query("call proj_upd(?,?,?,?,@err,@msg)",$data);
      $que = $this->db->query("SELECT @err as error, @msg as msg");
      return $que->result();
    }

    public function loadappno(){
      $query = $this->db->query("SELECT * FROM app_proj");
      return $query->result();
    }

    public function getprojbyid($proj_id){
      $query = $this->db->query("SELECT * FROM app_proj WHERE app_proj_id = ".$proj_id." ");
      return $query->result();
    }


}