<html>
<head>
	<title>Profile</title>
	<style type="text/css">
		textarea {
			height: 100px;
			width: 600px;
		}
		.message {
			border: 1px solid silver;
			width: 600px;
			margin: 10px 0px 0px 10px;
			padding: 5px;
		}
		.add_comment {
			margin-left: 10px; 
		}
		.comment {
			border: 1px solid silver;
			margin: 10px 0px 10px 20px;
			padding: 5px;
			background-color: #FAEBD7;
			width: 600px;
		}
	</style>
</head>
<body>
	<h1>Welcome to the Wall for <?= $user['first_name']?></h1>
	<h3>Registered at: <?= $user['created_at']?></h3>
	<h3>Email: <?= $user['email']?></h3>
	<h3>Description: <?= $user['description']?></h3>
	<h2>Leave a message for <?= $user['first_name']?> </h2>
	<form action='/messages/leave_message/<?= $user['id']?>' method='post'>
		<input type='hidden' name='user_id_message_to' value='<?= $user['id']?>'>
		<input type='hidden' name='user_id_message_from' value='<?= $this->session->userdata('id') ?>'>
		<textarea name='message'></textarea>
		<input type='submit' value='Post a Message!'>
	</form>
<?php
	foreach($messages as $message)
	{
?>
		<div class='message'>
			<p>Message id: <?= $message['id'] ?></p>
			<p><?= $message['message'] ?></p>
			<p>From: <?= $message['message_from_first_name']." ".$message['message_from_last_name'] ?></p>
			<p>Created at: <?= $message['created_at'] ?></p>
		</div>
<?php
		foreach($comments as $comment)
		{
			if($comment['message_id'] == $message['id'])
			{
?>	
				<div class='comment'>
					<p><?=$comment['comment']?></p>
					<p>From: <?=$comment['comment_from_first_name']." ".$comment['comment_from_last_name']?></p>
					<p>Created At: <?=$comment['created_at']?></p>
				</div>
<?php
			}
		}
?>
		<form class='add_comment' action='/messages/leave_comment/<?= $user['id']?>' method='post'>
			<input type='hidden' name='message_id' value='<?= $message['id']?>'>
			<input type='hidden' name='user_id_comment_from' value='<?= $this->session->userdata('id') ?>'>
			<textarea name='comment'></textarea>
			<input type='submit' value='Add Comment'>
		</form>
<?php		
	}
?>
</body>
</html>