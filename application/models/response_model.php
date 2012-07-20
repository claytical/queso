<?php

class Response_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}


	public function get_responses($id = 0) {
		//get all responses to a given submission
		$query = $this->db->query("SELECT * FROM responses LEFT JOIN meta ON responses.uid = meta.user_id WHERE responses.sid = '".$id."'");
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