<html>
<head>
	<title>Add a Book Review</title>
	<style type="text/css">
		form label, input, select, textarea {
			display: block;
			margin: 10px;
		}
		textarea {
			height: 100px;
			width: 200px;
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
		<input type='text' name='title' placeholder='book title'>
		<label>Author</label>
		<select name='author_existing'>
			<option value='new'>New Author</option>
			<option value='#'>Existing Author</option>
			<option value='#'>Existing Author</option>
			<option value='#'>Existing Author</option>
		</select>
		<input type='text' name='author_new' placeholder='new author'>
		<label>Review</label>
		<textarea name='review'></textarea>
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