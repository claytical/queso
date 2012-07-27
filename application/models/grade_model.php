<?php

class Grade_model extends CI_Model {

	public function __construct() {
	//	$this->load->database();
	}


	public function get_grades() {
			$query = $this->db->query('SELECT amount, label FROM grading ORDER BY amount DESC');
			return $query->result();
	}
	
	public function get_grade($amount) {
		$query = $this->db->query("SELECT label WHERE amount >= '".$amount."' ORDER BY amount DESC LIMIT 1");
		return $query->result();
	}

	public function edit() {
		$query = $this->db->query("UPDATE grading SET amount = '', label = '' WHERE id = ''");
	}
	
	public function remove() {
		$query = $this->db->query("DELETE FROM grading WHERE id = ''");	
	}
	
	public function create() {
		$query = $this->db->query("INSERT INTO grading (amount, label) VALUES ('', '')");
	}
}