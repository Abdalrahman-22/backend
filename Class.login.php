<?php
require_once("Class.Tools.php");

class login
{
	static function checkIn($userName, $password)
	{

		$userName = Tools::cleanData($userName);
		$password = (Tools::cleanData($password));


		$pdo = Database::connect();
		$sql = "select * FROM user  WHERE name = ? and password = ? ";
		$q = $pdo->prepare($sql);
		$q->execute(array($userName, $password));
		echo ($q->rowCount());

		if (($q->rowCount()) > 0) {
			$result = $q->fetch(PDO::FETCH_ASSOC);
			session_start();
			$_SESSION['login'] = true;
			$_SESSION['userName'] = $result['name'];
			$_SESSION['role'] = $result['role'];
			Database::disconnect();

			if ($_SESSION['role'] == "normal") {
				header("Location: normal/");
			} else if ($_SESSION['role'] == "admin") {
				header("Location: admin/");

			} else {
				header("location: index.php?loginError=1");
			}


		} else {
			header("location: index.php?loginError=1");
		}
	}
}

?>