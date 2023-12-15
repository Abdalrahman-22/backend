<?php

require_once("Class.Tools.php");

class data
{
	static function addNew($name, $email, $password, $role, $ph)
	{
		$name = Tools::cleanData($name);
		$email = Tools::cleanData($email);
		$password = Tools::cleanData($password);
		$role = Tools::cleanData($role);

		$pdo = Database::connect();
		$query = $pdo->prepare("insert into user (name,email,password,role) values(?,?,?,?)");
		$test = $query->execute(array($name, $email, $password, $role));
		// $lastID=$pdo->lastInsertId();

		if ($test) {// if the query worked succesfully

			if (isset($ph['name']) && $ph['name'] != '')
				self::addphoto($name, $ph);

		}

		return $test;

	}

	static function addphoto($name, $file)
	{
		$temp = explode(".", $file['name']);
		$temp = end($temp);
		$fileExtention = strtolower($temp);
		$fileName = $name . "." . $fileExtention;

		$pdo = Database::connect();
		$query = $pdo->prepare("insert into files values (?,?)");
		if ($query->execute(array($name, $fileName)))

			if ($_POST['source'] == "admin") {// to check i add user from main page or from admin page
				move_uploaded_file($file['tmp_name'], "../files/" . $fileName);
			} else if ($_POST['source'] == "main") {
				move_uploaded_file($file['tmp_name'], "files/" . $fileName);
			}

	}


	static function delete($name)
	{
		$name = Tools::cleanData($name);
		$name = $_POST['name'];

		$pdo = Database::connect();
		$sql = "delete from user where name=?";
		$Dquery = $pdo->prepare($sql);
		$Dquery->execute(array($name));

		$sql = "select url from files where name=?";
		$Dquery = $pdo->prepare($sql);
		$Dquery->execute(array($name));
		while ($row = $Dquery->fetch()) // although its just one row
			unlink('../files/' . $row['url']);

		$sql = "delete from files where name=?";
		$Dquery = $pdo->prepare($sql);
		$Dquery->execute(array($name));
	}

	static function deletephoto($name)
	{
		$name = Tools::cleanData($name);
		$name = $_POST['name'];
		$pdo = Database::connect();
	

		$sql = "select url from files where name=?";
		$Dquery = $pdo->prepare($sql);
		$Dquery->execute(array($name));
		while ($row = $Dquery->fetch()) // although its just one row
			unlink('../files/' . $row['url']);

		$sql = "delete from files where name=?";
		$Dquery = $pdo->prepare($sql);
		$Dquery->execute(array($name));
	}

	static function getAll()
	{
		$pdo = Database::connect();
		$query = $pdo->prepare("select * from user");
		$query->execute();
		return $query;
	}

	static function getAllFiles($name) // get the photo of the user
	{
		$pdo = Database::connect();
		$query = $pdo->prepare("select * from files where name=?");
		$query->execute(array($name));
		return $query;
	}

	static function getallinfo($name)
	{
		$pdo = Database::connect();
		$query = $pdo->prepare("select * from user where name=?");
		$query->execute(array($name));
		return $query;
	}
	static function updateuser($name,$email,$password,$role,$photo)
	{
	   $email=Tools::cleanData($email);
	   $name=Tools::cleanData($name);
	   $password=Tools::cleanData($password);
	   $role=Tools::cleanData($role);
	   	
       $pdo=Database::connect();
	   $query=$pdo->prepare("update user set  email=?, password=?, role=? where name=?");

	   if (isset($photo['name']) && $photo['name'] != '')
	   {
	
		self::deletephoto($name);

		self::addphoto($name, $photo);
		}

	   return $query->execute(array($email,$password,$role,$name));
	}	

}

?>