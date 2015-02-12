<html>
<head>
	<title></title>
	<style type="text/css">
		.header {
			background-color: #00FFFF;
			width: 970px;
			height: 60px;
			padding: 5px;
		}
		a:link, a:visited, a:hover, a:active {
			text-decoration: none;
		}
	
		#title {
			font-weight: bold;
			font-size: 20px;
		}

		.header p {
			display: inline-block;
			vertical-align: top;
		}

		#dashboard {
			margin-left: 400px;
			font-size: 20px;
		}

		#profile {
			margin-left: 50px;
			font-size: 20px;
		}
		#logoff {
			font-size: 20px;
			margin-left: 50px;
		}

	</style>
</head>
<body>
	<div class='header'>
		<p id='title'>Friends Messager</p>
<?php
		if($this->session->userdata('user_type') == 'admin')
		{
?>
			<p id='dashboard'><a href='/messages/admin_dashboard'>Dashboard</a></p>
<?php
		}
		else
		{
?>
			<p id='dashboard'><a href='/messages/user_dashboard'>Dashboard</a></p>
<?php
		}
?>
		<p id='profile'><a href="/messages/profile/<?= $this->session->userdata('id') ?>">Profile</a></p>
		<p id='logoff'><a href="/messages/index">Logoff</a></p>
	</div>
</body>
</html>