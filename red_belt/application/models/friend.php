<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Friend extends CI_Model 
{

	public function register($user)
	{
		$query = "INSERT INTO users (name, alias, email, password, birth_date, created_at) VALUES (?,?,?,?,?,NOW())";
		$values = array($user['name'], $user['alias'], $user['email'], $user['password'], $user['birth_date']);
		return $this->db->query($query, $values);
	}

	public function login($email)
	{
		return $this->db->query("SELECT * FROM users WHERE users.email=?", array($email))->row_array();
	}

	public function display_friends($user_id)
	{
		return $this->db->query("SELECT friendships.friend_id as friend_user_id, users1.alias as friend_alias
			 FROM friendships
			 LEFT JOIN users ON friendships.user_id_request = users.id
			 LEFT JOIN users as users1 on users1.id = friendships.friend_id
			 WHERE user_id_request = ?", array($user_id))->result_array();
	}

	public function display_profile($friend_id)
	{
		return $this->db->query("SELECT * FROM users WHERE users.id=?", array($friend_id))->row_array();
	}

}