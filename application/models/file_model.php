<?php

class File_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	
	}


	public function get_file_submissions($id = 0) {
		if ($id == 0) {
		
			$query = $this->db->query('SELECT * FROM files LEFT JOIN quests ON files.qid = quests.id ORDER BY uploaded');
			return $query->result();
		}

		$query = $this->db->query("SELECT * FROM files LEFT JOIN quests ON files.qid = quests.id WHERE files.id = '".$id."' ORDER BY uploaded");
		return $query->row_array();
	}
	

	public function get_file_submissions_by_quest($qid = 0, $uid = 0) {
		if ($uid == 0) {
			$query = $this->db->get_where('files', array('qid' => $qid));
		}
		else {
			$query = $this->db->get_where('files', array('qid' => $qid, 'uid' => $uid));
		}

		return $query->result;
	}

	public function get_ungraded_submissions() {
		$query = $this->db->query("SELECT name as quest, first_name, last_name, submission, submitted, visible, submissions.qid, submissions.id FROM submissions LEFT JOIN questCompletion ON submissions.qid = questCompletion.qid LEFT JOIN meta ON meta.user_id = submissions.uid LEFT JOIN quests ON quests.id = submissions.qid WHERE completed IS NULL ORDER BY submitted ASC");
		return $query->result();
	}
	
	public function get_revised_submissions() {
		$query = $this->db->query("SELECT DISTINCT files.qid, name as quest, first_name, last_name, notes, uploaded, files.id FROM files LEFT JOIN questCompletion ON files.qid = questCompletion.qid LEFT JOIN meta ON meta.user_id = files.uid LEFT JOIN quests ON quests.id = files.qid WHERE uploaded > completed ORDER BY uploaded ASC");
		return $query->result();
	}

	public function revision_count($qid, $uid) {
		$query = $this->db->query("SELECT COUNT(id) as num FROM files WHERE qid = '".$qid."' AND uid = '".$uid."'");
		return $query->row_array();
	
	}
	
	public function update_note() {
		$id = $this->input->post('fileid');
		$note = $this->input->post('note');
		$data = array(
			'notes' => $note);
		$this->db->where('id', $id);
		$this->db->update('files', $data);
//		$query = $this->db->query("UPDATE files SET notes = '".$note."' WHERE id = ".$id);
	}
	
	public function upload_submission($uid) {
		$qid = $this->input->post('quest');
		$notes = $this->input->post('notes');
		$upload_data = $this->upload->data();
		$data = array(
			'qid' => $qid,
			'uid' => $uid,
			'filename' => $upload_data['file_name'],
			'notes' => $notes,
			'uploaded' => time(),
			
			);
		
		$this->db->insert('files', $data);
		
		//fire off any notices here
		
		return $this->db->insert_id();

	}

	
	public function current_progress($skid, $qid, $uid) {
		$query = $this->db->query("SELECT * FROM files LEFT JOIN questCompletionSkills ON files.qid =  questCompletionSkills.qid LEFT JOIN skills ON skills.id = questCompletionSkills.skid WHERE files.uid = '".$uid."' AND files.qid = '".$qid."' AND questCompletionSkills.skid = ".$skid." ORDER BY amount DESC LIMIT 1");

		return $query->row_array();
	}

	
}