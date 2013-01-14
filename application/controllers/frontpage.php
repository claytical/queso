<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontpage extends Public_Controller {

   public function index()
	{
      $this->load->view('include/header');
      $this->load->view('frontpage');
      $this->load->view('include/footer');
	}

	public function dashboard() {
		$this->load->model('quest_model');
		$this->load->model('grade_model');
		$this->load->model('post_model');
		$this->load->model('submission_model');
		if ($this->the_user) {
		$data['progress'] = $this->quest_model->get_charted_progress($this->the_user->user_id);
		$data['current'] = $this->grade_model->get_current_grade($this->the_user->user_id);
		$data['title'] = $this->the_user->username;
			if ($this->ion_auth->is_admin()) {
				$data['quests_completed'] = $this->quest_model->get_completed_quests();
				$data['quests_pending'] = $this->submission_model->get_ungraded_submissions();
				$data['quests_revisions'] = $this->submission_model->get_revised_submissions();
    		}
    		else {
				$data['quests_completed'] = $this->quest_model->get_completed_quests($this->the_user->user_id);
				$data['quests_pending'] = $this->submission_model->get_ungraded_submissions($this->the_user->user_id);
				$data['quests_revisions'] = $this->submission_model->get_revised_submissions($this->the_user->user_id);
    		
    		}
		$data['quests_available'] = $this->quest_model->get_available_quests(2, $this->the_user->user_id);
		$data['logged_in'] = TRUE;
		}
		else {
		$data['logged_in'] = FALSE;
		}
		$data['posts'] = $this->post_model->get_posts(TRUE);

		$data['grades'] = $this->grade_model->get_grades("ASC");
		if (!$data['posts']) {
			redirect(base_url('admin/course/setup'));
		}
		$this->load->view('include/header', $data);
		$this->load->view('frontpage', $data);
		$this->load->view('include/footer');
	
	}
	

}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
