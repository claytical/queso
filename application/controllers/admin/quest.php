<?php

class Quest extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('quest_model');
		$this->load->model('skill_model');
	}
	
	public function index() {
		$data['quests'] = $this->quest_model->get_quests();
		$data['title'] = "Quests";
		$this->load->view('include/header');
		$this->load->view('quests/admin_index', $data);
      	$this->load->view('include/footer');
	}
	
	public function create() {
		//admin
		$this->load->helper('form');
		$data['title'] = "Create a Quest";
		$data['instructions'] = "";
		$data['options'] = $this->quest_model->get_quest_types();
		$data['skills'] = $this->skill_model->get_skills();
		$this->load->view('include/header');
		$this->load->view('quests/create', $data);
		$this->load->view('include/footer');
		
	}
	

	public function skills() {
		$this->load->helper('form');
		$info = $this->quest_model->new_quest();
		$data['title'] = $info['name'];
		$data['requirements'] = $info['requirements'];
		$data['id'] = $info['id'];
		
		foreach ($info['skills'] as $sid) {
			$data['skills'][] = $this->skill_model->get_skills($sid);	
		}
		
		$this->load->view('include/header');
		$this->load->view('quests/skills', $data);	
		$this->load->view('include/footer');

	}
	
	function grade($qtype = 'all') {
		$this->load->helper('form');
		$this->load->model('user_model');
		$this->load->library('form_validation');

		if ($qtype == 'in-class') {
			$data['title'] = "Grade In Class Quest";
			$data['quests'] = $this->quest_model->get_available_quests(1);
		}
		else if ($qtype == 'online') {
			$data['title'] = "Grade Submitted Quest";
			$data['quests'] = $this->quest_model->get_available_quests(2);
		
		}
		
		else if ($qtype == 'all') {
			$data['title'] = "Grade All Kinds of Quests";
			
			$all_quests = $this->quest_model->get_quests();
			foreach($all_quests as $quest) {
				$data['quests'][] = array(
				'info' => $quest,				
//				'options' => $options
				);
//			$data['quests'][] = $current_quest;
			}

		}
		
		if ($qtype != 'post') {		
			$data['users'] = $this->user_model->get_info();
			$this->load->view('include/header');
			$this->load->view('quests/grade', $data);	
			$this->load->view('include/footer');
		}
		else {
			$data['users'] = $this->quest_model->complete_quest();
/*			$this->load->view('include/header');
			$this->load->view('quests/postgrade', $data);
			$this->load->view('include/footer');
*/
			redirect('/quests/grade/'.$qtype, 'location');
		}
	}
	
	public function skill_rewards() {
		$skills = $this->quest_model->ajax_quest_skills();
		foreach ($skills as $skill) {
				echo '<div class="control-group"><label class="control-label" for="skill-type">'.$skill[0]->name.'</label><div class="controls"><input type="hidden" name="skill[]" value="'.$skill[0]->skid.'"><select name="award[]"class="chzn-select">';
				foreach ($skill as $option) {
					echo '<option value="'.$option->amount.'">'.$option->label.'</option>';
				}
				echo '</select></div></div>';

		}
	}

	function confirm() {
	
		$info = $this->quest_model->confirm_quest();
		$data['title'] = $info['name'];
		$data['id'] = $info['id'];
		$data['requirements'] = $info['requirements'];
		/*
		if ($info['requirements']) {
			$data['qtypes'] = $this->quest_model->get_quest_types();
		}
		*/
		$this->load->view('include/header');
		$this->load->view('quests/confirmation', $data);
		$this->load->view('include/footer');
		
		
	}
	
	public function remove() {
		//admin
	}
	
	public function edit() {
		//admin
	}
	
		
	public function available($qtype = 'all', $user = '0') {
		//admin view
		$data['title'] = "Available Quests";
		if ($qtype == 'all') {
			$data['quests'] = $this->quest_model->get_quests();
		}
		else if ($qtype == 'online') {
			$data['quests'] = $this->quest_model->get_available_quests(2, $user);
		}
		
		else if ($qtype == 'in-class') {
			$data['quests'] = $this->quest_model->get_available_quests(1, $user);
		}
		$this->load->view('include/header');
		$this->load->view('quests/available', $data);
		$this->load->view('include/footer');
		
	}
	
	
}