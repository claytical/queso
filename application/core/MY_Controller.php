<?php
class Admin_Controller extends CI_Controller {

    protected $the_user;

    function __construct() {

        parent::__construct();

		$this->load->model('menu_model');
		$this->load->model('course_model');
		$data = new StdClass;

        if($this->ion_auth->is_admin()) {
            $this->the_user = $this->ion_auth->user()->row();
  			$data->the_user = $this->the_user;
  			$data->site_name = $this->course_model->get_variable("site");
			$data->menu = $this->menu_model->get_items();
  			$data->theme = $this->course_model->get_variable("theme");

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

		$data = new StdClass;

        if($this->ion_auth->in_group('members')) {
            $this->the_user = $this->ion_auth->user()->row();
  			$data->the_user = $this->the_user;
        }
        else {
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
		
		$data = new StdClass;

        if($this->ion_auth->in_group('members')) {
            $this->the_user = $this->ion_auth->user()->row();
            $data->the_user = $this->the_user;
	     	$data->menu = $this->menu_model->get_items(); 			    
  			$data->site_name = $this->course_model->get_variable("site");
  			$data->theme = $this->course_model->get_variable("theme");
	     	
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
		$data = new StdClass;

        if($this->ion_auth->logged_in()) {
         	$this->the_user = $this->ion_auth->user()->row();
            $data->the_user = $this->the_user;
	     	$data->menu = $this->menu_model->get_items(); 			        
  			$data->site_name = $this->course_model->get_variable("site");
  			$data->theme = $this->course_model->get_variable("theme");

            $this->load->vars($data);
        }
        else {
            redirect('/');
        }
    }
}