<?php

class Course_model extends CI_Model {

	public function __construct() {

	}

	public function get_variable($id) {
		$query = $this->db->get_where('course', array('id'=>$id));
		$row = $query->row_array(); // get the row
		return $row['variable'];

	}

	public function get_registration_code() {
		return "zebra";
	}
	
	

}