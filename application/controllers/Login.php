<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
		parent::__construct();		
		$this->load->model('m_user');
	
	}

	public function index(){
		return $this->load->view('login/v_login');
	}

	public function validasi() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$where = array(
			'username' => $username,
			'password' => md5($password)
		);

		$cek = $this->m_user->cek_login("user", $where)->num_rows();

		if($cek > 0){
			$data_session = array(
				'nama' => $username,
				'status' => "login"
			);
	
			$this->session->set_userdata($data_session);
	
			redirect(base_url("list-obat"));
	
		}else{
			$this->session->set_flashdata('error', 'Username atau password salah !');
			redirect(base_url());
		}
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
}