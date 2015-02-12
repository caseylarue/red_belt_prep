<html>
<head>
	<title>User Dashboard</title>
	<style type="text/css">
		thead td {
			font-weight: bold;
		}
		td {
			padding: 5px;
		}
		.edit_info {
			background-color: blue;
			font-weight: bold;
			color: white;
			font-size: 24px;
			margin-top: 30px;
			margin-left: 500px;
			padding: 10px;
		}
	</style>
</head>
<body>
<?php
	require('nav_post_login.php');
?>
	<h1>All Users</h1>
	<table>
		<thead>
			<td>ID</td>
			<td>Name</td>
			<td>Email</td>
			<td>Created At</td>
			<td>User Level</td>
		</thead>
		<tbody>
	<?php
		foreach($users as $user)
		{
	?>
		<tr>
			<td><?= $user['id'] ?></td>
			<td><a href='/messages/profile/<?= $user['id'] ?>'><?= $user['first_name']." ".$user['last_name'] ?></a></td>
			<td><?= $user['email'] ?></td>
			<td><?= $user['created_at'] ?></td>
			<td><?= $user['user_type'] ?></td>
		</tr>
	<?php
		}
	?>
		</tbody>
	</table>
	<form action='/messages/edit_user_info/<?= $this->session->userdata('id') ?>' method='post'>
		<button class='edit_info'>Edit Your Info</button>
	</form>
</body>
</html>