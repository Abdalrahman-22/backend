<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="ff.css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>normal page</title>
</head>

<body>
<?php

	session_start();
	if($_SESSION['login']==false or !(in_array($_SESSION['role'],array('normal'))))//the second condition is like !$_SESSION['role'] == "normal"
	{
		header("location: ../index.php?loginError=1");
		exit;
	}	

?>
<h1>this is normal user page</h1>
<h1> Welcome : <?php echo $_SESSION['userName']?></h1>
<a href="../logout.php">logout</a>
<a href="http://192.168.8.101/room1">room1</a>

</body>
</html>