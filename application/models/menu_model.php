<?php

class Menu_model extends CI_Model {

	public function __construct() {

	}

	public function get_items() {
			//return all posts where menu is true
			$query = $this->db->query('SELECT id, headline FROM posts WHERE menu = 1 ORDER BY position ASC');
			return $query->result();

	}


}