<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style/ff.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<title>normal page</title>
</head>

<body>
<?php

	session_start();
	if($_SESSION['login']==false or !(in_array($_SESSION['role'],array('admin'))))// the second condition is !$_SESSION['role']=="admin"
	{
		header("location: ../index.php?loginError=1");
		exit;
	}	

?>
	<h1>this is Admin page</h1>
	<h1> Welcome : <?php echo $_SESSION['userName']?></h1>
	<a href="del.php" >Edit users</a>
	<br>
	<a href="create_user.php" >add user</a>
	<br>
	<a href="../logout.php">logout</a>
	<br>
	<a href="http://192.168.8.101/room1">room1</a>
	<a href="http://192.168.8.101/room2">room2</a>

</body>
</html>
