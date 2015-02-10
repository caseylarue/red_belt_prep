<html>
<head>
	<title>Books</title>
	<style type="text/css">
		#heading {
			width: 970px;
			height: 50px;
			background-color: #FAEBD7;
			padding: 20px;
			}
		#heading h2, a {
			display: inline-block;
			vertical-align: top;
		}
		#heading h2 {
			margin-right: 400px;
		}
		#heading a {
			margin: 0px 30px
		}
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

	</style>
</head>
<body>
	<h1>Book Reviews</h1>
	<div id='heading'>
		<h2>Welcome <?= $this->session->userdata('alias') ?>!</h2>
		<a href='/main/add'>Add Book and Review</a>
		<a href='/main/index'>Log off</a>
	</div>
	<div id='recent_reviews'>
		<h2>Recent Book Reviews</h2>
		<div>
			<p>Title</p>
			<p>Rating</p>
			<p>Reviewer: Review______</p>
			<p>Posted On: Date</p>
		</div>
	</div> <!-- book reviews -->
	<div id='list_reviews'>
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