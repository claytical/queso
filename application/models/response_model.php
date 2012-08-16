<?php

class Response_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}


	public function get_responses($id = 0) {
		//get all responses to a given submission
		$query = $this->db->query("SELECT responses.id, qid, sid, uid, response, created, flag, user_id, first_name, last_name, name FROM responses LEFT JOIN meta ON responses.uid = meta.user_id LEFT JOIN quests ON responses.qid = quests.id WHERE responses.sid = '".$id."'");
		return $query->result();		
	}
	
	
	public function get_responses_by_quest($qid, $uid = NULL) {
		$query = $this->db->query("SELECT response, created, first_name, last_name FROM responses LEFT JOIN submissions ON submissions.id = responses.sid LEFT JOIN meta ON responses.uid = meta.user_id WHERE qid = $qid AND uid = $uid");
		return $query->result();
	}
	
	
	public function respond() {
		//respond to a submission
		$sid = $this->input->post('submission');
		//TODO: Change to current user
		$uid = 1;
		$response = $this->input->post('response');
		//TODO: check if admin
		$flag = FALSE;
		$data = array(
			'sid' => $sid,
			'uid' => $uid,
			'response' => $response,
			'created' => time(),
			'flag' => $flag
			);
		$this->db->insert('responses', $data);
		$qid = $this->db->insert_id();
	}
	
	
	public function get_student_quests($id) {
	
	}
}