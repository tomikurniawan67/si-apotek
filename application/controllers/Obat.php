<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obat extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->load->model('m_user');
		$this->load->model('m_obat');

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

		$get_obat = $this->m_obat->get_data('obatalkes_m', $where);
		$data['obat'] = $get_obat->result();

		$this->load->view('home/header');
		$this->load->view('obat/v_obat', $data);
		$this->load->view('home/footer');
	}

	public function get_stok($id) {
		$where = array(
			'obatalkes_id' => $id
		);

		$get_obat = $this->m_obat->get_data('obatalkes_m', $where)->row();

		echo $get_obat->stok;
	}
}
