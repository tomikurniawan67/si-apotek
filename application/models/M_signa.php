<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_signa extends CI_Model{

	function get_data($table, $where){		
		return $this->db->get_where($table, $where);
	}	
	

	function input_data($data, $table) {
		$this->db->insert($table, $data);
	}
}