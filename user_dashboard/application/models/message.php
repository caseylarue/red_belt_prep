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

	public function admin_delete_user($id)
	{
		$this->db->delete('users', array('id' => $id));
	}

	public function post_message($message)
	{
		$query = "INSERT INTO messages (user_id_message_to, user_id_message_from, message, created_at) VALUES (?,?,?,NOW())";
		$values = array($message['user_id_message_to'], $message['user_id_message_from'], $message['message']);
		return $this->db->query($query, $values);
	}

	public function get_messages($id)
	{
		return $this->db->query("SELECT messages.id, messages.message, messages.created_at, users1.first_name as message_from_first_name, users1.last_name as message_from_last_name
			FROM messages
			JOIN users as users1 on messages.user_id_message_from = users1.id
			WHERE messages.user_id_message_to=?", array($id))->result_array();
	}

	public function post_comment($comment, $profile_id)
	{
		$query = "INSERT INTO comments (message_id, comment, user_id_comment_from, created_at) VALUES (?,?,?,NOW())";
		$values = array($comment['message_id'], $comment['comment'], $comment['user_id_comment_from']);
		return $this->db->query($query, $values);
	}

	public function get_comments($id)
	{
		return $this->db->query("SELECT comments.message_id, comments.comment, comments.user_id_comment_from, users1.first_name as comment_from_first_name, users1.last_name as comment_from_last_name, comments.created_at
			FROM comments
			LEFT JOIN messages on messages.id = comments.message_id
			LEFT JOIN users as users1 on users1.id = comments.user_id_comment_from
			WHERE messages.user_id_message_to=?", array($id))->result_array();
	}

	public function user_edit_info($user)
	{
		$data = array(
				'first_name' => $user['first_name'],
				'last_name' => $user['last_name'],
				'email' => $user['email'],
				'description' => $user['description'],
				'updated_at' => $user['updated_at'] 
			);
		$this->db->where('id', $user['id']);
		$this->db->update('users', $data);
	}

	public function update_password($user, $id)
	{
		$data = array(
				'password' => $user['password'],
				'updated_at' => $user['updated_at']
			);
		$this->db->where('id', $id);
		$this->db->update('users', $data);
	}
}