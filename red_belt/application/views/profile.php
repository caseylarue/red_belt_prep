<html>
<head>
	<title>Profile</title>
</head>
<body>
	<a href="/main/home/<?= $this->session->userdata(
	'id') ?>">Home</a>
	<a href="/main/index">Logoff</a>
	<h1><?= $profile['alias']; ?>'s Profile</h1>
	<h3>Name: <?= $profile['name']; ?></h3>
	<h3>Email: <?= $profile['email']; ?></h3>
</body>
</html>