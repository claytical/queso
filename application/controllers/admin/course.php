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
			if(!$this->course_model->get_variable("information")) {
				$this->course_model->info_set();
			}

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
		$this->load->model('skill_model');
		$this->load->model('grade_model');
		$this->load->model('quest_model');
		$this->load->model('post_model');
		$this->load->model('user_model');
		
		if($this->course_model->get_variable("information")) {
			$data['information'] = TRUE;
		}
		else {
			$data['information'] = FALSE;
		}

		if ($this->skill_model->get_skills()) {
			$data['skills'] = TRUE;
		}
		else {
			$data['skills'] = FALSE;
		}
		
		if ($this->grade_model->get_grades()) {
			$data['grades'] = TRUE;
		}
		else {
			$data['grades'] = FALSE;
		}

		if ($this->quest_model->get_quests()) {
			$data['quests'] = TRUE;
		}
		else {
			$data['quests'] = FALSE;
		}

		if ($this->post_model->get_posts(TRUE)) {
			$data['posts'] = TRUE;
		}
		else {
			$data['posts'] = FALSE;
		}
	
		if (count($this->user_model->get_info()) > 1) {
			$data['users'] = TRUE;
		}
		else {
			$data['users'] = FALSE;
		}
		
		$this->load->view('include/header');
		$this->load->view('config/setup', $data);
      	$this->load->view('include/footer');
	
	}
	
	public function dashboard() {
		$this->load->model('quest_model');
		$this->load->model('submission_model');
		$this->load->model('skill_model');
		$this->load->model('grade_model');
	
		$data['quests_pending'] = $this->submission_model->get_ungraded_submissions();
		$data['quests_revisions'] = $this->submission_model->get_revised_submissions();
		$data['quests_completed'] = $this->quest_model->get_completed_quests();
		$data['popular_quests'] = $this->quest_model->get_quest_by_popularity("POPULAR");
		$data['unpopular_quests'] = $this->quest_model->get_quest_by_popularity("UNPOPULAR");
		$data['skills_gained'] = $this->skill_model->get_skill_aggregation();
		$skills = $this->skill_model->get_skills(); 

		$users = array();
		foreach($skills as $skill) {
			//get top users
		
			$users = $this->skill_model->get_users($skill->id, "DESC", "5");
			$skillGroup = array();
			$skillGroup['name'] = $skill->name;
			foreach ($users as $user) {
				$grade_array = $this->grade_model->get_current_grade($user->uid);
				$skillGroup['users'][] = array("grades"=>$grade_array[0],
					"name" => $user->username,
					"amount" => $user->amount,
					"uid" => $user->uid);
			}
			$data['top_skills'][] = $skillGroup;
			unset($skillGroup);

			$usersLow = $this->skill_model->get_users($skill->id, "ASC", "5");
			$skillGroupLow = array();
			$skillGroupLow['name'] = $skill->name;
			foreach ($usersLow as $user) {
				$grade_array = $this->grade_model->get_current_grade($user->uid);
				$skillGroupLow['users'][] = array("grades"=>$grade_array[0],
					"name" => $user->username,
					"amount" => $user->amount,
					"uid" => $user->uid);
			}
			$data['low_skills'][] = $skillGroupLow;
			unset($skillGroupLow);


		}
		
			//list/# of students by rank
		//gather list of specific range/threshold
//		$data->current = $this->grade_model->get_current_grade($this->the_user->user_id);
		
		$this->load->view('include/header');
		$this->load->view('quests/dashboard', $data);
      	$this->load->view('include/footer');

	}
	
			
		
}