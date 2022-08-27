<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signa extends CI_Controller {
	function __construct(){
		parent::__construct();
	
		$this->load->model('m_user');
		$this->load->model('m_signa');

		if($this->session->userdata('status') != "login"){
			redirect(base_url());
		}
	}

	public function index()
	{
		$where = array(
			'is_active' => 1,
			'is_deleted' => 0
		);

		$get_signa = $this->m_signa->get_data('signa_m', $where);
		$data['signa'] = $get_signa->result();

		$this->load->view('home/header');
		$this->load->view('signa/v_signa', $data);
		$this->load->view('home/footer');
	}

}
