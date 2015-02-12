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

	public function get_all_users()
	{
		return $this->db->query("SELECT * FROM users")->result_array();
	}

	public function get_user_info($id)
	{
		return $this->db->query("SELECT * FROM users WHERE id=?", array($id))->row_array();
	}

	public function admin_edit_user($user)
	{
		$data = array(
				'first_name' => $user['first_name'],
				'last_name' => $user['last_name'],
				'email' => $user['email'],
				'user_type' => $user['user_type'],
				'updated_at' => $user['updated_at'] 
			);
		$this->db->where('id', $user['id']);
		$this->db->update('users', $data);
	}

}