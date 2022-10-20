<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proc extends CI_Controller {

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
		$this->load->model('proc_model');
		// $this->load->model('wus');
		// $this->load->model('sync_model');
	}

	public function index()
	{
		$this->load->view('layout/header',array('act' => 'proc'));
		$this->load->view('proc/proc_add');
		$this->load->view('layout/footer');
	}


	public function loadapps(){
		echo json_encode($this->proc_model->loadapps($this->input->post('app')));
	}

	public function loadappno(){
		echo json_encode($this->proc_model->loadappno($this->input->post('app_id')));
	}

	public function loadproc(){
		echo json_encode($this->proc_model->loadproc());
	}

	public function loadproj(){
		echo json_encode($this->proc_model->loadproj($this->input->post('app_proj_id')));
	}

	public function loadalloc(){
		echo json_encode($this->proc_model->loadalloc($this->input->post('proj_id')));
	}

	public function add_proc(){

		$data = array(
			'p_app_id'			=>	$this->input->post('p_code'),
			'p_app_no'			=>	$this->input->post('p_appno'),
			'p_proj_name'		=>	$this->input->post('proc_name'),
			'p_end_user'		=>	$this->input->post('end_user'),
			'p_proc_mode'		=>	$this->input->post('proc_mode'),
			'p_ib_rei'			=>	$this->input->post('ib_rei'),
			'p_open_bids'		=>	$this->input->post('open_bid'),
			'p_notice_awards'	=>	$this->input->post('notice_awards'),
			'p_contract_signing'=>	$this->input->post('con_sign'),
			'p_delivery'		=>	$this->input->post('delivery'),
			'p_source_funds'	=>	$this->input->post('source_fund'),
			'p_total'			=>	$this->input->post('total'),
			'p_mooe'			=>	$this->input->post('mooe'),
			'p_user_id'			=>	1,
		);

		echo json_encode($this->proc_model->insert_proc($data));
	}

	public function additional_alloc(){

		$proj_id = $this->input->post('proj_id');
		$app_data = $this->proc_model->getappdata($proj_id);

		foreach($app_data as $data){

			$app_id = $data->app_id;
			$app_code = $data->app_code;
			$app_proj_id = $data->app_proj_id;
			$app_no = $data->app_no;
			$proj_name = $data->project_name;
			$total = $data->total;

		}

		$this->load->view('layout/header',array('act' => 'proc'));
		$this->load->view('proc/add_alloc',array(
							'app_id'		=>	$app_id,
							'app_code'		=>	$app_code,
							'app_proj_id'	=>	$app_proj_id,
							'app_no'		=>	$app_no,
							'proj_name'		=>	$proj_name,
							'proj_id'		=>	$proj_id,
							'proj_amount'	=>	$total
						));
		$this->load->view('layout/footer');
	}


	public function add_alloc(){

		$data = array(
			'p_app_id'		=> $this->input->post('alloc_app'),
			'p_app_code'	=> $this->input->post('app_code'),
			'p_proj_id'		=> $this->input->post('alloc_proj'),
			'p_amount'		=> $this->input->post('add_amount'),	
			'p_user_id'		=> 1
		);

		echo json_encode($this->proc_model->insert_add_alloc($data));

	}


}

