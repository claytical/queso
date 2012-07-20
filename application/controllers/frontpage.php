<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Frontpage extends Public_Controller {

   public function index()
	{
      $this->load->view('include/header');
      $this->load->view('frontpage');
      $this->load->view('include/footer');
	}

	public function login()
	{
	    // if this request is a form submission
	    if ($_POST)
	    {
	        // get form values and xss filter the input
            $identity = $this->input->post('identity', true);
            $password = $this->input->post('password', true);

            // if user is logged in successfully
            if($this->ion_auth->login($identity,$password)) 
            {
                // send on to protected area ('user' controller)
                redirect('user');
            }
            else // incorrect creds
            {
                // load up error
                $data['error'] = "Incorrect Credentials";
                
                // load form view again, with error
                $this->load->view('login_form', $data);
            }
	    }
	    else // show form view
	    {
            $this->load->view('login_form');
	    }
	}
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
