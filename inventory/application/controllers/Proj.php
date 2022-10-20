<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proj extends CI_Controller {

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
		// $this->load->model('wus');
		// $this->load->model('sync_model');
	}

	public function index()
	{

		$apps = $this->proj_model->search_code($this->input->post('app_id'));
		foreach($apps AS $data){
			$id 	= 	$data->app_id;
			$code 	= 	$data->app_code;
			$year	=	$data->app_year;
		}

		$this->load->view('layout/header',array('act' => 'app'));
		$this->load->view('proj/proj_add',array(
							'app_id'	=>	$id,
							'app_code'	=>	$code,
							'app_year'	=> 	$year
						  ));
		$this->load->view('layout/footer');
	}

	public function add_proj(){

		$data = array(
					 ':p_app_id'		=>	$this->input->post('p_app_id')
					,':p_app_code'		=>	$this->input->post('p_code')
					,':p_app_no'		=>	$this->input->post('p_app_no')
					,':p_description'	=>	$this->input->post('p_description')
					,':p_user_id'		=>	1
				);

		echo json_encode($this->proj_model->insert_proj($data));

	}

	public function loadappno(){

		echo json_encode($this->proj_model->loadappno());

	}


	public function getproj(){

		echo json_encode($this->proj_model->getprojbyid($this->input->post('proj_id')));

	}

	public function edit_proj(){

		$data = array(
			 ':p_app_proj_id'	=>	$this->input->post('e_proj_id')
			,':p_app_no'		=>	$this->input->post('eproj_app_no')
			,':p_app_proj_name'	=>	$this->input->post('eproj_description')
			,':p_user_id'		=>	1
		);

		echo json_encode($this->proj_model->update_proj($data));

	}


}

