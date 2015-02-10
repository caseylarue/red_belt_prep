<html>
<head>
	<title>Reviews</title>
	<style type="text/css">
		.reviews {
			border: 1px solid silver;
			width: 400px;
			padding: 5px;
		}
		textarea {
			height: 100px;
			width: 400px;
		}
		.published_reviews, .add_review {
			display: inline-block;
			vertical-align: top;
			margin: 20px;
		}
		.add_review h3, form, input, textarea, label, select{
			display: block;
			margin: 10px;
		}
		.add_review {
			margin-top: 40px;
			margin-left: 200px;
		}
	</style>
</head>
<body>
<?php
	// echo "<pre>";
	// var_dump($reviews);
	// echo "</pre>";
?>
	<h1><?=$reviews[0]['title']?></h1>
	<h2><?=$reviews[0]['author_first_name'].' '.$reviews[0]['author_last_name']?></h2>
	<div class='published_reviews'>
		<h3>Reviews:</h3>
<?php
		foreach($reviews as $review)
		{
?>
		<div class='reviews'>
			<h4>Rating: <?=$review['rating']?></h4>
			<p><a href='#'><?=$review['alias']?></a> says: <?=$review['review']?></p>
			<p>Posted on: <?=$review['created_at']?></p>
		</div>
	</div>
<?php
	}
?>
<!--  WORKING ON THIS FEATURE -->
	<div class='add_review'>
		<h3>Add a Review:</h3>
		<form action='/main/add_book' method='post'>
		<input type='hidden' name='book_id' value="<?= $reviews[0]['book_id']?>">
		<input type='hidden' name='user_id' value="<?= $this->session->userdata['id'] ?>">
		<input type='hidden' name='author_existing' value='new'>
		<textarea name='review' placeholder='type your review here'></textarea>
		<label>Rating</label>
		<select name='rating'>
			<option value='1'>1</option>
			<option value='2'>2</option>
			<option value='3'>3</option>
			<option value='4'>4</option>
			<option value='5'>5</option>
		</select>
		<input type='submit' value='Add your review'>
		</form>
	</div>
</body>
</html>