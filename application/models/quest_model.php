<?php

class Quest_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}


	public function get_quests($id = 0) {
		if ($id == 0) {
		
			$query = $this->db->query('SELECT * FROM quests');
			return $query->result();
		}

		$query = $this->db->get_where('quests', array('id' => $id));
		return $query->row_array();
	}
	
	public function get_available_quests($qtype = 2, $uid = 0) {
		if ($uid == 0) {
			$query = $this->db->get_where('quests', array('type' => $qtype));
		}
		else {
			if ($qtype == 0) {

				$query = $this->db->query("SELECT quests.id, name from quests LEFT JOIN questCompletion ON quests.id = questCompletion.qid LEFT JOIN users ON questCompletion.uid = users.id WHERE quests.id NOT IN (SELECT qid FROM questCompletion WHERE uid = '".$uid."') AND hidden = 0");			
			}
			
			else {		
				$query = $this->db->query("SELECT quests.id, name, instructions from quests LEFT JOIN questCompletion ON quests.id = questCompletion.qid LEFT JOIN users ON questCompletion.uid = users.id WHERE quests.id NOT IN (SELECT qid FROM questCompletion WHERE uid = '".$uid."') AND type = '".$qtype."' AND hidden = 0");
			}
		}
		$result = $query->result();
		$quests = array();
		foreach($result as $quest) {
//			$options = $this->quest_model->get_quest_skills($quest->id);
			$quests[] = array(
				'info' => $quest,				
//				'options' => $options
			);
		}
		return $quests;
	}
	public function get_quest_types() {
		$query = $this->db->query('SELECT id, name FROM questTypes');
		return $query->result();
	}
	
	public function ajax_quest_skills() {
		$id = $this->input->post('qid');
		return $this->quest_model->get_quest_skills($id);
	}
	
	public function complete_quest($update = FALSE) {
		$id = $this->input->post('quest-id');
		
		//check if quest is submission
		$skills = $this->input->post('skill');
		$points = $this->input->post('award');
		$note = $this->input->post('quest-note');
		$users = $this->input->post('users');
		//complete quest per user
		foreach ($users as $user) {
			$data = array(
				'qid' => $id,
				'uid' => $user,
				'completed' => time(),
				'note' => $note
				);
			
			if ($update) {
			}
			else {
				$this->db->insert('questCompletion', $data);
			}
			foreach ($skills as $k => $skill) {
				$data = array(
					'qid' => $id,
					'uid' => $user,
					'skid' => $skill,
					'amount' => $points[$k]
					);		
				
				if ($update) {
				
				}
				else {
					$this->db->insert('questCompletionSkills', $data);
					}
				}
			}
	}
	
	public function get_latest_submission_id($qid, $uid) {
		$query = $this->db->query("SELECT id FROM submissions WHERE qid = '".$qid."' AND uid = '".$uid."' ORDER BY id DESC LIMIT 1");
		return $query->row_array();
	}
	
	public function get_completed_quests($uid) {
		$query = $this->db->query("SELECT * FROM questCompletion LEFT JOIN quests ON quests.id = questCompletion.qid WHERE uid = ".$uid." ORDER BY completed DESC");
		return $query->result();
	}
	
	public function hide($qid) {
		$query = $this->db->query("UPDATE quests SET hidden = 1 WHERE id = '".$qid."'");
		
	}
	
	public function show($qid) {
		$query = $this->db->query("UPDATE quests SET hidden = 0 WHERE id = '".$qid."'");	
	}
	public function get_charted_progress($uid) {
		$queryDates = $this->db->query("SELECT DISTINCT completed FROM questCompletion WHERE uid = '".$uid."' ORDER BY completed ASC");
		$dates = $queryDates->result();
		$querySkills = $this->db->query("SELECT id, name FROM skills");
		$skills = $querySkills->result();
		$rows = array();
		foreach ($skills as $skill) {
			$row = array();
			
			foreach ($dates as $date) {
				$querySkillProgress = $this->db->query("SELECT IFNULL(SUM(questCompletionSkills.amount),0) as amount FROM questCompletionSkills LEFT JOIN questCompletion ON questCompletion.qid = questCompletionSkills.qid AND questCompletion.uid = questCompletionSkills.uid WHERE questCompletion.uid = '".$uid."' AND completed <= '".$date->completed."' AND questCompletionSkills.skid = '".$skill->id."'");
				$current = $querySkillProgress->row_array();
				$amount = $current['amount'];
				$row[] = $amount;
			}
			$rows[] = array('name' => $skill->name,
							'values' => $row);
			unset($row);
		}

		$chart = array('dates' => $dates,
						'progress' => $rows);

		return $chart;
	}
	
	
	public function current_progress($skid, $qid, $uid) {
		$query = $this->db->query("SELECT * FROM questCompletionSkills LEFT JOIN skills ON skills.id = questCompletionSkills.skid WHERE questCompletionSkills.uid = '".$uid."' AND questCompletionSkills.qid = '".$qid."' AND questCompletionSkills.skid = ".$skid." ORDER BY amount DESC LIMIT 1");

		return $query->row_array();
	}
	
	public function get_quest_skills($id, $highestOnly = FALSE) {
		$query = $this->db->query("SELECT DISTINCT skid, type FROM questSkills LEFT JOIN quests ON questSkills.qid = quests.id WHERE qid = '".$id."' ");	
		$result = $query->result();
		$options = array();
		foreach ($result as $skill) {
			if ($highestOnly) {
				$query = $this->db->query("SELECT name, qid, skid, label, amount FROM questSkills, skills WHERE questSkills.qid = '".$id."' AND questSkills.skid = '".$skill->skid."' AND skills.id = questSkills.skid ORDER BY amount DESC LIMIT 1");	
			
			}
			else {
				$query = $this->db->query("SELECT name, qid, skid, label, amount FROM questSkills, skills WHERE questSkills.qid = '".$id."' AND questSkills.skid = '".$skill->skid."' AND skills.id = questSkills.skid");	
		
			}
			
			$options[] = $query->result();		
		}
		

		return $options;
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