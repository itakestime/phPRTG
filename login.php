<html>
<head>
<meta charset="UTF-8">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<center>
<br>
<br>
<div style="width:300px" class="panel panel-default">
  <div class="panel-body">
<form action="session.php" method="post">
<div class="form-group">
  <label for="usr">Username:</label>
  <input type="text" class="form-control" id="username" name="username">
</div>
<div class="form-group">
  <label for="pwd">Password:</label>
  <input type="password" class="form-control" id="password" name="password">
</div>
<input style="float:right" type="submit" class="btn btn-primary" value="Login">
</form>
</div>
</div>


<?php 


//Check if username and password were correct
if (!empty($_GET["error"])){

	?>
<div class="alert alert-danger">
	Username or password incorrect.
</div>
<?php }
?>



</center>
</body>



</html>