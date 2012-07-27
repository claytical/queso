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
		$info = $this->post_model->get_post($id);
		$data['headline'] = $info['headline'];
		$data['body'] = $info['body'];
		$this->load->view('include/header');
		$this->load->view('posts/view', $data);
      	$this->load->view('include/footer');
	
	}

	
}