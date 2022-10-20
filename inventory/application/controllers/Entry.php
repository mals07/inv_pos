<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entry extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {
		parent::__construct();
		$this->load->model('proj_model');
		$this->load->model('entry_model');
		// $this->load->model('wus');
		// $this->load->model('sync_model');
	}

	public function index()
	{

		$this->load->view('layout/header',array('act'	=>	'entry'));
		$this->load->view('entry/add_entry');
		$this->load->view('layout/footer');
	}

	public function add_entry(){

		$data = array(
					 ':p_app_id'		=>	$this->input->post('entry_app')
					,':p_app_proj_id'	=>	$this->input->post('entry_appno')
					,':p_proj_id'		=>	$this->input->post('entry_proj')
					,':p_entry_type'	=>	$this->input->post('entry_type')
					,':p_particulars'	=>	$this->input->post('particulars')
					,':p_amount'		=>	$this->input->post('entry_amount')
					,':p_year'			=>	$this->input->post('entry_year')
					,':p_user_id'		=>	1
				);

		echo json_encode($this->entry_model->insert_entry($data));

	}

	public function loadappno(){

		echo json_encode($this->proj_model->loadappno());

	}

	public function loadentry(){
		echo json_encode($this->entry_model->loadentry());
	}


}

