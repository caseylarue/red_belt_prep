<html>
<head>
	<title>Home</title>
	<style type="text/css">
		#nav {
			border-color: #00FFFF;
			font-size: 20px;
		}
		#nav h1, a {
			display: inline-block;
			vertical-align: top;
			margin-top: 10px;
		}
		#nav h1 {
			margin-left: 500px;
		}
		#nav a {
			margin-left: 20px;
		}
	</style>
</head>
<body>
	<div id='nav'>
		<h1>Welcome <?= $this->session->userdata('alias') ?>!</h1>
		<a href="/reviews/add">Add a Book Review!</a>
		<a href="/reviews/index">Logout</a>
	</div>
</body>
</html>