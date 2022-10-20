<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entry_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert_entry($data){
      $this->db->query("call entry_ins(?,?,?,?,?,?,?,?,@id,@err,@msg)",$data);
      $que = $this->db->query("SELECT @id as id, @err as error, @msg as msg");
      return $que->result();
    }

    public function loadentry(){
    	$query = $this->db->query("SELECT 
					  ae.entry_id
					 ,ae.year
					 ,ae.entry_type
					 ,ae.amount
					 ,ae.app_no
					 ,ap.app_code
					 ,pp.project_name
					 ,apj.app_proj_name
					FROM app_entry ae 
					 INNER JOIN app ap ON ap.app_id = ae.app_id
					 INNER JOIN app_proj apj ON apj.app_proj_id = ae.app_proj_id
					 INNER JOIN procurement_projects pp ON pp.proj_id = ae.proj_id");

		return $query->result();
    }


}