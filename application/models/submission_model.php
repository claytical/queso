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
	
	
	public function get_submissions_for_discussion() {
		$query = $this->db->query('SELECT COUNT(responses.id) responses, submissions.id as id, submission as text, name, username FROM submissions  LEFT JOIN users ON users.id = submissions.uid AND users.active = 1 LEFT JOIN quests ON quests.id = submissions.qid LEFT JOIN responses ON responses.sid = submissions.id WHERE visible = 1 AND active = 1 GROUP BY submissions.id');
		return $query->result();
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

	public function get_ungraded_submissions($uid = NULL) {
		if ($uid) {
		$query = $this->db->query("SELECT name as quest, username, submission, submitted, visible, submissions.qid, submissions.id, submissions.uid, '0' as file FROM submissions LEFT JOIN questCompletion ON submissions.qid = questCompletion.qid LEFT JOIN users ON users.id = submissions.uid AND users.active = 1 LEFT JOIN quests ON quests.id = submissions.qid WHERE completed IS NULL AND users.id = $uid 
		UNION ALL 
		SELECT name as quest,  username, filename as submission, uploaded as submitted, '0' as visible, files.qid, files.id, files.uid, '1' as file FROM files LEFT JOIN questCompletion ON files.qid = questCompletion.qid LEFT JOIN users ON users.id = files.uid AND users.active = 1 LEFT JOIN quests ON quests.id = files.qid WHERE completed IS NULL AND users.id = $uid ORDER BY uid, qid, submitted DESC
		");
		
		}
		else {
		$query = $this->db->query("SELECT name as quest, username, submission, submitted, visible, submissions.qid, submissions.id, submissions.uid, '0' as file FROM submissions LEFT JOIN questCompletion ON submissions.qid = questCompletion.qid LEFT JOIN users ON users.id = submissions.uid  LEFT JOIN quests ON quests.id = submissions.qid WHERE submissions.qid NOT IN
(SELECT qid  FROM questCompletion WHERE uid = users.id) AND users.active = 1
		UNION ALL 
		SELECT name as quest,  username, filename as submission, uploaded as submitted, '0' as visible, files.qid, files.id, files.uid, '1' as file FROM files LEFT JOIN questCompletion ON files.qid = questCompletion.qid LEFT JOIN users ON users.id = files.uid AND users.active = 1 LEFT JOIN quests ON quests.id = files.qid WHERE files.qid NOT IN
(SELECT qid  FROM questCompletion WHERE uid = users.id)
GROUP BY qid ORDER BY uid, qid, submitted DESC");

		}
		$ungraded = $query->result();
		
		$submissions = array();
		$uid = 0;
		$qid = 0;
		
		foreach($ungraded as $revision) {
			if ($revision->qid != $qid && $revision->uid != $uid) {
				$submissions[] = $revision;
				$uid = $revision->uid;
				$qid = $revision->qid;
			}
			else {
				$uid = 0;
				$qid = 0;
			}		
		}
		return $submissions;
		//return $query->result();
	}
	
	public function get_revised_submissions($uid = NULL) {
		if ($uid) {
		$query = $this->db->query("SELECT DISTINCT submissions.qid, name as quest, submissions.uid, first_name, last_name, submission, submitted, visible, submissions.id, '0' as file FROM submissions LEFT JOIN questCompletion ON submissions.qid = questCompletion.qid LEFT JOIN meta ON meta.user_id = submissions.uid LEFT JOIN quests ON quests.id = submissions.qid WHERE submitted > completed AND submissions.uid = $uid
		UNION ALL
		SELECT DISTINCT files.qid, name as quest, files.uid, first_name, last_name, filename as submission, uploaded as submitted, '0' as visible, files.id, '1' as file FROM files LEFT JOIN questCompletion ON files.qid = questCompletion.qid LEFT JOIN meta ON meta.user_id = files.uid LEFT JOIN quests ON quests.id = files.qid WHERE uploaded > completed AND files.uid = $uid ORDER BY uid, qid, submitted DESC");		
		}
		else {
		$query = $this->db->query("SELECT DISTINCT submissions.qid, name as quest, submissions.uid, username, submission, submitted, visible, submissions.id, '0' as file FROM submissions LEFT JOIN questCompletion ON submissions.qid = questCompletion.qid AND questCompletion.uid = submissions.uid LEFT JOIN users ON users.id = submissions.uid LEFT JOIN quests ON quests.id = submissions.qid WHERE submitted > completed 
		UNION ALL
		SELECT DISTINCT files.qid, name as quest, files.uid, username, filename as submission, uploaded as submitted, '0' as visible, files.id, '1' as file FROM files LEFT JOIN questCompletion ON files.qid = questCompletion.qid AND files.uid = questCompletion.qid LEFT JOIN users ON users.id = files.uid LEFT JOIN quests ON quests.id = files.qid WHERE uploaded > completed ORDER BY uid, qid, submitted DESC");
		}
		$revisions = $query->result();
		$submissions = array();
		$uid = 0;
		$qid = 0;
		foreach($revisions as $revision) {
			if ($revision->qid != $qid && $revision->uid != $uid) {
				$submissions[] = $revision;
				$uid = $revision->uid;
				$qid = $revision->qid;
			}
			else {
				$uid = 0;
				$qid = 0;
			}
		}
		return $revisions;
	}

	public function revision_count($qid, $uid) {
		$query = $this->db->query("SELECT COUNT(id) as num FROM submissions WHERE qid = '".$qid."' AND uid = '".$uid."'");
		return $query->row_array();
	
	}
	public function submit($uid) {
		$qid = $this->input->post('quest');
		$submission = $this->input->post('submission');
		$visible = $this->input->post('visible');
		//remove visibility on all previous submissions for the quest from this user
		$update_visibility = $this->db->query("UPDATE submissions SET visible = 0 WHERE qid = '".$qid."' AND uid = '".$uid."'");

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