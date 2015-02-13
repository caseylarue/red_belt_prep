<html>
<head>
	<title>Home</title>
</head>
<body>
	<a href="/main/index">Logoff</a>
	<h1>Hello, <?= $this->session->userdata('alias') ?></h1>
	<h3>Here is a list of your friends:</h3>
	<table>

		<tbody>
<?php
	foreach($friends as $friend)
	{
?>
		<tr>
			<td><?= $friend['friend_user_id'] ?></td>
			<td><?= $friend['friend_alias'] ?></td>
			<td><a href="/main/profile/<?= $friend['friend_user_id']?>">View Profile</a></td>
			<td><a href="/main/remove_friend/<?= $friend['friendship_id']?>">Remove as Friend</a></td>
		</tr>
<?php
	}
	foreach($added_you as $value)
	{
?>
		<tr>
			<td><?= $value['friend_id'] ?></td>
			<td><?= $value['alias'] ?></td>
			<td><a href="/main/profile/<?= $value['friend_id']?>">View Profile</a></td>
			<td><a href="/main/remove_friend/<?= $value['friendship_id']?>">Remove as Friend</a></td>
		</tr>
<?php
	}
?>
	</tbody>
	</table>

	<h3>These users are not yet your friends!</h3>
	<table>
<?php
	foreach($users as $user)
	{
		if(!empty($friends))
		{
			if(($user['id'] != $friend['friend_user_id']) && ($this->session->userdata('id') != $user['id']))
			{
?>
				<tr>
					<td><?= $user['id'] ?></td>
					<td><?= $user['alias'] ?></td>
					<td><a href="/main/add_friend/<?= $user['id'] ?>">Add as a friend!</a></td>
				</tr>
<?php
			}
		}
		else
		{
			if(($this->session->userdata('id') != $user['id']))
			{
?>
			<tr>
				<td><?= $user['id'] ?></td>
				<td><?= $user['alias'] ?></td>
				<td><a href="/main/add_friend/<?= $user['id'] ?>">Add as a friend!</a></td>
			</tr>
<?php
			}
		}
	}
?>
	</table>
</body>
</html>