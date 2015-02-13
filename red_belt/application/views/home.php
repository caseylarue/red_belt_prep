<html>
<head>
	<title>Home</title>
</head>
<body>
	<a href="/main/index">Logoff</a>
	<h1>Hello, <?= $this->session->userdata('alias') ?></h1>
	<h3>Here is a list of your friends:</h3>
	<table>
		<thead>
			<td>Alias</td>
			<td>Action</td>
		</thead>
		<tbody>
<?php
	foreach($friends as $friend)
	{
?>
		<tr>
			<td><?= $friend['friend_alias'] ?></td>
			<td><a href="/main/profile/<?= $friend['friend_user_id']?>">View Profile</a></td>
			<td><a href="/main/remove_friend/<?= $friend['friend_user_id']?>">Remove as Friend</a></td>
		</tr>
<?php
	}
?>
	</tbody>
	</table>

	<h3>These users are not yet your friends!</h3>
	<table>
	</table>
</body>
</html>