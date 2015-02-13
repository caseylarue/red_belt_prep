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

	public function get_reviews($book_id)
	{
		return $this->db->query("SELECT books.id as book_id, books.title, authors.first_name as author_first_name, authors.last_name as author_last_name, reviews.rating, users.id as user_id, users.first_name as reviewer_first_name, users.last_name as reviewer_last_name, users.alias, reviews.review, reviews.created_at
			FROM reviews
			JOIN books on books.id = reviews.book_id
			JOIN users on users.id = reviews.user_id
			JOIN authors on authors.id = books.author_id
			WHERE books.id=$book_id")->result_array();
	}

	public function get_latest_reviews()
	{
		return $this->db->query("SELECT books.id as book_id, books.title, authors.first_name as author_first_name, authors.last_name as author_last_name, reviews.rating, users.id as user_id, users.first_name as reviewer_first_name, users.last_name as reviewer_last_name, users.alias, reviews.review, reviews.created_at
			FROM reviews
			JOIN books on books.id = reviews.book_id
			JOIN users on users.id = reviews.user_id
			JOIN authors on authors.id = books.author_id
			ORDER BY created_at DESC")->result_array();
	}

	public function get_user_info($user_id)
	{
		return $this->db->query("SELECT 
			users.id, 
			users.first_name, 
			users.last_name, 
			users.alias,
			users.email
			FROM users
			WHERE users.id=$user_id", array($user_id))->row_array();
	}

	public function get_user_reviews($user_id)
	{
		return $this->db->query("SELECT 
		reviews.id,
		reviews.review,
		reviews.rating,
		reviews.created_at,
		books.id as book_id,
		books.title,
		authors.first_name,
		authors.last_name
		FROM reviews
		LEFT JOIN books on books.id = reviews.book_id
		LEFT JOIN authors on authors.id = books.author_id
		LEFT JOIN users on users.id = reviews.user_id
		WHERE users.id=?
		GROUP BY reviews.id", array($user_id))->result_array();
	}

	public function count_user_reviews($user_id)
	{
		return $this->db->query("SELECT 
		COUNT(reviews.created_at) as count
		FROM reviews
		LEFT JOIN users on users.id = reviews.user_id
		WHERE users.id=?", array($user_id))->row_array();
	}

	public function get_books_reviewed()
	{
		return $this->db->query("SELECT 
		reviews.created_at,
		books.title,
		books.id
		FROM reviews
		LEFT JOIN books on books.id = reviews.book_id
        Group BY title")->result_array();
	}

	public function get_authors()
	{
		return $this->db->query("SELECT id, first_name, last_name FROM authors GROUP BY first_name, last_name;")->result_array();
	}
}







