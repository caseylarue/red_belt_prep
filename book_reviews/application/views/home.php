<html>
<head>
	<title>Books</title>
	<style type="text/css">
		
		#recent_reviews, #list_reviews {
			margin-left: 30px;
			margin-top: 30px;
			padding: 5px;
			border: 1px solid silver;
			width: 300px;
			display: inline-block;
			vertical-align: top;
		}
		#recent_reviews p, #list_reviews p {
			margin-left: 10px;
		}
		.individual_review {
			border: 1px solid silver;
		}

	</style>
</head>
<body>
	<?= require('nav.php') ?>
	<div id='recent_reviews'>
		<h2>Recent Book Reviews</h2>
<?php
		for($i=0; $i<3; $i++)
		{
?>
			<div class='individual_review'>
			<p><?=$reviews[$i]['title']?></p>
			<p><?=$reviews[$i]['author_first_name'].' '.$reviews[$i]['author_last_name']?></p>
			<p>Rating<?=$reviews[$i]['rating']?></p>
			<p><a href='/main/user_page/<?=$reviews[$i]['user_id']?>'><?=$reviews[$i]['alias']?></a></p>
			<p><?=$reviews[$i]['review']?></p>
			</div>
<?php
		}
?>
	</div> <!-- book reviews -->
	<div id='list_reviews'>
		<h2>Listing of Reviews</h2>
<?php
		foreach($books as $book)
		{
?>
			<p><a href='/main/get_reviews/<?= $book['id'] ?>'><?= $book['title'] ?></a></p>
<?php
		}
?>
	</div>
</body>
</html>