<html>
<head>
	<title>Edit User</title>
</head>
<body>
	<h1>Edit User #<?= $id ?></h1>
	<button><a href='/messages/admin_dashboard'>Return to Dashboard</a></button>
	<h2>Edit Information</h2>
	<form action="/messages/admin_edit_user_info/<?= $id ?>" method='post'>
		<input type='hidden' name='id' value="<?= $user['id'] ?>">
		<label>Email</label>
		<input type='text' name='email' value="<?= $user['email'] ?>">
		<label>First Name</label>
		<input type='text' name='first_name' value="<?= $user['first_name'] ?>">
		<label>Last Name</label>
		<input type='text' name='last_name' value="<?= $user['last_name'] ?>">
		<label>User Level</label>
<?php
		if($user['user_type'] == 'admin')
		{
?>
			<select name='user_type' value='admin'>
				<option value='admin'>Admin</option>
				<option value='normal'>Normal</option>
			</select>
<?php
		}
		else
		{
?>
			<select name='user_type' value='normal'>
				<option value='normal'>Normal</option>
				<option value='admin'>Admin</option>
			</select>
<?php	
		}
?>	
		<button type='submit'>Save</button>
	</form>
</body>
</html>