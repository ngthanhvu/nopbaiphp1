<?php
include_once('DBUntil.php');
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sample Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #333;
            overflow: hidden;
        }
        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="#home">Home</a>
        <?php
        $db = new DBUntil();
        $user = $db->select("SELECT * FROM user WHERE username = :username", array('username' => $_SESSION['username']));
        if ($user[0]['role'] == 'admin') {
            echo '<a href="manage.php">Manage</a>';
        }
        ?>
        <a href="logout.php">Logout</a>
    </div>
    <div class="content">
        <h1>Welcome to My Website</h1>
        <p>This is a sample page with a simple navbar. You can navigate using the links above.</p>
    </div>
</body>
</html>
