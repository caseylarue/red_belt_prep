<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler();
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function register()
	{

		$this->load->library("form_validation");
		$this->form_validation->set_rules("name", "Name", "required");
		$this->form_validation->set_rules("alias", "Alias", "required");
		$this->form_validation->set_rules("email", "Email", "required|valid_email|is_unique[users.email]");
		$this->form_validation->set_rules("password", "Password", "required|min_length[8]|matches[password_confirm]");
		$this->form_validation->set_rules("password_confirm", "Password Confirmation", "required");
		$this->form_validation->set_rules("birth_date", "Birth Date", "required");
		if($this->form_validation->run() ===  FALSE)
		{
			$this->session->set_flashdata('validation_error',validation_errors());	
			redirect('/main/index');
		}
		else
		{	
				$user = $this->input->post();
				$this->load->model('Friend');
				$this->Friend->register($user);
				$user['id'] = $this->db->insert_id();
				$this->session->set_userdata($user);
				redirect("/main/home/".$user['id']);
		}
	}

	public function login()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("email", "Email", "required");
		$this->form_validation->set_rules("password", "Password", "required");
		if($this->form_validation->run() ===  FALSE)
		{
			$this->session->set_flashdata('login_error',validation_errors());	
			redirect('/main/index');
		}
		else
		{
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$this->load->model('Friend');
			$login = $this->Friend->login($email);
			$user_id = $login['id'];
			if($login && $login['password'] == $password)
			{
				$this->session->set_userdata($login);
				redirect("/main/home/$user_id");
			}
			else
			{
				$this->session->set_flashdata("login_error", "Invaild email or password!");
           		redirect("/main/index");
			}
		}
	}

	public function home($user_id)
	{
		$this->load->model('Friend');
		$friends = $this->Friend->display_friends_requested($user_id);
		$added_you = $this->Friend->added_you($user_id);
		$users = $this->Friend->display_all_users();
		$data = array('friends' => $friends, 'users' => $users, 'added_you' => $added_you);
		$this->load->view('home', $data);
	}

	public function profile($friend_id)
	{
		$this->load->model('Friend');
		$profile = $this->Friend->display_profile($friend_id);
		$data = array('profile' => $profile);
		$this->load->view('profile', $data);
	}

	public function remove_friend($friendship_id)
	{
		$this->load->model('Friend');
		$this->Friend->remove_friend($friendship_id);
		$user_id = $this->session->userdata('id');
		redirect("/main/home/$user_id");
	}

	public function add_friend($friend_user_id)
	{
		$user_id = $this->session->userdata('id');
		$this->load->model('Friend');
		// check to 
		$this->Friend->add_friend($friend_user_id, $user_id);
		redirect("/main/home/$user_id");

	}
}

//end of main controller