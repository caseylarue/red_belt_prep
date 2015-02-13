<html>
<head>
	<title>Book Review Page</title>
</head>
<body>
<?php
	require('nav.php');
?>
	<h1><?= $reviews[0]['title'] ?></h1>
	<h1>Author: <?= $reviews[0]['first_name']." ".$reviews[0]['last_name'] ?></h1>
	<div id='reviews'>
		<h2>Reviews</h2>
<?php
		if($reviews[0]['deleted'] == 'Y')
		{
			echo "There are no reviews for this book!";
		}
		else
		{
			foreach($reviews as $review)
			{
	?>
				<div>
					<p>Review by: <a href='#'><?= $review['alias']?></a></p>
					<p>Rating: <?= $review['rating'] ?></p>
					<p><?= $review['review'] ?></p>
					<p>Posted on: <?= $review['created_at'] ?></p>
	<?php
					if($review['reviewer_id'] == ($this->session->userdata('id')))
					{
	?>					
						<form action="/reviews/delete_review/<?= $review['book_id'] ?>" method='post'>
							<input type='hidden' name='review_id' value="<?= $review['review_id'] ?>">
							<button>delete this review</button>
						</form>
	<?php
					}
	?>
				</div>
	<?php
			}
		}
?>
	</div>
</body>
</html>