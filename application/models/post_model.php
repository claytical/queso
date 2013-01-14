<?php

class Post_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}


	public function get_posts($frontpage = FALSE) {
		if ($frontpage) {
		
			$query = $this->db->query('SELECT * FROM posts WHERE frontpage = 1 ORDER BY position ASC');
			return $query->result();
		}

		$query = $this->db->query("SELECT * FROM posts ORDER by position ASC");
		$result = $query->result();
			if ($result) {
				return $result;
			}
			else {
				return FALSE;
			}
		}
	
	public function reorder() {
		$list = $this->input->post('post-list');
		foreach ($list as $position => $item) {
			if ($item != NULL) {
				$query = $this->db->query("UPDATE posts set position = '".$position."' WHERE id = ".$item);
			}
		}
	}
	
	public function remove_file($id) {
		$fileQuery = $this->db->query("SELECT file FROM posts WHERE id = ".$id);
		$result = $fileQuery->row_array();
		$file = $result['file'];
		$this->db->query("UPDATE posts SET file = NULL WHERE id = ".$id);
		if (file_exists('./uploads/'.$file)) {
    		unlink('./uploads/'.$file) or die('failed deleting file');
  		}
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
	
	public function update($hasFile) {
		if ($hasFile) {
			$upload_data = $this->upload->data();
			$data = array(
				'headline' => $this->input->post('headline'),
				'body' => $this->input->post('body'),
				'frontpage' => $this->input->post('frontpage'),
				'file' => $upload_data['file_name']
				);
		}
		else {
			$data = array(
				'headline' => $this->input->post('headline'),
				'body' => $this->input->post('body'),
				'frontpage' => $this->input->post('frontpage')
				);
		
		}
		
		$this->db->where('id',$this->input->post('postid'));
		
		$this->db->update('posts', $data);

	}
}
/*			
		$headline = $this->input->post('headline');
		$body = $this->input->post('body');
		$frontpage = $this->input->post('frontpage');

		$id = $this->input->post('postid');

		if ($hasFile) {
			$upload_data = $this->upload->data();
			$this->db->query("UPDATE posts SET headline = '".$headline."', body = '".$body."', frontpage = '".$frontpage."', file = '".$upload_data['file_name']."' WHERE id = '".$id."'");

		}
		else {
			$this->db->query("UPDATE posts SET headline = '".$headline."', body = '".$body."', frontpage = '".$frontpage."' WHERE id = '".$id."'");
		
		}
	}
	*/