<?php

class Course extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('course_model');
		$this->load->helper(array('form', 'url'));
	}
		
		
	public function index() {
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('course', 'Course Name', 'required');
		$this->form_validation->set_rules('registration_code', 'Registration Code', 'required');
		if ($this->form_validation->run() === FALSE) {}
		else {
			$this->course_model->update();
			$data['message'] = "The settings have been updated.";
			redirect(base_url("admin/course"), "refresh");
		}
	
		
		//admin view
		$data['course'] = $this->course_model->get_variable("site");
		$data['registration_code'] = $this->course_model->get_variable("registration");
		
		$this->load->view('include/header');
		$this->load->view('config/course', $data);
      	$this->load->view('include/footer');
		

	}
			
		
}