<?php
class Admin_Controller extends CI_Controller {

    protected $the_user;

    function __construct() {

        parent::__construct();
		$this->load->model('quest_model');
		$this->load->model('grade_model');
		$this->load->model('post_model');
		$this->load->model('submission_model');
		$this->load->model('menu_model');
		$this->load->model('course_model');
		$data = new StdClass;

        if($this->ion_auth->is_admin()) {
            $this->the_user = $this->ion_auth->user()->row();
  			$data->the_user = $this->the_user;
//  			$data->grade = $this->grade_model->get_current_grade($this->the_user->user_id);
  			$data->dropdown = $this->course_model->get_variable("dropdown");

  			$data->site_name = $this->course_model->get_variable("site");
			$data->menu = $this->menu_model->get_items();
  			$data->theme = $this->course_model->get_variable("theme");
			$data->progress = $this->quest_model->get_charted_progress($this->the_user->user_id);
			$data->current = $this->grade_model->get_current_grade($this->the_user->user_id);
			$data->quests_completed = $this->quest_model->get_completed_quests($this->the_user->user_id);
			$data->quests_pending = $this->submission_model->get_ungraded_submissions($this->the_user->user_id);
			$data->quests_revisions = $this->submission_model->get_revised_submissions($this->the_user->user_id);
			$data->quests_available = $this->quest_model->get_available_quests(2, $this->the_user->user_id);
			$data->logged_in = TRUE;

            $this->load->vars($data);
        }
        else {
            redirect('/');
        }
    }

}

class Public_Controller extends CI_Controller {

    protected $the_user;

    function __construct() {

        parent::__construct();
		$this->load->model('menu_model');
		$this->load->model('course_model');
		$this->load->model('quest_model');
		$this->load->model('grade_model');
		$this->load->model('post_model');
		$this->load->model('submission_model');

		$data = new StdClass;

        if($this->ion_auth->in_group('members')) {
            $this->the_user = $this->ion_auth->user()->row();
  			$data->the_user = $this->the_user;
	  		$data->logged_in = TRUE;
			$data->progress = $this->quest_model->get_charted_progress($this->the_user->user_id);
			$data->current = $this->grade_model->get_current_grade($this->the_user->user_id);
  			$data->dropdown = $this->course_model->get_variable("dropdown");
			$data->quests_completed = $this->quest_model->get_completed_quests($this->the_user->user_id);
			$data->quests_pending = $this->submission_model->get_ungraded_submissions($this->the_user->user_id);
			$data->quests_revisions = $this->submission_model->get_revised_submissions($this->the_user->user_id);
			$data->quests_available = $this->quest_model->get_available_quests(2, $this->the_user->user_id);
			
        }
        else {
        	$data->logged_in = FALSE;

        }
     	
     	$data->menu = $this->menu_model->get_items(); 	
  		$data->site_name = $this->course_model->get_variable("site");
  		$data->theme = $this->course_model->get_variable("theme");

        $this->load->vars($data);

    }

}


class User_Controller extends CI_Controller {

    protected $the_user;

    function __construct() {

        parent::__construct();
		$this->load->model('menu_model');
		$this->load->model('course_model');
		$this->load->model('quest_model');
		$this->load->model('grade_model');
		$this->load->model('post_model');
		$this->load->model('submission_model');
		
		$data = new StdClass;

        if($this->ion_auth->in_group('members')) {
            $this->the_user = $this->ion_auth->user()->row();
            $data->the_user = $this->the_user;
	     	$data->menu = $this->menu_model->get_items(); 			    
  			$data->site_name = $this->course_model->get_variable("site");
  			$data->theme = $this->course_model->get_variable("theme");
  			$data->dropdown = $this->course_model->get_variable("dropdown");
			$data->logged_in = TRUE;     	
			$data->progress = $this->quest_model->get_charted_progress($this->the_user->user_id);
			$data->current = $this->grade_model->get_current_grade($this->the_user->user_id);
			$data->quests_completed = $this->quest_model->get_completed_quests($this->the_user->user_id);
			$data->quests_pending = $this->submission_model->get_ungraded_submissions($this->the_user->user_id);
			$data->quests_revisions = $this->submission_model->get_revised_submissions($this->the_user->user_id);
			$data->quests_available = $this->quest_model->get_available_quests(2, $this->the_user->user_id);

            $this->load->vars($data);
        }
        else {
            redirect('/');
        }
    }
}

class Common_Auth_Controller extends CI_Controller {

    protected $the_user;

    function __construct() {

        parent::__construct();
		$this->load->model('menu_model');
		$this->load->model('course_model');
		$this->load->model('quest_model');
		$this->load->model('grade_model');
		$this->load->model('post_model');
		$this->load->model('submission_model');

		$data = new StdClass;

        if($this->ion_auth->logged_in()) {
         	$this->the_user = $this->ion_auth->user()->row();
            $data->the_user = $this->the_user;
	     	$data->menu = $this->menu_model->get_items(); 			        
  			$data->site_name = $this->course_model->get_variable("site");
  			$data->theme = $this->course_model->get_variable("theme");
  			$data->dropdown = $this->course_model->get_variable("dropdown");

			$data->logged_in = TRUE;
			$data->progress = $this->quest_model->get_charted_progress($this->the_user->user_id);
			$data->current = $this->grade_model->get_current_grade($this->the_user->user_id);
			$data->quests_completed = $this->quest_model->get_completed_quests($this->the_user->user_id);
			$data->quests_pending = $this->submission_model->get_ungraded_submissions($this->the_user->user_id);
			$data->quests_revisions = $this->submission_model->get_revised_submissions($this->the_user->user_id);
			$data->quests_available = $this->quest_model->get_available_quests(2, $this->the_user->user_id);

            $this->load->vars($data);
        }
        else {
            redirect('/');
        }
    }
}