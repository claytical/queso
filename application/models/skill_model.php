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
	public function get_users($skid, $order = "ASC", $limit = 3) {
		$query = $this->db->query("SELECT uid, SUM(amount) AS amount, skid, username FROM questCompletionSkills LEFT JOIN users ON users.id = questCompletionSkills.uid WHERE skid = ".$skid." GROUP BY uid, skid UNION SELECT id as uid, '0' as amount, '".$skid."' as skid, username FROM users WHERE id NOT IN (SELECT uid FROM questCompletionSkills WHERE skid = ".$skid.") ORDER BY amount ".$order." LIMIT ".$limit);
		return $query->result();
	}
	

	
	public function get_skill_aggregation() {
		$query = $this->db->query("SELECT skills.name as name, SUM(amount) as total, skid  FROM questSkills LEFT JOIN quests ON questSkills.qid = quests.id LEFT JOIN skills ON skills.id = questSkills.skid GROUP BY skid ORDER BY total DESC");
		return $query->result();
	}
	
	public function get_total_by_user($uid, $skid = 'all') {
		if ($skid == 'all') {
			$query = $this->db->query("SELECT skid, name, sum(amount) as amount FROM questCompletionSkills LEFT JOIN skills ON skills.id = questCompletionSkills.skid WHERE uid = '".$uid."' GROUP BY skid");
		}
		else {
			$query = $this->db->query("SELECT skid, name, sum(amount) as amount FROM questCompletionSkills LEFT JOIN skills ON skills.id = questCompletionSkills.skid WHERE uid = '".$uid."' AND skid = '".$skid."' GROUP BY skid");
		
		}
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