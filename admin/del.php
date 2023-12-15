<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
	<?php

	session_start();
	if ($_SESSION['login'] == false or !(in_array($_SESSION['role'], array('admin')))) {
		header("location: ../index.php?loginError=1");
		exit;
	}

	?>
	<a href="../logout.php">logout</a>
	<a href="index.php">back</a>
	<div class="container">
		<?php

		require_once('../Class.data.php');

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {// same as if ( !empty($_POST)){
			data::delete($_POST['name']);
		}

		$query1 = data::getAll();

		echo "<table class='table table-hover'>";
		echo "<tr><th>name</th><th>email</th><th>password</th><th>role</th><th >profile picture</th><th>actions</th><th>actions</th></tr>";
		while ($row = $query1->fetch()) {
			$query2 = data::getAllFiles($row['name']);// to get the photo of the user

			echo "<tr><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['password']}</td><td>{$row['role']}</td>";
			echo "<td>";
			$row2 = $query2->fetch();
			echo "<a class='btn' href='../files/{$row2['url']}'> {$row2['url']} </a>&nbsp;&nbsp;";
			echo "</td>";
			echo "<td>";
			?>
			<form action="" method="post" onsubmit="return confirm('are you sure to delete')">
				<input type="hidden" id='name' name='name' value="<?php echo $row['name']; ?>" />
				<input type="submit" value="delete" />
			</form>
			<?php
			echo "</td><td>" ?>
			<form action="edit.php" method="post" >
				<input type="hidden" id='name' name='name' value="<?php echo $row['name']; ?>" />
				<input type="submit" value="edit" />
			</form>
			<?php


			echo "</td></tr>";

		}
		echo "</table>"
			?>
	</div>
</body>

</html>