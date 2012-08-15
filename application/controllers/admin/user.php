<?php

class User extends User_Controller {

	//private $the_user;
	
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');

	}
	
	public function view($id) {
		$this->load->model('quest_model');
		$this->load->model('grade_model');
		$this->load->model('submission_model');
		$this->load->model('skill_model');
		
		$data['progress'] = $this->quest_model->get_charted_progress($id);
		$data['grades'] = $this->grade_model->get_grades("ASC");
		$info = $this->user_model->get_info($id);
		$data['title'] = $info['username'];
		$data['current'] = $this->grade_model->get_current_grade($id);
		
		$quests = $this->quest_model->get_completed_quests($id);		
		foreach ($quests as $quest) {
			if ($quest) {
			//submission
				if ($quest->type == 2) {
					$sid = $this->quest_model->get_latest_submission_id($quest->qid, $id);
				}
				if ($quest->type == 3) {
					$sid = $this->quest_model->get_latest_file_id($quest->qid, $id);
				}
			}
			else {
				$sid = 0;
			}
			$questBestPossible = $this->quest_model->get_quest_skills($quest->qid, TRUE);
				foreach ($questBestPossible as $bestSkill) {
					//compare to current progress
					$current = $this->quest_model->current_progress($bestSkill[0]->skid, $quest->qid, $id);
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
		$data['summary'] = $this->skill_model->get_total_by_user($id);

		
		
		
		$this->load->view('include/header');
		$this->load->view('users/profile', $data);
		$this->load->view('users/completed', $data);
		$this->load->view('include/footer');
	
	}
	
	
}