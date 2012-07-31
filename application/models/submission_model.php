<?php

class Submission_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}


	public function get_submissions($id = 0) {
		if ($id == 0) {
		
			$query = $this->db->query('SELECT * FROM submissions LEFT JOIN quests ON submissions.qid = quests.id ORDER BY submitted');
			return $query->result();
		}

		$query = $this->db->query("SELECT * FROM submissions LEFT JOIN quests ON submissions.qid = quests.id WHERE submissions.id = '".$id."'ORDER BY submitted");
		return $query->row_array();
	}
	
	public function get_submissions_by_quest($qid = 0, $uid = 0) {
		if ($uid == 0) {
			$query = $this->db->get_where('submissions', array('qid' => $qid));
		}
		else {
			$query = $this->db->get_where('submissions', array('qid' => $qid, 'uid' => $uid));
		}

		return $query->result;
	}

	public function get_ungraded_submissions() {
		$query = $this->db->query("SELECT name as quest, first_name, last_name, submission, submitted, visible, submissions.qid, submissions.id FROM submissions LEFT JOIN questCompletion ON submissions.qid = questCompletion.qid LEFT JOIN meta ON meta.user_id = submissions.uid LEFT JOIN quests ON quests.id = submissions.qid WHERE completed IS NULL 
		UNION ALL 
		SELECT name as quest, first_name, last_name, filename as submission, uploaded as submitted, '0' as visible, files.qid, files.id FROM files LEFT JOIN questCompletion ON files.qid = questCompletion.qid LEFT JOIN meta ON meta.user_id = files.uid LEFT JOIN quests ON quests.id = files.qid WHERE completed IS NULL ORDER BY submitted ASC
		");
		return $query->result();
	}
	
	public function get_revised_submissions() {
		$query = $this->db->query("SELECT DISTINCT submissions.qid, name as quest, first_name, last_name, submission, submitted, visible, submissions.id FROM submissions LEFT JOIN questCompletion ON submissions.qid = questCompletion.qid LEFT JOIN meta ON meta.user_id = submissions.uid LEFT JOIN quests ON quests.id = submissions.qid WHERE submitted > completed ORDER BY submitted ASC");
		return $query->result();
	}

	public function revision_count($qid, $uid) {
		$query = $this->db->query("SELECT COUNT(id) as num FROM submissions WHERE qid = '".$qid."' AND uid = '".$uid."'");
		return $query->row_array();
	
	}
	public function submit($uid) {
		$qid = $this->input->post('quest');
		$submission = $this->input->post('submission');
		$visible = $this->input->post('visible');
	// change this ASAP
//		$uid = 1;
		$data = array(
			'qid' => $qid,
			'uid' => $uid,
			'submission' => $submission,
			'visible' => $visible,
			'submitted' => time(),
			
			);
		
		$this->db->insert('submissions', $data);
		
		//fire off any notices here
		
		return $this->db->insert_id();

	}

	
	public function current_progress($skid, $qid, $uid) {
		$query = $this->db->query("SELECT * FROM submissions LEFT JOIN questCompletionSkills ON submissions.qid =  questCompletionSkills.qid LEFT JOIN skills ON skills.id = questCompletionSkills.skid WHERE submissions.uid = '".$uid."' AND submissions.qid = '".$qid."' AND questCompletionSkills.skid = ".$skid." ORDER BY amount DESC LIMIT 1");

		return $query->row_array();
	}
	public function new_quest() {
			$title = $this->input->post('quest-title');
			$instructions = $this->input->post('quest-instructions');
			$qtype = $this->input->post('quest-type');
			$requirements = $this->input->post('locked');
		
		$data = array(
			'name' => $title,
			'instructions' => $instructions,
			'type' => $qtype,
			'requirements' => $requirements
			);
			
		$this->db->insert('quests', $data);
		$qid = $this->db->insert_id();

		$info = array(
			'name' => $title,
			'requirements' => $requirements,
			'skills' => $this->input->post('skills'),
			'id' => $qid
			);
		return $info;
	}
	
	public function confirm_quest() {
			$title = $this->input->post('title');
			$id = $this->input->post('qid');
		//insert skills into questSkills
			$skids = $this->input->post('skill');
			$labels = $this->input->post('label');
			$points = $this->input->post('points');			
			foreach ($skids as $k => $skid) {
				$data = array(
					'qid' => $id,
					'skid' => $skid,
					'label' => $labels[$k],
					'amount' => $points[$k]
					);
					
				$this->db->insert('questSkills', $data);
					
			}
			$info = array(
				'name' => $title,
				'id' => $id,
				'requirements' => $this->input->post('requirements')
				);
			return $info;
	}
	
	public function get_student_quests($id) {
	
	}
}