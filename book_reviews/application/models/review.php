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

	public function add_book($book)
	{
		$query = "INSERT INTO books (title, author, created_at) VALUES (?, ?, NOW())";
		$values = array($book['title'], $book['author_new']);
		return $this->db->query($query, $values);
	}

	public function add_review($book)
	{
		$query2 = "INSERT INTO reviews (user_id, book_id, review, rating, created_at) VALUES (?, ?, ?, ?, NOW())";
		$values = array($book['user_id'], $book['book_id'], $book['review'], $book['rating']);
		return $this->db->query($query2, $values);
	}

	public function retrieve_authors()
}