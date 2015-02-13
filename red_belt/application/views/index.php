<html>
<head>
	<title>Welcome!</title>
</head>
<body>
<?php
		if($this->session->flashdata("validation_error"))
		{
			echo $this->session->flashdata("validation_error");
		}
?>
	<h2>Register</h2>
	<form action='/main/register' method='post'>
		<label>Name</label>
		<input type='text' name='name'>
		<label>Alias</label>
		<input type='text' name='alias'>
		<label>Email</label>
		<input type='text' name='email'>
		<label>Password</label>
		<input type='text' name='password'>
		<label>Password Confirm</label>
		<input type='text' name='password_confirm'>
		<label>Date of Birth</label>
		<input type='date' name='birth_date'>
		<input type='submit' value='Register'>
	</form>
	<h2>Login</h2>
<?php
	if($this->session->flashdata("login_error"))
	{
		echo $this->session->flashdata("login_error");
	}
?>
	<form action='/main/login' method='post'>
		<label>Email</label>
		<input type='text' name='email'>
		<label>Password</label>
		<input type='text' name='password'>
		<input type='submit' value='Login'>
	</form>
</body>
</html>