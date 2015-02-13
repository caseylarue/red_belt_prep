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
		#recent_reviews {
			display: inline-block;
			vertical-align: top;
		}
	</style>
</head>
<body>
	<div id='nav'>
		<h1>Welcome <?= $this->session->userdata('alias') ?>!</h1>
		<a href="/reviews/add">Add a Book Review!</a>
		<a href="/reviews/index">Logout</a>
	</div>
	<h2>Recent Reviews</h2>
	<div id='recent_reviews'>
<?php
	foreach($reviews as $review)
		{
?>
		<div>
			<p><a href="/reviews/book_review_page/<?= $review['book_id'] ?>"><?= $review['title']?></a></p>
			<p>Review by: <a href='#'><?= $review['alias']?></a></p>
			<p>Rating: <?= $review['rating'] ?></p>
			<p><?= $review['review'] ?></p>
			<p>Posted on: <?= $review['created_at'] ?></p>
		</div>
<?php
		}	
?>
	</div>
	<h2>Books Reviewed</h2>
	<div id='books_reviewed'>
<?php
	foreach($books as $book)
		{
?>	
			<p><a href="/reviews/book_review_page/<?= $book['id'] ?>"><?= $book['title']?></a></p>
<?php
		}	
?>
	</div>

</body>
</html>