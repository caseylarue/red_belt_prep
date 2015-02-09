<html>
<head>
	<title>Books</title>
</head>
<body>
	<h1>Books</h1>
	<h2>Welcome <?= $this->session->userdata('alias') ?>!</h2>
	<a href='/main/add'>Add Book and Review</a>
	<a href='/main/index'>Log off</a>
	<div>
		<h2>Recent Book Reviews</h2>
		<div>
			<p>Title</p>
			<p>Rating</p>
			<p>Reviewer: Review______</p>
			<p>Posted On: Date</p>
		</div>
	</div> <!-- book reviews -->
	<div>
		<h2>Listing of Reviews</h2>
		<p>Title</p>
		<p>Title</p>
		<p>Title</p>
		<p>Title</p>
		<p>Title</p>
		<p>Title</p>
	</div>
</body>
</html>