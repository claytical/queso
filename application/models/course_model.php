<?php

class Course_model extends CI_Model {

	public function __construct() {

	}

	public function get_variable($id) {
		$query = $this->db->get_where('course', array('id'=>$id));
		$row = $query->row_array(); // get the row
		return $row['variable'];

	}
	
	public function update() {
		$code = $this->input->post('registration_code');
		$site = $this->input->post('course');
		$theme = $this->input->post('theme');
		$dropdown = $this->input->post('dropdown');
		$query = $this->db->query("UPDATE course SET variable = '".$site."' WHERE id = 'site'");
		$query = $this->db->query("UPDATE course SET variable = '".$code."' WHERE id = 'registration'");
		$query = $this->db->query("UPDATE course SET variable = '".$theme."' WHERE id = 'theme'");
		$query = $this->db->query("UPDATE course SET variable = '".$dropdown."' WHERE id = 'dropdown'");

	}

}