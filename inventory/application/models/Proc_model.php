<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proc_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    public function loadapps($year){
      $query = $this->db->query("SELECT * FROM app WHERE app_year = ".$year." ");
      return $query->result();
    }

    public function loadappno($app_id){
      $query = $this->db->query("SELECT * FROM app_proj WHERE app_id = ".$app_id." ");
      return $query->result();
    }

    public function loadproj($app_proj_id){
      $query = $this->db->query("SELECT * FROM procurement_projects WHERE app_no = ".$app_proj_id." ");
      return $query->result();
    }

    public function loadalloc($proj_id){
      $query = $this->db->query("SELECT * FROM app_additionals WHERE proj_id = ".$proj_id." ");
      return $query->result();
    }

    public function insert_proc($data){
      $this->db->query("call proc_ins(?,?,?,?,?,?,?,?,?,?,?,?,?,?,@id,@err,@msg)",$data);
      $que = $this->db->query("SELECT @id as id,@err as error , @msg as msg");
      return $que->result();
    }

    public function loadproc(){
      $query = $this->db->query("SELECT pp.*,apj.app_no apj_no, ap.app_code app_code FROM procurement_projects pp
                                INNER JOIN app_proj apj ON apj.app_proj_id = pp.app_no
                                INNER JOIN app ap ON ap.app_id = pp.app_id");
      return $query->result();
    }

    public function getappdata($id){
      $query = $this->db->query(" SELECT 
                                       ap.app_code
                                      ,ap.app_id
                                      ,apj.app_proj_id
                                      ,apj.app_no
                                      ,pp.project_name
                                      ,pp.total
                                  FROM app ap
                                  inner JOIN procurement_projects pp ON ap.app_id = pp.app_id
                                  inner join app_proj apj ON apj.app_proj_id = pp.app_no
                                  where pp.proj_id = ".$id." ");
      return $query->result();
    }


    public function insert_add_alloc($data){
      $this->db->query("call add_alloc_ins(?,?,?,?,?,@id,@err,@msg)",$data);
      $que = $this->db->query("SELECT @id as id, @err as error, @msg as msg");
      return $que->result();
    }


}