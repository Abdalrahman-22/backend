<?php 
	require 'Class.login.php';
	
	if ( !empty($_POST)){
	 login::checkIn($_POST['Username'],$_POST['password']);
	} 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="style/ccs.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

<?php
  if (isset($_GET['loginError'])) {//header("location: index.php?loginError=1");
    Tools::printError('خطأ في تسجيل الدخول');
  }

  ?>
  <h1>Login</h1>
  <form method="POST" action="index.php" method="post">
    <label>Username:</label>
    <input type="text" name="Username" required>
    <label>Password:</label>
    <input type="password" name="password" required>
    <input type="submit" value="Login" >
    <a href="create_user.php" class="create-account-link">Create an account</a>

  </form>
</body>

</html>