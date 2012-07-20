<?php

class Submission extends Common_Auth_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('submission_model');
	}
	
	public function index() {
		$data['quests'] = $this->submission_model->get_submissions();
		$data['title'] = "Submissions";
		$this->load->view('include/header');
		$this->load->view('submissions/index', $data);
      	$this->load->view('include/footer');
	}
	
	
	public function revise() {
		
	}
		
		
	public function view($id) {
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('response', 'Response', 'required');
		$this->load->model('response_model');
		$this->load->model('submission_model');
		$this->load->model('quest_model');

		if ($this->form_validation->run() === FALSE) {}
		else {
			$this->response_model->respond();
		}
	
		
		//student view
		$info = $this->submission_model->get_submissions($id);
		
		$questBestPossible = $this->quest_model->get_quest_skills($info['qid'], TRUE);

		foreach ($questBestPossible as $bestSkill) {
			//compare to current progress
			$current = $this->submission_model->current_progress($bestSkill[0]->skid, $info['qid'], $info['uid']);
			$progress = array(
						'skill' => $current['name'],
						'amount' => $current['amount'],
						'id' => $current['skid'],
						'total' => $bestSkill[0]->amount,
						'percentage' => ($current['amount'] / $bestSkill[0]->amount) * 100,

						);

			$data['progress'][] = $progress;
		}

		$responses = $this->response_model->get_responses($id);
		$data['best'] = $questBestPossible;
		$data['quest'] = $info['name'];
		$data['instructions'] = $info['instructions'];
		$data['qid'] = $info['qid'];
		$data['id'] = $id;
		$data['submission'] = $info['submission'];
		$data['submitted'] = $info['submitted'];
		$data['responses'] = $responses;
		
		
		$this->load->view('include/header');
		$this->load->view('submissions/view', $data);
      	$this->load->view('include/footer');
		
		if (empty($info)) {
			show_404();
		}

	}
}