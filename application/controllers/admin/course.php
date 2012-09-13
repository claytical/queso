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
		$data['themes'] = array('default', 'amelia', 'simplex', 'cerulean');
		$data['dropdown'] = $this->course_model->get_variable("dropdown");
		$this->load->view('include/header');
		$this->load->view('config/course', $data);
      	$this->load->view('include/footer');
		

	}
	
	public function setup() {
		$data['checklist'] = "yes";
		$this->load->view('include/header');
		$this->load->view('config/setup', $data);
      	$this->load->view('include/footer');
	
	}
	
	public function dashboard() {
		$this->load->model('quest_model');
		$this->load->model('submission_model');
	
		$data['quests_pending'] = $this->submission_model->get_ungraded_submissions();
		$data['quests_revisions'] = $this->submission_model->get_revised_submissions();
		$data['quests_completed'] = $this->quest_model->get_completed_quests();
		//list/# of students by rank
		//gather list of specific range/threshold
//		$data->current = $this->grade_model->get_current_grade($this->the_user->user_id);
		
		$this->load->view('include/header');
		$this->load->view('quests/dashboard', $data);
      	$this->load->view('include/footer');

	}
	
			
		
}