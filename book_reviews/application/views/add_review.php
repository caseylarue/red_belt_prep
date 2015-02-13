<html>
<head>
	<title>Add a Book Review</title>
	<style type="text/css">
		form label, input, select, textarea {
			display: block;
			margin: 10px;
		}
		#title, #author {
			height: 30px;
		}
		textarea {
			height: 100px;
			width: 400px;
		}
	</style>
</head>
<body>
	<a href="/main/books">Home</a>
	<a href='/main/index'>Log off</a>
	<h1>Add a New Book Title and a Review</h1>
	<form action='/main/add_book' method='post'>
		<label>Book Title</label>
		<input type='hidden' name='user_id' value='<?= $this->session->userdata('id'); ?>'>
		<textarea id='title' name='title' placeholder='book title'></textarea>
		<label>Author</label>
		<select name='author_id'>
			<option value='new'>New Author</option>
<?php
			foreach($authors as $author)
			{
?>
				<option value="<?= $author['id'] ?>"><?= $author['first_name']." ".$author['last_name'] ?></option>
<?php
			}
?>	
<!-- 			<option value='#'>Existing Author</option>
			<option value='#'>Existing Author</option>
			<option value='#'>Existing Author</option> -->
		</select>
		<label>First Name</label>
		<input type='text' name='first_name'>
		<label>Last Name</label>
		<input type='text' name='last_name'>
		<label>Review</label>
		<textarea name='review' placeholder='place review here'></textarea>
		<label>Rating</label>
		<select name='rating'>
			<option value='1'>1</option>
			<option value='2'>2</option>
			<option value='3'>3</option>
			<option value='4'>4</option>
			<option value='5'>5</option>
		</select>
		<input type='submit' value='submit'>
	</form>
</body>
</html>