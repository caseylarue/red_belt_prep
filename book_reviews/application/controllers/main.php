<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler();
	}

	public function index()
	{
		// $this->session->sess_destroy();
		$this->load->view('index');
	}

	public function login()
	{
		$login = $this->input->post();
		$this->load->Model('Review');
		$results = $this->Review->login($login);
		if($login['password'] == $results['password'])
		{
			$this->session->set_userdata('id', $results['id']);
			$this->session->set_userdata('alias', $results['alias']);
			redirect('/main/home');
		}
		else
		{
			echo "your email or password is invalid";
		}
	}

	public function register()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("first_name", "First Name", "required");
		$this->form_validation->set_rules("last_name", "Last Name", "required");
		$this->form_validation->set_rules("alias", "Alias", "required");
		$this->form_validation->set_rules("email", "Email", "required|valid_email|is_unique[users.email]");
		$this->form_validation->set_rules("password", "Password", "min_length[8]");
		$this->form_validation->set_rules("password_confirm", "Password Confirmation", "matches[confirm_password]");
		
		if($this->form_validation->run() ===  FALSE)
		{
			// the flashdata does not show
			$this->session->set_flashdata('validation_error',validation_errors());	
			$this->index();
		}
		else
		{
			$user = $this->input->post();
			$this->load->Model('Review');
			$this->Review->register($user);
			$this->session->set_userdata('id', $this->db->insert_id());
			$this->session->set_userdata('alias', $user['alias']);
			redirect('/main/home');
		}
	}

	public function get_reviews()
	{
		$this->load->Model('Review');
		$this->Review->get_reviews();
	}

	public function home()
	{
		$this->load->view('home');
	}


	public function add()
	{
		$this->load->view('add_review');
	}

	public function add_book()
	{
		// add to authors table
		$data = $this->input->post();
		if($data['author_existing'] == 'new')
		{
			// add form validation is unique
			$input = $this->input->post();
			$this->load->Model('Review');
			$this->Review->add_author($input);

			$input['author_id'] = $this->db->insert_id();
			$this->Review->add_book($input);

 
			$input['book_id'] = $this->db->insert_id();
			$input['user_id'] = $this->session->userdata('id');
			$this->Review->add_review($input);
			$this->get_reviews();
		}
		else 
		{
			echo "this is not a new author!";
		}
	}

	public function get_reviews()
	{

		redirect('/main/reviews/'.$input['book_id'])
	}

}

//end of main controller