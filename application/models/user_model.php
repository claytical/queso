<?php

class User_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function get_info($id = 0) {
		if ($id == 0) {
			//return all user records
			$query = $this->db->query('SELECT id, username FROM users');
			return $query->result();

		}
		else {
			//return specific record
			$query = $this->db->query("SELECT users.id, username, first_name, last_name FROM users LEFT JOIN meta ON users.id = user_id WHERE users.id = '".$id."'");
			return $query->row_array();

		}
	}


}