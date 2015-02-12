<html>
<head>
	<title>Admin Add User</title>
	<style type="text/css">
		form label, input, button {
			display: block;
			margin: 10px;
		}
		.to_dashboard {
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
	<h1>Add a new user</h1>
<?php
	if($this->session->flashdata("validation_error"))
	{
		echo $this->session->flashdata("validation_error");
	}
?>
	<form action='/messages/admin_add_user_new' method='post'>
		<label>Email</label>
		<input type='text' name='email'>
		<label>First Name</label>
		<input type='text' name='first_name'>
		<label>Last Name</label>
		<input type='text' name='last_name'>
		<label>Password</label>
		<input type='text' name='password'>
		<label>Password Confirm</label>
		<input type='text' name='confirm_password'>
		<label>User Type</label>
		<input type='text' name='user_type'>
		<button type='submit'>Create</button>
	</form>
	<form action='/messages/admin_dashboard' method='post'>
		<button class='to_dashboard'>Back to Dashboard</button>
	</form>
</body>
</html>