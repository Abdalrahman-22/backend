<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Account</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    body {
      background: linear-gradient(120deg, #2980b9, #8e44ad);
      min-height: 100vh;
      margin: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      color: white;
    }

    #createuser-section {
      max-width: 330px;
      width: 100%;
      margin-top: 50px;
      padding: 20px;
      background: linear-gradient(120deg, #2980b9, #8e44ad);
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
      transition: background 0.3s, box-shadow 0.3s;
    }

    #createuser-section:hover {
      background: linear-gradient(120deg, #3498db, #9b59b6);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
    }

    .create-button {
      background-color: #27ae60;
      border: none;
      transition: background-color 0.3s;
    }

    .create-button:hover {
      background-color: #2ecc71;
    }
    .back-button {
            background-color: #3498db;
            border: none;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #2980b9;
        }
  </style>
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
  <div id="createuser-section" class="mx-auto">
    <h1 class="text-center mb-4">Create Account</h1>
    <form method="POST" action="create_user.php" enctype="multipart/form-data">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="role">Role:</label>
        <select class="form-control" id="role" name="role" required>
          <option value="normal">Normal</option>
          <option value="admin">Admin</option>
        </select>
      </div>
      <button type="submit" class="btn btn-danger btn-block create-button">Create Account</button>
      <input type="hidden" name="source" value="admin">
      <a href="index.php" class="btn btn-light btn-block mt-2 back-button">Back</a>
    </form>
  </div>
</body>

</html>
