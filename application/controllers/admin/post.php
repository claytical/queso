<?php

class Post extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('post_model');

	}
		
	public function create() {
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('headline', 'Headline', 'required');
		$this->form_validation->set_rules('body', 'Body', 'required');
		$data['title'] = "Create Post";
		if ($this->form_validation->run() === FALSE) {}

		else {
			$id = $this->post_model->submit();
			redirect("post/".$id);
		}
		
		$this->load->view('include/header');
		$this->load->view('posts/create');
      	$this->load->view('include/footer');

	}
	
	public function index() {
		$data['posts'] = $this->post_model->get_posts();
		$data['title'] = "Posts";
		$this->load->view('include/header');
		$this->load->view('posts/admin_index', $data);
      	$this->load->view('include/footer');

	}
	
	public function edit($id) {
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('headline', 'Headline', 'required');
		$this->form_validation->set_rules('body', 'Body', 'required');
		if ($this->form_validation->run() === FALSE) {}

		else {
			$this->post_model->update();
			redirect("post/".$id);
		}

		$info = $this->post_model->get_post($id);
		$data['title'] = $info['headline'];
		$data['body'] = $info['body'];
		$data['frontpage'] = $info['frontpage'];
		$data['pid'] = $info['id'];
		$this->load->view('include/header');
		$this->load->view('posts/edit', $data);
      	$this->load->view('include/footer');
	
	}
	
	public function delete($id) {
		$id = $this->post_model->remove($id);
		redirect("/admin/posts");

	}
	
	public function removemenu($id) {
		$id = $this->post_model->removeFromMenu($id);
		redirect("/admin/posts");
	
	}
	
	public function addmenu($id) {
		$id = $this->post_model->addToMenu($id);
		redirect("/admin/posts");
	
	}
		
	public function promote($id) {
		$id = $this->post_model->promote($id);
		redirect("/admin/posts");
	}
	
	public function demote($id) {
		$id = $this->post_model->demote($id);
		redirect("/admin/posts");

	}
}