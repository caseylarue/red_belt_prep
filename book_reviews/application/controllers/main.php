<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->enable_profiler();
	}

	public function nav()
	{
		$this->load->view('nav');
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

	
	public function home()
	{
		$this->load->model('Review');
		$reviews = $this->Review->get_latest_reviews();
		$books = $this->Review->get_books_reviewed();
		$this->load->view('home', array('reviews' => $reviews, 'books' => $books));
	}

	public function add()
	{
		$this->load->model('Review');
		$authors = $this->Review->get_authors();
		$this->load->view('add_review', array('authors' => $authors));
	}

	public function add_book()
	{

		$data = $this->input->post();

		if($data['author_id'] == 'new')
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
			$book_id = $input['book_id'];
			redirect('/main/get_reviews/'.$book_id);
		}
		else 
		{
			$input = $this->input->post();	
			$this->load->Model('Review');
			$this->Review->add_book($input);
			$input['book_id'] = $this->db->insert_id();
			$this->Review->add_review($input);
			$book_id = $input['book_id'];
			redirect('/main/get_reviews/'.$book_id);
		}
	}

	public function get_reviews($book_id)
	{
		$this->load->Model('Review');
		$reviews = $this->Review->get_reviews($book_id);
		$this->load->view('reviews', array('reviews' => $reviews));
	}

	public function add_review($book_id)
	{
		$input = $this->input->post();
		$this->load->Model('Review');
		$this->Review->add_review($input);
		redirect('/main/get_reviews/'.$book_id);
	}

	public function user_page($user_id)
	{
		$this->load->Model('Review');
		$info = $this->Review->get_user_info($user_id);
		$reviews = $this->Review->get_user_reviews($user_id);
		$count = $this->Review->count_user_reviews($user_id);
		$this->load->view('user_page', array('info' => $info, 'reviews' => $reviews, 'count' => $count));
	}

}

//end of main controller