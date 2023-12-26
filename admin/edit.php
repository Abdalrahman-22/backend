<!DOCTYPE html>
<html>

<head>
    <title>edit user</title>
    <link href="style/ccs.css" rel="stylesheet" type="text/css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<?php
require_once("../Class.data.php");

if (!empty($_POST['submit']) && $_POST['submit'] == 'Save') {
    $test = data::updateuser($_POST['name'], $_POST['email'], $_POST['password'], $_POST['role']);

    if ($test) {
        Tools::printSuccess("Updated Successfully <a href ='index.php'>Go back</a>");
    } else {
        Tools::printError("Updated Failed <a href ='index.php'>Go back</a>");
    }

}


$usrinfo = data::getallinfo($_POST['name']); // get user info
$row = $usrinfo->fetch();

?>

<body>
    <?php

    session_start();
    if ($_SESSION['login'] == false or !(in_array($_SESSION['role'], array('admin')))) {
        header("location: ../index.php?loginError=1");
        exit;
    }

    ?>
    <h1>edit Account</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <label>Username:</label>
        <input type="text" name="name" required value="<?php echo $row['name']; ?>" readonly="readonly">
        <label>Password:</label>
        <input type="password" name="password">
        <label>Email:</label>
        <input type="email" name="email" required value="<?php echo $row['email']; ?>">
        <label>Role:</label>
        <select name="role" required>
            <option value="normal" <?php if ($row['role'] == "normal")
                echo "selected"; ?>>normal</option>
            <option value="admin" <?php if ($row['role'] == "admin")
                echo "selected"; ?>>Admin</option>
        </select>
      
        <input type="submit" name="submit" value="Save">
        <input type="hidden" name="source" value="admin">
        <a href="del.php" class="have-account-link">back</a>

    </form>

</body>

</html>