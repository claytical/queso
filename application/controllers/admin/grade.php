<?php

class Skill extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('skill_model');
	}
	
	public function index() {
		$data['skills'] = $this->skill_model->get_skills();
		$data['title'] = "Skills";
		$data['instructions'] = "Grades are evaluated based on the lowest number of all skills";
		$this->load->view('include/header');
		$this->load->view('grades/index', $data);
      	$this->load->view('include/footer');

	}
	
	public function edit() {
		$success = $this->grade_model->edit_grade();
	}

	public function remove() {
		$success = $this->grade_model->remove_grade();
	}
	
	public function create() {
		$id = $this->grade_model->create_grade();
		
	}


}