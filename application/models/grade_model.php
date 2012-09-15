<?php

class Grade_model extends CI_Model {

	public function __construct() {
	//	$this->load->database();
	}


	public function get_grades($order = "DESC") {
			$query = $this->db->query('SELECT id, amount, label FROM grading ORDER BY amount '.$order);
			$result = $query->result();
			if ($result) {
				return $result;
			}
			else {
				return FALSE;
			}
	}
	
	public function get_all_grades() {
		$query = $this->db->query("SELECT id FROM users WHERE active = 1");
		$users = $query->result();
		$grades = array();
		foreach ($users as $user) {
			$grades[] = $this->grade_model->get_current_grade($user->id);
		}
		return $grades;
	}
	public function get_grade($amount) {
		$query = $this->db->query("SELECT label WHERE amount >= '".$amount."' ORDER BY amount DESC LIMIT 1");
		return $query->result();
	}
	
	public function get_current_grade($uid) {
		$query = $this->db->query("SELECT IFNULL(SUM(amount),0) as amount, id, name FROM skills LEFT JOIN questCompletionSkills ON questCompletionSkills.skid = skills.id AND uid = '".$uid."' GROUP BY skid ORDER BY amount ASC");
		$current = $query->result();
		$skills = array();
		foreach ($current as $skill) {
			$amount = $skill->amount;
			$skillLabel = $skill->name;
			$grade = $this->db->query("SELECT * FROM grading WHERE amount <= '".$amount."' ORDER BY amount DESC LIMIT 1");
			$gradeLabel = $grade->row_array();
			$nextGrade = $this->db->query("SELECT * FROM grading WHERE amount > '".$amount."' ORDER BY amount ASC");
			$nextGradeLabel = $nextGrade->row_array();
			$data = array(
						'current_level'=> $gradeLabel['label'],
						'amount' => $amount,
						'next_amount' => $nextGradeLabel['amount'],
						'next_level' => $nextGradeLabel['label'],
						'skill' => $skillLabel
						);
			$skills[] = $data;
		}
		return $skills;		
	}
	
	public function get_next_level($amount) {
		$query = $this->db->query("SELECT * FROM grading WHERE amount > '".$amount."' ORDER BY amount ASC");
	
	}
	
	
	public function edit_grade() {
		$label = $this->input->post('label');
		$amount = $this->input->post('amount');
		$id = $this->input->post('id');
		$query = $this->db->query("UPDATE grading SET amount = '".$amount."', label = '".$label."' WHERE id = '".$id."'");
	}
	
	public function remove_grade() {
		$id = $this->input->post('id');
		$query = $this->db->query("DELETE FROM grading WHERE id = '".$id."'");	
	}
	
	public function create_grade() {
		$label = $this->input->post('label');
		$amount = $this->input->post('amount');
		$data = array(
			'label' => $label,
			'amount' => $amount,
			);
			
		$this->db->insert('grading', $data);
		return $this->db->insert_id();
	}
}