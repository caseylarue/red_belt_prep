<html>
<head>
	<title>User Page</title>
	<style type="text/css">
		#container {
			width: 970px;
			height: 1200px;
		}
		#user, #count {
			border: 1px solid silver;
			display: inline-block;
			vertical-align: top;
		}
		.review {
			border: 1px solid silver;
		}
	</style>
</head>
<body>
	<div id='container'>
		<div id='user'>
			<p><?= $info['alias'] ?></p>
			<p><?= $info['first_name']." ".$info['last_name'] ?></p>
			<p><?= $info['email'] ?></p>
		</div>
		<div id='count'>
			<p>Count of reviews: <?= $count['count'] ?></p>
		</div>
		<div id='reviews'>
<?php
			foreach($reviews as $review)
			{
?>				<div class='review'>
					<p><?= $review['title'] ?></p>
					<p><?= $review['first_name']." ".$review['last_name'] ?></p>
					<p><?= $review['rating'] ?></p>
					<p><?= $review['review'] ?></p>
					<p><?= $review['created_at'] ?></p>
				</div>
<?php
			}
?>
		</div>
	</div>

</body>
</html>