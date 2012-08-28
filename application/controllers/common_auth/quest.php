<?php

class Quest extends Common_Auth_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('quest_model');
		$this->load->model('skill_model');
	}
	
	public function index() {
		$data['quests'] = $this->quest_model->get_quests();
		$data['title'] = "Quests";
		$this->load->view('include/header');
      	$this->load->view('include/footer');
	}
	
	public function responses() {
		$data['title'] = "Completed Quests";
		$this->load->model('submission_model');
		$quests = $this->quest_model->get_completed_quests($this->the_user->user_id);		
	
	
	}
	
	public function completed() {
		//student view
		$data['title'] = "Completed Quests";
		$this->load->model('submission_model');
		$this->load->model('skill_model');
		$quests = $this->quest_model->get_completed_quests($this->the_user->user_id);		
		foreach ($quests as $quest) {
			if ($quest) {
			//submission
				if ($quest->type == 2) {
					$sid = $this->quest_model->get_latest_submission_id($quest->qid, $this->the_user->user_id);
				}
				if ($quest->type == 3) {
					$sid = $this->quest_model->get_latest_file_id($quest->qid, $this->the_user->user_id);
				}
			}
			else {
				$sid = 0;
			}
			$questBestPossible = $this->quest_model->get_quest_skills($quest->qid, TRUE);
				foreach ($questBestPossible as $bestSkill) {
					//compare to current progress
					$current = $this->quest_model->current_progress($bestSkill[0]->skid, $quest->qid, $this->the_user->user_id);
					if ($current) {
						$progress = array(
								'skill' => $current['name'],
								'amount' => $current['amount'],
								'id' => $current['skid'],
								'total' => $bestSkill[0]->amount,
								'percentage' => ($current['amount'] / $bestSkill[0]->amount) * 100,
								);
						$questProgress[] = $progress;
					}							
				}
				if (empty($sid)) {
				$sid = 0;
				}
				$data['quests'][] = array(
									'quest' => $quest,
									'submission' => $sid,
									'progress' => $questProgress);
				unset($questProgress);
			}
		$data['summary'] = $this->skill_model->get_total_by_user($this->the_user->user_id);
		$this->load->view('include/header');
		$this->load->view('quests/completed', $data);
		$this->load->view('include/footer');
		
	}
	
	public function upload($id) {
		$this->load->helper(array('form', 'url'));
		$info = $this->quest_model->get_quests($id);
		$data['title'] = $info['name'];
		$data['id'] = $info['id'];
		$data['instructions'] = $info['instructions'];
		$data['grade'] = "First Try";
		$data['attempt'] = "0";

		$this->load->view('include/header');
		$this->load->view('quests/upload', $data);
		$this->load->view('include/footer');
	}
	
	public function attempt($id = NULL) {
		$this->load->helper('form');
		$this->load->library('form_validation');
		if ($id != 'post') {
			$info = $this->quest_model->get_quests($id);
//			$submission = $this->submission_model->get_attempt($id);
			$data['title'] = $info['name'];
			$data['id'] = $info['id'];
			$data['instructions'] = $info['instructions'];
// TODO: Update these to get dynamic data
			$data['grade'] = "First Try";
			$data['attempt'] = "0";

			$this->load->view('include/header');
			$this->load->view('quests/attempt', $data);
			$this->load->view('include/footer');
		}
		else  {
		//TODO: check if id is valid
			$this->load->model('submission_model');

			$id = $this->submission_model->submit($this->the_user->user_id);
			redirect('/submission/'.$id, 'location');
		
		}
		
	}
	

	public function available($qtype = 'all', $user = '0') {
		//student view
		$data['title'] = "Available Quests";
		if ($qtype == 'all') {
			$quests = $this->quest_model->get_quests();
		}
		else if ($qtype == 'in-class') {
			$quests = $this->quest_model->get_available_quests(1, $this->the_user->user_id);
		}
		else if ($qtype == 'written') {
			$quests = $this->quest_model->get_available_quests(2, $this->the_user->user_id);
		}

		else if ($qtype == 'file') {
			$quests = $this->quest_model->get_available_quests(3, $this->the_user->user_id);
		}

		else if ($qtype == 'response') {
			$quests = $this->quest_model->get_available_quests(4, $this->the_user->user_id);
		}

		else if ($qtype == 'online') {
		//999 gets all quests available online
			$quests = $this->quest_model->get_available_quests(999, $this->the_user->user_id);
		}
//		$data['quests'] = $quests;
		$available_quests = array();

		foreach($quests as $quest) {
			//get quest locks
			$locks = $this->quest_model->get_quest_locks($quest['info']->id);		
			$locked = FALSE;
			foreach ($locks as $lock) {
				//compare against current level
				$skill_level = $this->skill_model->get_total_by_user($this->the_user->user_id, $lock->skid);
				if ($skill_level[0]->amount < $lock->requirement) {
					$locked = TRUE;
				}
			}
			if (!$locked) {
				$available_quests[] = $quest;
			}
		}
		$data['quests'] = $available_quests;
		
		$this->load->view('include/header');
		$this->load->view('quests/available', $data);
		$this->load->view('include/footer');
		
	}
	
	
	
	public function view($id) {
		//student view
		$data['quests'] = $this->quest_model->get_quests($id);
		
		if (empty($data['quests'])) {
			show_404();
		}
		
		$data['title'] = $data['quests']['name'];
		
		$this->load->view('include/header');
		$this->load->view('quests/view', $data);
      	$this->load->view('include/footer');
	}
}