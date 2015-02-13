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

	public function display_friends_requested($user_id)
	{
		return $this->db->query("SELECT friendships.friend_id as friend_user_id, users1.alias as friend_alias, friendships.id as friendship_id
			 FROM friendships
			 LEFT JOIN users ON friendships.user_id_request = users.id
			 LEFT JOIN users as users1 on users1.id = friendships.friend_id
			 WHERE user_id_request = ?", array($user_id, $user_id))->result_array();
	}

	public function display_profile($friend_id)
	{
		return $this->db->query("SELECT * FROM users WHERE users.id=?", array($friend_id))->row_array();
	}

	public function remove_friend($friendship_id)
	{
		$this->db->where('id', $friendship_id);
		$this->db->delete('friendships');
	}

	public function display_all_users()
	{
		return $this->db->query("SELECT * FROM users")->result_array();
	}

	public function add_friend($friend_user_id, $user_id)
	{
		$query = "INSERT INTO friendships (user_id_request, friend_id, created_at) VALUES (?,?,NOW())";
		$values = array($user_id, $friend_user_id);
		return $this->db->query($query, $values);
	}

	public function added_you($user_id)
	{
		return $this->db->query("SELECT users1.alias, users1.id as friend_id, friendships.id as friendship_id
		FROM friendships
		JOIN users as users1 on friendships.user_id_request = users1.id
		WHERE friendships.friend_id = ?", array($user_id))->result_array();
	}

}