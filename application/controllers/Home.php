<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
	
		if($this->session->userdata('status') != "login"){
			redirect(base_url());
		}
	}

	public function index()
	{
		$this->load->view('home/header');
		$this->load->view('home/index');
		$this->load->view('home/footer');
	}

}
