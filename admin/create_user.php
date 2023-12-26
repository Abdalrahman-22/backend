<!DOCTYPE html>
<html>

<head>
  <title>Create Account</title>
  <link href="style/ccs.css" rel="stylesheet" type="text/css">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<?php

if (!empty($_POST)) {
  require_once("../Class.data.php");
  require_once("../Class.Tools.php");
  $result = data::addNew($_POST['username'], $_POST['email'], $_POST['password'], $_POST['role']);
  if ($result === true) {
    Tools::printSuccess("One record has been inserted successfully.");
  } else {
    Tools::printError("Unexpected result: " . var_export($result, true));
  }

}
?>

<body>
  <?php

  session_start();
  if ($_SESSION['login'] == false or !(in_array($_SESSION['role'], array('admin')))) {
    header("location: ../index.php?loginError=1");
    exit;
  }

  ?>
  <h1>Create Account</h1>
  <form method="POST" action="create_user.php" enctype="multipart/form-data">
    <label>Username:</label>
    <input type="text" name="username" required>
    <label>Password:</label>
    <input type="password" name="password" required>
    <label>Email:</label>
    <input type="email" name="email" required>
    <label>Role:</label>
    <select name="role" required>
      <option value="normal">normal</option>
      <option value="admin">Admin</option>
    </select>
    <input type="submit" value="Create Account">
    <input type="hidden" name="source" value="admin">
    <a href="index.php" class="have-account-link">back</a>

  </form>

</body>

</html>