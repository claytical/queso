<?php

class File_Submission extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('file_model');
		$this->load->helper(array('form', 'url'));
	}
		
		
	public function grade($id) {
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('note', 'Note', 'required');
		$this->load->model('file_model');
		$this->load->model('quest_model');
		if ($this->form_validation->run() === FALSE) {}
		else {
			$this->file_model->update_note();
			$this->quest_model->complete_quest();
			redirect('/admin/submissions/ungraded', 'location');

		}
	
		
		//admin view
		$info = $this->file_model->get_file_submissions($id);
		$data['quest'] = $info['name'];
		$data['instructions'] = $info['instructions'];
		$data['skills'] = $this->quest_model->get_quest_skills($info['qid']);

		$data['qid'] = $info['qid'];
		$data['id'] = $id;
		$data['filename'] = $info['filename'];
		$data['uploaded'] = $info['uploaded'];
		$data['uid'] = $info['uid'];
//		$attempts = $this->submission_model->revision_count($info['qid'], $info['uid']);

		$data['attempts'] = 1;//$attempts['num'];
		
		$data['note'] = $info['notes'];
		
		
		$this->load->view('include/header');
		$this->load->view('file/grade', $data);
      	$this->load->view('include/footer');
		
		if (empty($info)) {
			show_404();
		}

	}
			
		
}