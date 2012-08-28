<?php

class Grade extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('grade_model');
	}
	
	public function index() {
		$data['grades'] = $this->grade_model->get_grades();
		$data['title'] = "Grades";
		$data['instructions'] = "Grades act as a ranking system for your students.  It's a good idea to create grades that might not necessarily correspond to a letter grade.  You can use these later to lock advanced quests.  A player's grade is based on their lowest valued skill.";
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