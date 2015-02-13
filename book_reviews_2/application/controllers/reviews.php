<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reviews extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler();
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function home()
	{
		$this->load->view('home');
	}

	public function register()
	{
		$this->load->library("form_validation");
		$this->form_validation->set_rules("first_name", "First Name", "required");
		$this->form_validation->set_rules("last_name", "Last Name", "required");
		$this->form_validation->set_rules("email", "Email", "required|valid_email|is_unique[users.email]");
		$this->form_validation->set_rules("password", "Password", "required|min_length[8]|matches[password_confirm]");
		$this->form_validation->set_rules("password_confirm", "Password Confirmation", "required");
		if($this->form_validation->run() ===  FALSE)
		{
			$this->session->set_flashdata('validation_error',validation_errors());	
			redirect('/reviews/index');
		}
		else
		{	
			$user = $this->input->post();
			$this->load->model('Review');
			$this->Review->register($user);	
			$user['id'] = $this->db->insert_id();
			$this->session->set_userdata($user);
			redirect('/reviews/home');
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
			redirect('/reviews/index');
		}
		else
		{
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$this->load->model('Review');
			$login = $this->Review->login($email);
			if($login && $login['password'] == $password)
			{
				$this->session->set_userdata($login);
				redirect('/reviews/home');
			}
			else
			{
				$this->session->set_flashdata("login_error", "Invaild email or password!");
           		redirect("/reviews/index");
			}
		}
	}

	public function add()
	{
		$this->load->view('add_review');
	}

	public function add_review()
	{
		$review = $this->input->post();
		$this->load->model('Review');
		$this->Review->add_author($review);
		$review['author_id'] = $this->db->insert_id();
		$this->Review->add_book($review);
		$review['book_id'] = $this->db->insert_id();
		$this->Review->add_review($review);
		redirect("/reviews/book_review_page/".$review['book_id']);
	}

	public function book_review_page($book_id)
	{
		$this->load->model('Review');
		$this->Review->get_book_reviews($book_id);
		
		// $this->load->view('book_review_page', $book_id);
	}

}


//end of main controller