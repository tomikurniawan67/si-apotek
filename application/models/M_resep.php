<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_resep extends CI_Model{

	function get_data($table, $where){
		if(!empty($where)) {
			return $this->db->get_where($table, $where);
		} else {
			return $this->db->get($table);
		}
	}	
	

	function input_data($data, $table) {
		$this->db->insert($table, $data);
		$insert_id = $this->db->insert_id();

		return $insert_id;
	}

	function get_resep() {
		$qw = "
			SELECT
				resep.*,
				signa_m.signa_nama
			FROM
				resep
			INNER JOIN
				signa_m
				ON 
				signa_m.signa_id = resep.signa_id
		";

		$query = $this->db->query($qw);
		return $query;
	}

	function getDetailData($id) {
		$qw = "
			SELECT
				resep.*,
				signa_m.signa_nama
			FROM
				resep
			INNER JOIN
				signa_m
				ON 
				signa_m.signa_id = resep.signa_id
			WHERE
				resep.id = ".$id."
		";

		$query = $this->db->query($qw);
		return $query;
	}
}