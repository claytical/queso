<?php

class Post extends Public_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('post_model');

	}
		
	
	public function index() {
		$data['posts'] = $this->post_model->get_posts(TRUE);
		$data['title'] = "Posts";
		$this->load->view('include/header');
		$this->load->view('posts/index', $data);
      	$this->load->view('include/footer');

	}
	
	
	public function view($id) {
		if (is_numeric($id)) {
			$info = $this->post_model->get_post($id);
		}
		else {
			$converted = str_replace(" ", "-", $id);
			$info = $this->post_model->get_post_by_name($id);
		}
		$data['headline'] = $info['headline'];
		$data['body'] = $info['body'];
		$data['file'] = $info['file'];
		$this->load->view('include/header');
		$this->load->view('posts/view', $data);
      	$this->load->view('include/footer');
	
	}

	
}