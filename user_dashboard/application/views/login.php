<html>
<head>
	<title>Login_Registration</title>
</head>
<body>
<?php
	require('nav_pre_login.php');
	if($this->session->flashdata("login_error"))
	{
		echo $this->session->flashdata("login_error");
	}

	if($this->session->flashdata("validation_error"))
	{
		echo $this->session->flashdata("validation_error");
	}
	
?>
	<h2>Login</h2>
	<form action='/messages/login' method='post'>
		<label>Email</label>
		<input type='text' name='email'>
		<label>Password</label>
		<input type='text' name='password'>
		<input type='submit'>
	</form>
	<h2>Register</h2>
	<form action='/messages/register' method='post'>
		<label>Email</label>
		<input type='text' name='email'>
		<label>First Name</label>
		<input type='text' name='first_name'>
		<label>Last Name</label>
		<input type='text' name='last_name'>
		<label>Password</label>
		<input type='text' name='password'>
		<label>Password Confirm</label>
		<input type='text' name='password_confirm'>
		<input type='submit'>
	</form>
</body>
</html>