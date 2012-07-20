<?php

class User extends CI_Controller {

	private $the_user;
	
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	    // if the person accessing this controller is logged in     // ^
        if($this->ion_auth->logged_in()) {                          // ^
                                                                    // ^
            // get the user object                                  // ^
            $data->the_user = $this->ion_auth->user()->row();       // ^
                                                                    // ^
            // put the user object in class wide property--->---->-----
            $this->the_user = $data->the_user;
            
            // load $the_user in all displayed views automatically
            $this->load->vars($data);
        }
        else // person not logged in
        {
            // send back to the root site
            redirect('/');
        }
	
	}
	public function logout()
    
    {
        // log current user out and send back to public root
        $this->ion_auth->logout();
        redirect('/');
    }
    
	public function index() {
		$data['users'] = $this->user_model->get_info();
		$data['title'] = "Users";
		$data['instructions'] = "";
		$this->load->view('include/header');
		$this->load->view('users/index', $data);
      	$this->load->view('include/footer');
	}
	
	public function create() {
		//admin
		$this->load->helper('form');
		$data['title'] = "Create a Student";
		$data['instructions'] = "";
		$this->load->view('include/header');
		$this->load->view('users/create', $data);
      	$this->load->view('include/footer');
		
	}
	
	public function confirmation() {
		//admin
		$this->load->helper('email');

		$data['title'] = "User Created";
		$data['user'] = $this->user_model->create_user();
		$username = $data['user']['username'];
		$password = $data['user']['password'];
		$email = $data['user']['email'];
		send_email($email, 'New Account Created', 'Username: $username\nPassword:$password');
		$this->load->view('include/header');
		$this->load->view('users/confirmation', $data);
		$this->load->view('include/footer');
	}

	public function remove() {
		//admin
	}
	
	public function edit() {
		//admin
	}
	
	
	public function view($id) {
		//overview
		$data['user'] = $this->user_model->get_quests($id);
		
		if (empty($data['quests'])) {
			show_404();
		}
		
		$data['title'] = $data['user']['name'];
		
		$this->load->view('include/header');
		$this->load->view('user/view', $data);
      	$this->load->view('include/footer');
	}
}