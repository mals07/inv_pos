<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

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
		$this->load->model('app_model');
		// $this->load->model('wus');
		// $this->load->model('sync_model');
	}

	public function index()
	{
		$this->load->view('layout/header',array('act' => 'app'));
		$this->load->view('app/app_add');
		$this->load->view('layout/footer');
	}

	public function add_app(){

		$data = array(
			 ':p_app_code'		=> 	$this->input->post('app_code')
			,':p_app_no'		=>	$this->input->post('app_no')
			,':p_app_year'		=>	$this->input->post('app_year')
			,':p_description'	=>	$this->input->post('app_description')
			,':p_user_id'		=> 	1
		);
		echo json_encode($this->app_model->insert_app($data));
	}


	public function getapp(){

		echo json_encode($this->app_model->getappbyid($this->input->post('app_id')));

	}


	public function edit_app(){

		$data = array(
			 ':p_app_id'		=>	$this->input->post('e_app_id')
			,':p_app_year'		=>	$this->input->post('e_year')
			,':p_app_code'		=>	$this->input->post('e_code')
			,':p_description'	=>	$this->input->post('e_description')
			,':p_user_id'		=>	1
		);
		echo json_encode($this->app_model->update_app($data));

	}


	public function loadcodes(){
		echo json_encode($this->app_model->load_codes());
	}


}

