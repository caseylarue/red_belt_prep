<html>
<head>
	<title>Add Review</title>
	<style type="text/css">
	label, textarea, select, button {
		display: block;
		margin: 10px;
	}
	.review {
		height: 100px;
		width: 400px;
	}
	</style>
</head>
<body>
	<h1>Add a New Book Title and Review:</h1>
	<form action='/reviews/add_review' method='post'>
		<input type='hidden' name='user_id' value="<?= $this->session->userdata('id')?>">
		<label>Book Title</label>
		<select name='title_old'>
<?php
		foreach($books as $book)
		{
?>
		<option value="?= $book['id'] ?>"><?= $book['title'] ?></option>
<?php
		}
?>
		</select>
		<textarea class='title' name='title'></textarea>
		<label>Author</label>
		<select name='author'>
<?php
		foreach($authors as $author)
		{
?>
		<option value="?= $author['id'] ?>"><?= $author['first_name']." ".$author['last_name'] ?></option>
<?php
		}
?>
		<textarea class='author' name='author_first_name' placeholder='first name'></textarea>
		<textarea class='author' name='author_last_name' placeholder='last name'></textarea>
		<label>Review</label>
		<textarea class='review' name='review'></textarea>
		<label>Rating</label>
		<select name='rating'>
			<option value='1'>1</option>
			<option value='2'>2</option>
			<option value='3'>3</option>
			<option value='4'>4</option>
			<option value='5'>5</option>
		</select>
		<button type='submit'>Submit!</button>
	</form>
</body>
</html>