<?php

class Review extends CI_Model {

	public function register($user)
	{
		$query = "INSERT INTO users (name, alias, email, password, created_at) VALUES (?, ?, ?, ?, NOW())";
		$values = array($user['name'], $user['alias'], $user['email'], $user['password']);
		return $this->db->query($query, $values);
	}

	public function login($user)
	{
		return $this->db->query("SELECT * FROM users WHERE email = ?", array($user['email']))->row_array();
	}

	public function add_author($input)
	{
		$query = "INSERT INTO authors (first_name, last_name, created_at) VALUES (?, ?, NOW())";
		$values = array($input['first_name'], $input['last_name']);
		return $this->db->query($query, $values);
	}

	public function add_book($input)
	{
		$query = "INSERT INTO books (author_id, title, created_at) VALUES (?, ?, NOW())";
		$values = array($input['author_id'], $input['title']);
		return $this->db->query($query, $values);
	}

	public function add_review($input)
	{
		$query2 = "INSERT INTO reviews (user_id, book_id, review, rating, created_at) VALUES (?, ?, ?, ?, NOW())";
		$values = array($input['user_id'], $input['book_id'], $input['review'], $input['rating']);
		return $this->db->query($query2, $values);
	}

	public function get_reviews()
	{
		return $this->db->query("SELECT * FROM users WHERE email = ?", array($user['email']))->results_array();
	}
}