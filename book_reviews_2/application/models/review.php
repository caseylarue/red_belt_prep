<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review extends CI_Model {

	public function register($user)
	{
		$query = "INSERT INTO users (first_name, last_name, alias, email, password, created_at) VALUES (?,?,?,?,?,NOW())";
		$values = array($user['first_name'], $user['last_name'], $user['alias'], $user['email'], $user['password']);
		return $this->db->query($query, $values);
	}

	public function login($email)
	{
		return $this->db->query("SELECT * FROM users WHERE users.email=?", array($email))->row_array();
	}

	public function add_author($review)
	{
		$query = "INSERT INTO authors (first_name, last_name, created_at) VALUES (?,?,NOW())";
		$values = array($review['author_first_name'], $review['author_last_name']);
		return $this->db->query($query, $values);
	}

	public function add_book($review)
	{
		$query = "INSERT INTO books (author_id, title, created_at) VALUES (?,?,NOW())";
		$values = array($review['author_id'], $review['title']);
		return $this->db->query($query, $values);
	}

	public function add_review($review)
	{
		$query = "INSERT INTO reviews (book_id, review, user_id, rating, created_at) VALUES (?,?,?,?,NOW())";
		$values = array($review['book_id'], $review['review'], $review['user_id'], $review['rating']);
		return $this->db->query($query, $values);
	}
}
	