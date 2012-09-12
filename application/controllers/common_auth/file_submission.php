<?php

class File_Submission extends Common_Auth_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('file_model');
		$this->load->helper(array('form', 'url'));
	}
		
	public function do_upload($id) {
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|pdf|zip';
		$this->load->library('upload', $config);

		
		if (! $this->upload->do_upload()) {
			$error = array('error' => $this->upload->display_errors());
			$data['id'] = $id;
			$this->load->view('include/header', $data);
			$this->load->view('file/error', $error);
	      	$this->load->view('include/footer');

//			redirect("quest/upload/".$id);

		}
		else {
			$data = array('upload_data' => $this->upload->data());
			$id = $this->file_model->upload_submission($this->the_user->user_id);
			redirect("quests/available/online");
			//$this->load->view('upload_success', $data);
		}

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

	
			
	public function view($id) {
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('note', 'Note', 'required');
		$this->load->model('file_model');
		$this->load->model('submission_model');
		$this->load->model('quest_model');

		if ($this->form_validation->run() === FALSE) {}
		else {
			$this->file_model->update_note();
		}
	
		
		//student view
		$info = $this->file_model->get_file_submissions($id);
		
		$questBestPossible = $this->quest_model->get_quest_skills($info['qid'], TRUE);
			foreach ($questBestPossible as $bestSkill) {
				//compare to current progress
				$current = $this->file_model->current_progress($bestSkill[0]->skid, $info['qid'], $info['uid']);
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
//		$responses = $this->response_model->get_responses($id);
		$data['best'] = $questBestPossible;
		$data['quest'] = $info['name'];
		$data['instructions'] = $info['instructions'];
		$data['qid'] = $info['qid'];
		$data['id'] = $id;
		$data['filename'] = $info['filename'];
		$data['uploaded'] = $info['uploaded'];
		$data['note'] = $info['notes'];
//		$data['responses'] = $responses;
		
		
		$this->load->view('include/header', $data);
		$this->load->view('file/view', $data);
      	$this->load->view('include/footer');
		
		if (empty($info)) {
			show_404();
		}

	}
}