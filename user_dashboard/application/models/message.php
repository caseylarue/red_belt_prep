<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Model {
	
	public function register_user($user)
	{
		$query = "INSERT INTO users (first_name, last_name, email, password, user_type, created_at) VALUES (?,?,?,?,?,NOW())";
		$values = array($user['first_name'], $user['last_name'], $user['email'], $user['password'], $user['user_type']);
		return $this->db->query($query, $values);
	}

	public function get_user_id()
	{
		return $this->db->query("SELECT * FROM users ORDER BY users.id")->row_array();
	}

	public function user_login($email)
	{
		return $this->db->query("SELECT * FROM users WHERE users.email=?", array($email))->row_array();
	}

}