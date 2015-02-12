<html>
<head>
	<title>Edit Profile</title>
	<style type="text/css">
		.to_dashboard {
			background-color: blue;
			font-weight: bold;
			color: white;
			font-size: 24px;
			margin-top: 30px;
			margin-left: 500px;
			padding: 10px;
		}
		.info {
			border: 1px solid silver;
			padding: 10px;
			display: inline-block;
			vertical-align: top;
			margin: 20px;
		}
		.info  input, textarea {
			display: block;
			margin: 15px;
		}

		.info textarea {
			height: 100px;
			width: 400px;
		}
	</style>
</head>
<body>
	<form action='/messages/user_dashboard' method='post'>
		<button class='to_dashboard'>Return to Dashboard</button>
	</form>
	<h2>Edit Information</h2>
	<form class='info' action="/messages/user_edit_info/<?= $id ?>" method='post'>
		<input type='hidden' name='id' value="<?= $user['id'] ?>">
		<label>Email</label>
		<input type='text' name='email' value="<?= $user['email'] ?>">
		<label>First Name</label>
		<input type='text' name='first_name' value="<?= $user['first_name'] ?>">
		<label>Last Name</label>
		<input type='text' name='last_name' value="<?= $user['last_name'] ?>">
		<label>Description</label>
		<textarea type='text' name='description' value="<?= $user['description'] ?>"></textarea>
		<button type='submit'>Save</button>
	</form>
<?php
	if($this->session->flashdata("validation_error"))
	{
		echo $this->session->flashdata("validation_error");
	}
?>
	<form class='info' action="/messages/edit_user_password/<?= $id ?>" method='post'>
		<input type='hidden' name='id' value="<?= $user['id'] ?>">
		<label> Password</label>
		<input name='password'>
		<label> Password Confirm</label>
		<input name='password_confirm'>
		<input type='submit' value='Save'>
	</form>
<?php
	if($this->session->flashdata("success"))
	{
		echo $this->session->flashdata("success");
	}
?>
</body>
</html>