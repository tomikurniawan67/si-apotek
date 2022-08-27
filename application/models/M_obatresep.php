<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_obatresep extends CI_Model{

	function get_data($table, $where){		
		return $this->db->get_where($table, $where);
	}

	function input_data($data, $table) {
		$this->db->insert($table, $data);
	}

	function update_data($where, $data, $table) {
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	function getDetailData($id_resep) {
		$qw = "
			SELECT
				obat_resep.*,
				obatalkes_m.obatalkes_nama
			FROM
				obat_resep
			INNER JOIN
				obatalkes_m
				ON 
				obatalkes_m.obatalkes_id = obat_resep.obat_id
			WHERE
				obat_resep.resep_id = ".$id_resep."
		";

		$query = $this->db->query($qw);
		return $query;
	}
}