<?php

class Grade extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('grade_model');
	}
	
	public function index() {
		$data['grades'] = $this->grade_model->get_grades();
		$data['title'] = "Grades";
		$data['instructions'] = "Thresholds are based on the lowest value of all skills";
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