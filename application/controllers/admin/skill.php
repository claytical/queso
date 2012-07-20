<?php

class Skill extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('skill_model');
	}
	
	public function index() {
		$data['skills'] = $this->skill_model->get_skills();
		$data['title'] = "Skills";
		$data['instructions'] = "Skills can have their name modified.  Skills that are already assigned to quests cannot be removed.";
		$this->load->view('include/header');
		$this->load->view('skills/index', $data);
      	$this->load->view('include/footer');

	}
	
	public function edit() {
		$success = $this->skill_model->edit_skill();
	}

	public function remove() {
		$success = $this->skill_model->remove_skill();
	}
	
	public function create() {
		$id = $this->skill_model->create_skill();
		
//		echo "<tr><td><span class='skill-title'>Title</span><input type='hidden' name='skill-number' class='skill-number' value='".$id."'><input class='hidden skill-editing' type='text' name='skill-title' value='title'><button class='btn pull-right hidden skill-save'><span class='add-on'><i class='icon-ok'></i></span></button><button class='btn pull-right skill-edit'><span class='add-on'><i class='icon-pencil'></i></span></button></td><td><button class='btn-danger pull-right remove'>Remove</button></td></tr>";

	}


}