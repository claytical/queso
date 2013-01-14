<?php

class Submission extends Common_Auth_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('submission_model');
	}
	
	public function index() {
		$data['quests'] = $this->submission_model->get_submissions();
		$data['title'] = "Submissions";
		$this->load->view('include/header', $data);
		$this->load->view('submissions/index', $data);
      	$this->load->view('include/footer');
	}
	
	
	public function revise($id) {
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('submission', 'Submission', 'required');
		$this->load->model('response_model');
		$this->load->model('submission_model');
		$this->load->model('quest_model');
		$info = $this->submission_model->get_submissions($id);
		$data['quest'] = $info['name'];
		$data['instructions'] = $info['instructions'];
		$data['qid'] = $info['qid'];
		$data['id'] = $id;
		$data['submission'] = $info['submission'];
		$this->load->view('include/header', $data);
		$this->load->view('submissions/revise', $data);
      	$this->load->view('include/footer');
		
		if (empty($info)) {
			show_404();
		}

		if ($this->form_validation->run() === FALSE) {}
		else {
			$id = $this->submission_model->submit($this->the_user->user_id);
			redirect('/submission/'.$id, 'location');
			
		}

	}
	public function discussion() {
		$this->load->model('submission_model');
		$submissions = $this->submission_model->get_submissions_for_discussion();
		$data['submissions'] = $submissions;
		$this->load->view('include/header', $data);
		$this->load->view('submissions/discussion', $data);
      	$this->load->view('include/footer');

	}
	public function discuss($id) {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('response', 'Response', 'required');
		$this->load->model('response_model');
		$this->load->model('submission_model');
		$this->load->model('quest_model');
		$info = $this->submission_model->get_submissions($id);
		$response_quests = $this->quest_model->get_available_quests(4);
		if ($info['visible']) {
			$data['quest'] = $info['name'];		
			$data['instructions'] = $info['instructions'];
			$data['qid'] = $info['qid'];
			$data['id'] = $id;
			$data['submission'] = $info['submission'];
			$data['submitted'] = $info['submitted'];
			$data['responses'] = $this->response_model->get_responses($id);
			$data['response_quests'] = $response_quests;
		}
		else {
			show_404();		
		}
		if ($this->form_validation->run() === FALSE) {}
		else {
			$this->response_model->respond($this->the_user->user_id);
			redirect("discuss/".$id, "refresh");
		}
		
				
		$this->load->view('include/header', $data);
		$this->load->view('submissions/discuss', $data);
      	$this->load->view('include/footer');
		

	
	}
	public function view($id) {
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('response', 'Response', 'required');
		$this->load->model('response_model');
		$this->load->model('submission_model');
		$this->load->model('quest_model');
		$info = $this->submission_model->get_submissions($id);
		
		if ($this->form_validation->run() === FALSE) {}
		else {
			$this->response_model->respond();
		}
	
		
		//student view
		$info = $this->submission_model->get_submissions($id);
		if ($this->the_user->user_id == $info['uid'] || $this->ion_auth->is_admin()) {		
			$questBestPossible = $this->quest_model->get_quest_skills($info['qid'], TRUE);
				foreach ($questBestPossible as $bestSkill) {
					//compare to current progress
					$current = $this->submission_model->current_progress($bestSkill[0]->skid, $info['qid'], $info['uid']);
					if ($current) {
						$progress = array(
								'skill' => $current['name'],
								'amount' => $current['amount'],
								'id' => $current['skid'],
								'total' => $bestSkill[0]->amount,
								'percentage' => ($current['amount'] / $bestSkill[0]->amount) * 100,
		
								);
		
						$data['progress'][] = $progress;
					}
				}
			$data['best'] = $questBestPossible;
			$data['quest'] = $info['name'];
			$data['instructions'] = $info['instructions'];
			$data['qid'] = $info['qid'];
			$data['id'] = $id;
			$data['submission'] = $info['submission'];
			$data['submitted'] = $info['submitted'];
			$data['responses'] = $this->response_model->get_responses($id);
		}				
		else {
			show_404();
		}
		
		$this->load->view('include/header', $data);
		$this->load->view('submissions/view', $data);
      	$this->load->view('include/footer');
		
		if (empty($info)) {
			show_404();
		}

	}
}