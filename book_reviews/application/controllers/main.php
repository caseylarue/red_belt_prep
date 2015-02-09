<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

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

	public function login()
	{
		$login = $this->input->post();
		$this->load->Model('Review');
		$results = $this->Review->login($login);
		if($login['password'] == $results['password'])
		{
			$this->session->set_userdata('id', $results['id']);
			$this->session->set_userdata('alias', $results['alias']);
			$this->books();
		}
		else
		{
			echo "your email or password is invalid";
		}
	}

	public function register()
	{
		$user = $this->input->post();
		$this->load->Model('Review');
		$this->Review->register($user);
		$this->session->set_userdata('id', $this->db->insert_id());
		$this->session->set_userdata('alias', $user['alias']);
		redirect('/main/books');
	}

	public function books()
	{
		$this->load->view('books');
	}

	public function add()
	{
		$this->load->view('add');
	}

	public function add_book()
	{
		$data = $this->input->post();
		if($data['author_existing'] == 'new')
		{
			$book = $this->input->post();
			$this->load->Model('Review');
			$this->Review->add_book($book);
			$book['book_id'] = $this->db->insert_id();
			$this->add_review($book);
		}
		else 
		{
			echo "this is not a new author!";
		}
	}

	public function add_review($book)
	{
		$this->load->Model('Review');
		$this->Review->add_review($book);
	}
}

//end of main controller