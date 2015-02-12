<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler();
	}

	public function index()
	{
		$this->session->sess_destroy();
		$this->load->view('index');
	}

	public function load_login()
	{
		$this->load->view('login');
	}

	public function nav_post_login()
	{
		$this->load->view('nav_post_login');
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
           redirect("/messages/login");
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
		$this->load->Model('Message');
		$users = $this->Message->get_all_users();
		$data = array('users' => $users);
		$this->load->view('user_dashboard', $data);
	}

	public function edit_user_info($id)
	{
		$this->load->Model('Message');
		$user = $this->Message->get_user_info($id);
		$this->load->view('edit_user_info', array('id' => $id, 'user' => $user));
	}

	public function user_edit_info($id)
	{
		$user = $this->input->post();
		$user['updated_at'] = date('Y-m-d h:i:s');
		$this->load->Model('Message');
		$this->Message->user_edit_info($user);
		redirect("/messages/edit_user_info/$id");
	}

	public function edit_user_password($id)
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("password", "Password", "required|min_length[8]");
		$this->form_validation->set_rules("password_confirm", "Password Confirmation", "required|matches[password_confirm]");
		if($this->form_validation->run() ===  FALSE)
		{
			$this->session->set_flashdata('validation_error',validation_errors());
			redirect("/messages/edit_user_info/$id");
		}
		else
		{
			$user['password'] = $this->input->post('password');
			$user['updated_at'] = date('Y-m-d h:i:s');
			$this->load->Model('Message');
			$this->Message->update_password($user, $id);
			$this->session->set_flashdata('success','you have updated your password');
			redirect("/messages/edit_user_info/$id");
		}
	}

	public function admin_dashboard()
	{
		$this->load->Model('Message');
		$users = $this->Message->get_all_users();
		$array = array('users' => $users);
		$this->load->view('admin_dashboard', $array);
	}

	public function admin_edit_user($id)
	{
		$this->load->Model('Message');
		$user = $this->Message->get_user_info($id);
		$this->load->view('admin_edit_user', array('id' => $id, 'user' => $user));
	}

	public function admin_edit_user_info($id)
	{
		$user = $this->input->post();
		$user['updated_at'] = date('Y-m-d h:i:s');
		$this->load->Model('Message');
		$this->Message->admin_edit_user($user);
		redirect('/messages/admin_dashboard');
	}

	public function admin_remove_user($id)
	{
		$this->load->Model('Message');
		$this->Message->admin_delete_user($id);
		redirect('/messages/admin_dashboard');
	}

	public function admin_add_user()
	{
		$this->load->view('admin_add_user');
	}

	public function admin_add_user_new()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("first_name", "First Name", "required");
		$this->form_validation->set_rules("last_name", "Last Name", "required");
		$this->form_validation->set_rules("email", "Email", "required|valid_email|is_unique[users.email]");
		$this->form_validation->set_rules("password", "Password", "min_length[8]");
		$this->form_validation->set_rules("confirm_password", "Password Confirmation", "matches[confirm_password]");
		if($this->form_validation->run() ===  FALSE)
		{
			$this->session->keep_flashdata('validation_error',validation_errors());	
			redirect('/messages/admin_add_user');
		}
		else
		{
			$user = $this->input->post();
			$this->load->model("Message");
			$this->Message->register_user($user);
			redirect('/messages/admin_dashboard');
		}
	}

	public function profile($id)
	{
		$this->load->model("Message");
		$user = $this->Message->get_user_info($id);
		$messages = $this->Message->get_messages($id);
		$comments = $this->Message->get_comments($id);
		$data = array(
				'user' => $user,
				'messages' => $messages,
				'comments' => $comments
			);
		$this->load->view('profile', $data);
	}

	public function leave_message($profile_id)
	{
		$this->load->model("Message");
		$message = $this->input->post();
		$this->Message->post_message($message);
		redirect("/messages/profile/$profile_id");
	}

	public function leave_comment($profile_id)
	{
		$this->load->model("Message");
		$comment = $this->input->post();
		$this->Message->post_comment($comment, $profile_id);
		redirect("/messages/profile/$profile_id");
	}
}

//end of main controller