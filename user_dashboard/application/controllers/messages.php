<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler();
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$this->load->model("Message");
		$login = $this->Message->user_login($email);
		if($login && $login['password'] == $password)
		{
			$this->session->set_userdata($login);
			if($login['user_type'] == 'admin')
			{
				redirect("/messages/admin_dashboard");
			}
			else 
			{
				redirect("/messages/user_dashboard");
			}
		}
		else
		 {
           $this->session->set_flashdata("login_error", "Invaild email or password!");
           redirect("/messages/index");
          } 
	}

	public function register()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("first_name", "First Name", "required");
		$this->form_validation->set_rules("last_name", "Last Name", "required");
		$this->form_validation->set_rules("email", "Email", "required|valid_email|is_unique[users.email]");
		$this->form_validation->set_rules("password", "Password", "min_length[8]");
		$this->form_validation->set_rules("confirm_password", "Password Confirmation", "matches[confirm_password]");
		if($this->form_validation->run() ===  FALSE)
		{
			$this->session->set_flashdata('validation_error',validation_errors());	
			redirect('/messages/index');
		}
		else
		{
			$user = $this->input->post();
			$this->load->model("Message");
			// check to see if this is the first user for app, Y - make admin
			if(empty($this->Message->get_user_id()))
			{
				$user['user_type'] = 'admin';
			}
			else
			{
				$user['user_type'] = 'normal';
			}
			$this->Message->register_user($user);
			$this->session->set_userdata($user);
			if($user['user_type'] == 'admin')
			{
				redirect("/messages/admin_dashboard");
			}
			else 
			{
				redirect("/messages/user_dashboard");
			}
		}
	}

	public function user_dashboard()
	{
		echo "user_dashboard";
		// $this->load->('user_dashboard')
	}

	public function admin_dashboard()
	{
		echo "admin_dashboard";
		// $this->load->('user_dashboard')
	}
}

//end of main controller