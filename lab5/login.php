<?php
include_once "DBUntil.php";
session_start();
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     if (!isset($_POST['username']) || empty($_POST['username'])) {
          $errors['username'] = "Please enter username";
     } else {
          $username = $_POST['username'];
     }
     if (!isset($_POST['password']) || empty($_POST['password'])) {
          $errors['password'] = "Please enter password";
     } else {
          $password = $_POST['password'];
     }

     if (count($errors) == 0) {
          $db = new DBUntil();
          $user = $db->select("SELECT * FROM user WHERE username = :username", array('username' => $username));
          $user = $user[0];
          if ($user && isset($user['password'])) {
               if (password_verify($password,$user["password"])) {
                    $_SESSION['username'] = $username;
                    $_SESSION['success_message'] = "Login successful";
                    header("Location: index.php");
                    exit();
               } else {
                    $errors['login'] = "Invalid username or password";
               }
          } else {
               $errors['login'] = "Invalid username or password";
          }
     }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
     <title>Bootstrap Example</title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

     <div class="container mt-3">
          <h2>Login form</h2>
          <form action="login.php" method="post">
               <div class="mb-3 mt-3">
                    <label for="email">Username:</label>
                    <input type="text" class="form-control" id="email" placeholder="Enter username" name="username">
                    <?php
                    if (isset($errors['username'])) {
                         echo "<p class='text-danger'>" . $errors['username'] . "</p>";
                    }
                    ?>
               </div>
               <div class="mb-3">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
                    <?php
                    if (isset($errors['password'])) {
                         echo "<p class='text-danger'>" . $errors['password'] . "</p>";
                    }
                    ?>
               </div>
               <a href="forgot-password.php">Forgot password</a>
               <a href="register.php" style="padding-left: 100px;">Register here</a><br><br>
               <button type="submit" class="btn btn-primary">Submit</button>
               <?php
               if (isset($errors['login'])) {
                    echo "<p class='text-danger'>" . $errors['login'] . "</p>";
               }
               ?>
          </form>
     </div>

</body>

</html>