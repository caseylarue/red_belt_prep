<html>
<head>
	<title>Welcome!</title>
	<style type="text/css">
		#container {
			width: 970px;
		}

		#register, #login {
			margin: 20px;
			margin-left: 100px;
		}
		#register label, input {
			display: block;
			margin: 10px;
		}
		#login label, input {
			display: block;
			margin: 10px;
		}
		#register, #login {
			display: inline-block;
			vertical-align: top;
		}
	</style>
</head>
<body>

	<div id='container'>
		<h1>Welcome!</h1>
<?php
		if($this->session->flashdata("validation_error"))
		{
			echo $this->session->flashdata("validation_error");
		}
?>
		<div id='register'>
			<h2>Register</h2>
			<form action='/reviews/register' method='post'>
				<label>First Name</label>
				<input name='first_name'>
				<label>Last Name</label>
				<input name='last_name'>
				<label>Alias</label>
				<input name='alias'>
				<label>Email</label>
				<input name='email'>
				<label>Password</label>
				<input name='password'>
				<label>Confirm Password</label>
				<input name='password_confirm'>
				<input type='submit' value='register'>
			</form>
		</div>

		<div id='login'>
			<h2>Login</h2>
<?php
		if($this->session->flashdata("login_error"))
		{
			echo $this->session->flashdata("login_error");
		}
?>
			<form action='/reviews/login' method='post'>
				<label>Email</label>
				<input name='email'>
				<label>Password</label>
				<input name='password'>
				<input type='submit' value='login'>
			</form>
		</div>
	</div> <!-- container -->
</body>
</html>