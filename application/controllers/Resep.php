<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resep extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->load->model('m_user');
		$this->load->model('m_resep');
		$this->load->model('m_signa');
		$this->load->model('m_obat');
		$this->load->model('m_obatresep');
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url());
		}
	}

	public function index()
	{
		$where = NULL;

		$get_resep = $this->m_resep->get_resep();
		$data['resep'] = $get_resep->result();

		$this->load->view('home/header');
		$this->load->view('resep/v_resep', $data);
		$this->load->view('home/footer');
	}

	public function add() {
		$where = array(
			'is_active' => 1,
			'is_deleted' => 0
		);

		$get_signa = $this->m_signa->get_data('signa_m', $where);
		$data['signa'] = $get_signa->result();

		$get_obat = $this->m_obat->get_data('obatalkes_m', $where);
		$data['obat'] = $get_obat->result();

		$this->load->view('home/header');
		$this->load->view('resep/add_resep', $data);
		$this->load->view('home/footer');
	}

	public function store() {
		$resep = $this->input->post('resep');
		$jenis_resep = $this->input->post('jenis_resep');
		$dosis = $this->input->post('dosis');
		$obat = $this->input->post('obat');
		$ambil_stok = $this->input->post('ambil_stok');

		$data_resep = array(
			'nama_resep' => $resep,
			'signa_id' => $dosis,
			'jenis' => $jenis_resep,
		);

		/* INPUT RESEP */ 
		$id_resep = $this->m_resep->input_data($data_resep, 'resep');

		for ($i = 0; $i < count($obat); $i++) { 
			/* INSERT OBAT */
			$data_input = array(
				'obat_id' => $obat[$i],
				'resep_id' => $id_resep,
				'qty_obat' => $ambil_stok[$i]
			);

			$this->m_obatresep->input_data($data_input, 'obat_resep');


			/* UPDATE OBAT */
			$where = array(
				'obatalkes_id' => $obat[$i]
			);
			$get_obat = $this->m_obat->get_data('obatalkes_m', $where)->row();
			$stok = $get_obat->stok;

			$last_stok = $get_obat->stok - $ambil_stok[$i];

			$data_update = array(
				'stok' => $last_stok
			);
			
			$where_obat = array(
				'obatalkes_id' => $obat[$i]
			);

			$get_obat = $this->m_obat->update_data($where_obat, $data_update, 'obatalkes_m');
		}

		return redirect('resep/detail/'.$id_resep);
	}

	public function show($id) {
		$resep = $this->m_resep->getDetailData($id)->row();

		$where = array(
			'resep_id' => $id
		);
		$obat_resep = $this->m_obatresep->getDetailData($id)->result();

		$data['resep'] = $resep;
		$data['obat_resep'] = $obat_resep;

		$this->load->view('home/header');
		$this->load->view('resep/view_resep', $data);
		$this->load->view('home/footer');
	}

	public function print_resep($id) {
		$resep = $this->m_resep->getDetailData($id)->row();

		$where = array(
			'resep_id' => $id
		);
		$obat_resep = $this->m_obatresep->getDetailData($id)->result();

		$data['resep'] = $resep;
		$data['obat_resep'] = $obat_resep;

		$this->load->view('resep/print_resep', $data);
	}
}
