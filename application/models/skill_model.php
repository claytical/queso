<?php

class Skill_model extends CI_Model {

	public function __construct() {
	//	$this->load->database();
	}


	public function get_skills($id = 0) {
		if ($id == 0) {
			$query = $this->db->query('SELECT name, id FROM skills');
			return $query->result();
		}
		else {
			$query = $this->db->get_where('skills', array('id' => $id));
			return $query->row_array();

		}
	}
	
	public function get_total_by_user($uid) {
		$query = $this->db->query("SELECT skid, name, sum(amount) as amount FROM questCompletionSkills LEFT JOIN skills ON skills.id = questCompletionSkills.skid WHERE uid = '".$uid."' GROUP BY skid");
		return $query->result();
	}

	public function edit_skill() {	
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$query = $this->db->query("UPDATE skills SET name = '".$name."' WHERE id = '".$id."'");
	}

	public function remove_skill() {	
		$id = $this->input->post('id');
		$query = $this->db->query("DELETE FROM skills WHERE id = '".$id."'");
	}
	
	public function create_skill() {
	
		$title = $this->input->post('name');
		
		$data = array(
			'name' => $title
			);
			
		$this->db->insert('skills', $data);
		return $this->db->insert_id();
		}
	
	public function selected_skills() {
	//	$selected_skills = $this->db->query("SELECT * FROM skills WHERE id IN (".$this->input->post('skills').")";
	//	return $this->input->post('skills[]');

	}

}