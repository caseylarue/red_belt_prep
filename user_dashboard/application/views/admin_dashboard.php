<html>
<head>
	<title>Admin Dashboard</title>
	<style type="text/css">
		thead td {
			font-weight: bold;
		}
		td {
			padding: 5px;
		}
		.add_new {
			background-color: blue;
			font-weight: bold;
			color: white;
			font-size: 24px;
			margin-top: 30px;
			margin-left: 500px;
			padding: 10px;
		}
	</style>
	<script type="text/javascript" src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js'></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.remove').click(function(){
				if(window.confirm('Are you sure?')) {
					$('#content').load($(this).attr('href'));
				}
				else {
					return false;
				}
			});
		});
	</script>
</head>
<body>
	<table>
		<thead>
			<td>ID</td>
			<td>Name</td>
			<td>Email</td>
			<td>Created At</td>
			<td>User Level</td>
			<td>Actions</td>
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
			<td><a href="/messages/admin_edit_user/<?= $user['id'] ?>">edit</a> <a class='remove' href="/messages/admin_remove_user/<?= $user['id'] ?>">remove</a></td>
		</tr>
	<?php
		}
	?>
		</tbody>
	</table>
	<form action='/messages/admin_add_user' method='post'>
		<button class='add_new'>Add New User</button>
	</form>
</body>
</html>