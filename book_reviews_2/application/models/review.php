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

	public function get_book_reviews($book_id)
	{
		return $this->db->query("SELECT reviews.id as review_id, books.id as book_id,books.title, authors.first_name, authors.last_name, reviews.review, reviews.rating, users.alias, users.id as reviewer_id, reviews.created_at, reviews.deleted
			FROM reviews
			LEFT JOIN books on books.id = reviews.book_id
			LEFT JOIN authors on authors.id = books.author_id
			LEFT JOIN users on users.id = reviews.user_id
			WHERE books.id = ?
			ORDER BY reviews.created_at DESC", array($book_id))->result_array();
	}

	public function delete_review($review)
	{
		$data = array(
				'deleted' => $review['delete'],
				'updated_at' => $review['updated_at']
			);
		$this->db->where('id', $review['review_id']);
		$this->db->update('reviews', $data);
	}

	public function get_all_reviews()
	{
		return $this->db->query("SELECT reviews.id as review_id, books.id as book_id,books.title, authors.first_name, authors.last_name, reviews.review, reviews.rating, users.alias, users.id as reviewer_id, reviews.created_at, reviews.deleted
			FROM reviews
			LEFT JOIN books on books.id = reviews.book_id
			LEFT JOIN authors on authors.id = books.author_id
			LEFT JOIN users on users.id = reviews.user_id
			ORDER BY reviews.created_at DESC")->result_array();
	}

	public function get_all_books()
	{
		return $this->db->query("SELECT * 
		FROM books
		JOIN reviews on books.id = reviews.book_id")->result_array();
	}

	public function get_authors()
	{
		return $this->db->query("SELECT * FROM authors
		ORDER BY first_name")->result_array(); 
	}

	public function get_books()
	{
		return $this->db->query("SELECT * FROM books
		ORDER BY title")->result_array(); 
	}
}
	