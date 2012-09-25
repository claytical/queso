<?php

class Submission extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('submission_model');
		$this->load->model('quest_model');

	}
	
	public function ungraded() {
		$data['submissions'] = $this->submission_model->get_ungraded_submissions();
		$data['title'] = "Submissions";
		$this->load->view('include/header');
		$this->load->view('submissions/ungraded', $data);
      	$this->load->view('include/footer');
	}
	
	public function revised() {
		$data['submissions'] = $this->submission_model->get_revised_submissions();
		$data['title'] = "Submissions";
		$this->load->view('include/header');
		$this->load->view('submissions/revised', $data);
      	$this->load->view('include/footer');
	}
	

		
	public function grade($id) {
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('response', 'Response', 'required');
		$this->load->model('response_model');
		$this->load->model('quest_model');
		if ($this->form_validation->run() === FALSE) {}
		else {
			$this->response_model->respond($this->the_user->user_id);
			$this->quest_model->complete_quest();
			redirect('/admin/submissions/ungraded', 'location');

		}
	
		
		//admin view
		$info = $this->submission_model->get_submissions($id);
		$responses = $this->response_model->get_responses($id);
		$data['quest'] = $info['name'];
		$data['instructions'] = $info['instructions'];
		$data['skills'] = $this->quest_model->get_quest_skills($info['qid']);

		$data['qid'] = $info['qid'];
		$data['id'] = $id;
		$data['submission'] = $info['submission'];
		$data['submitted'] = $info['submitted'];
		$data['uid'] = $info['uid'];
		$attempts = $this->submission_model->revision_count($info['qid'], $info['uid']);

		$data['attempts'] = $attempts['num'];
		
		$data['responses'] = $responses;
		
		
		$this->load->view('include/header');
		$this->load->view('submissions/grade', $data);
      	$this->load->view('include/footer');
		
		if (empty($info)) {
			show_404();
		}

	}
	
		public function skill_rewards() {
		$skills = $this->quest_model->quest_skills();
		foreach ($skills as $skill) {
				echo '<div class="control-group"><label class="control-label" for="skill-type">'.$skill[0]->name.'</label><div class="controls"><input type="hidden" name="skill[]" value="'.$skill[0]->skid.'"><select name="award[]"class="chzn-select">';
				foreach ($skill as $option) {
					echo '<option value="'.$option->amount.'">'.$option->label.'</option>';
				}
				echo '</select></div></div>';

		}
	}

	
}