<?php

class Post_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}


	public function get_posts($frontpage = FALSE) {
		if ($frontpage) {
		
			$query = $this->db->query('SELECT * FROM posts WHERE frontpage = 1 ORDER BY created DESC');
			return $query->result();
		}

		$query = $this->db->query("SELECT * FROM posts ORDER by created DESC");
		return $query->result();
	}
	
	
	public function get_post($id) {
		$query = $this->db->query("SELECT * FROM posts WHERE id = '".$id."'");
		return $query->row_array();
	}
	
	public function get_post_by_name($id) {
		$query = $this->db->query("SELECT * FROM posts WHERE lcase(headline) LIKE '%".strtolower($id)."%'");
		return $query->row_array();
	}


	public function submit() {
		$headline = $this->input->post('headline');
		$body = $this->input->post('body');
		$frontpage = $this->input->post('frontpage');
		$upload_data = $this->upload->data();
		if ($upload_data) {
			$data = array(
				'headline' => $headline,
				'body' => $body,
				'created' => time(),
				'frontpage' => $frontpage,			
				'file' => $upload_data['file_name'],				
				);

		}
		else {
		
			$data = array(
				'headline' => $headline,
				'body' => $body,
				'created' => time(),
				'frontpage' => $frontpage,			
				);
		}
		$this->db->insert('posts', $data);
		
		//fire off any notices here
		
		return $this->db->insert_id();

	}
	
	public function remove($id) {
		$query = $this->db->query("DELETE FROM posts WHERE id = ".$id);
	
	}


	public function removeFromMenu($id) {
		$query = $this->db->query("UPDATE posts SET menu = 0 WHERE id = ".$id);
	
	}
	
	public function addToMenu($id) {
		$query = $this->db->query("UPDATE posts SET menu = 1 WHERE id = ".$id);	
	}
	
	public function promote($id) {
		$query = $this->db->query("UPDATE posts SET frontpage = 1 WHERE id = ".$id);
	}

	public function demote($id) {
		$query = $this->db->query("UPDATE posts SET frontpage = 0 WHERE id = ".$id);
	
	}
	
	public function update() {
		$headline = $this->input->post('headline');
		$body = $this->input->post('body');
		$id = $this->input->post('postid');
		$frontpage = $this->input->post('frontpage');
		$this->db->query("UPDATE posts SET headline = '".$headline."', body = '".$body."', frontpage = '".$frontpage."' WHERE id = '".$id."'");

	}
	
}