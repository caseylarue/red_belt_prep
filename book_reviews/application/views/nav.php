<html>
<head>
	<title></title>
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
	</style>
</head>
<body>
	<h1>Book Reviews</h1>
	<div id='heading'>
		<h2>Welcome <?= $this->session->userdata('alias') ?>!</h2>
		<a href='/main/add'>Add Book and Review</a>
		<a href='/main/index'>Log off</a>
	</div>
</body>
</html>