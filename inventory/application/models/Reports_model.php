<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports_model extends CI_Model
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

    public function loadappno(){
      $query = $this->db->query("SELECT * FROM app_proj");
      return $query->result();
    }


    public function generatesummary($year){
      $query = $this->db->query("SELECT  ap.app_id
                                        ,ap.app_code
                                        ,ap.app_year
                                        ,ap.description ap_desc
                                        ,apj.app_no
                                        ,ifnull(apj.app_proj_name,'N/A') as app_proj_name
                                        ,ifnull(pp.project_name,'N/A') as project_name
                                        ,ifnull(pp.end_user,'N/A') as end_user
                                        ,ifnull(pp.proc_mode,'N/A') as proc_mode
                                        ,ifnull(pp.ib_rei,'N/A') as ib_rei
                                        ,ifnull(pp.open_bids,'N/A') as open_bids
                                        ,ifnull(pp.notice_awards,'N/A') as notice_awards
                                        ,ifnull(pp.contract_signing,'N/A') as contract_signing
                                        ,ifnull(pp.delivery,'N/A') as delivery
                                        ,ifnull(pp.source_funds,'N/A') as source_funds
                                        ,ifnull(pp.total,0) as total
                                        ,ifnull(pp.mooe,0) as mooe
                                        ,ifnull(pv.amount,0) as procured
                                        ,ifnull(pov.amount,0) as poed
                                        ,ifnull(av.amount,0) as add_amount
                                        ,ifnull((pp.total + ifnull(av.amount,0)) - ifnull(ae.amount,0),0) AS est_remains
                                        ,ifnull((pp.total + ifnull(av.amount,0)) - ifnull(pov.amount,0),0) AS act_remains
                                    FROM app ap
                                        LEFT JOIN app_proj apj ON apj.app_id = ap.app_id
                                        LEFT JOIN procurement_projects pp ON pp.app_no = apj.app_proj_id
                                        LEFT JOIN (SELECT * FROM additionals_v) av ON av.proj_id = pp.proj_id
                                        LEFT JOIN app_entry ae ON ae.proj_id = pp.proj_id
                                        LEFT JOIN (SELECT * FROM procured_v) pv ON pv.proj_id = pp.proj_id
                                        LEFT JOIN (SELECT * FROM poed_v) pov ON pov.proj_id = pp.proj_id
                                    WHERE ap.app_year = ".$year." ");

      return $query->result();

    }

}