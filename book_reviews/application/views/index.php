<html>
<head>
	<title>Book Reviews | Login </title>
	<style type="text/css">
		#container {
			margin-top: 40px;
			margin-left: 25px;
		/*	width: 970px;
			height: 100px;*/
		}
		#registration, #login {
			display: inline-block;
			vertical-align: top;
			width: 300px;
			margin: 0px 40px;
		}
		form label, input {
			display: block;
			margin: 10px;
		}
		input {
			margin-left: 25px;
		}

	</style>
</head>
<body>
	<div id='container'>
		<h1>Welcome to our awesome book reviews website!</h1>
<?php
		if($this->session->flashdata("validation_error"))
		{
			echo $this->session->flashdata("validation_error");
		}
?>
		<div id='registration'>
			<h2>Registration</h2>
			<form action='/main/register' method='post'>
				<label>First Name:</label>
				<input type='text' name='first_name'>
				<label>Last Name:</label>
				<input type='text' name='name_name'>
				<label>Alias:</label>
				<input type='text' name='alias'>
				<label>Email:</label>
				<input type='email' name='email'>
				<label>Password:</label>
				<input type='text' name='password'>
				<label>Password Confirm:</label>
				<input type='text' name='password_confirm'>
				<input type='submit' value='Register'>
			</form>
		</div> <!-- login -->
		<div id='login'>
			<h2>Login</h2>
			<form action='/main/login' method='post'>
				<label>Email:</label>
				<input type='email' name='email'>
				<label>Password:</label>
				<input type='text' name='password'>
				<input type='submit' value='Login'>
			</form>
		</div> <!-- registration -->
	</div> <!-- container -->
</body>
</html>