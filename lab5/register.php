<?php
session_start();
include_once 'DBUntil.php';
$errors = [];

function isCheckEmail($email)
{
     
     $db = new DBUntil();
     return $db->select("SELECT * FROM user WHERE email = '$email'");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     if (!isset($_POST['username']) || empty($_POST['username'])) {
          $errors['username'] = "Username is required";
     } else {
          $username = $_POST['username'];
          $_SESSION['username'] = $username;
     }
     if (!isset($_POST['email']) || empty($_POST['email'])) {
          $errors['email'] = "Email is required";
     } else {
          if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
               $errors['email'] = "Invalid email format";
          } else {
               if (isCheckEmail($_POST['email'])) {
                    $errors['email'] = "Email already exists";
               }
               $email = $_POST['email'];
               $_SESSION['email'] = $email;
          }
     }
     if (!isset($_POST['password']) || empty($_POST['password'])) {
          $errors['password'] = "Password is required";
     } else {
          $password = $_POST['password'];
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);
          $_SESSION['password'] = $hashed_password;
     }

     if (!isset($_POST['phone']) || empty($_POST['phone'])) {
          $errors['phone'] = "Phone is required";
     } else {
          if (!preg_match('/^\d{10}$/', $_POST['phone'])) {
               $errors['phone'] = "Invalid phone format";
          }
          $phone = $_POST['phone'];
          $_SESSION['phone'] = $phone;
     }

     if (!isset($_POST['role']) || empty($_POST['role'])) {
          $errors['role'] = "Role is required";
     } else {
          $role = $_POST['role'];
          $_SESSION['role'] = $role;
     }

     if (isset($_FILES['avatar']) && !$_FILES['avatar']['error'] > UPLOAD_ERR_OK) {
          $target_dir = __DIR__ . "/uploads/";
          $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
          $IMAGE_TYPES = array('jpg', 'jpeg', 'png');

          if (file_exists($target_file)) {
               echo "Sorry, file already exists.";
               $errors['avatar'] = "folder upload not found";
          }

          if (!in_array($imageFileType, $IMAGE_TYPES)) {
               $errors['avatar'] = "avatar type must is image format";
          }

          if (
               $_FILES['avatar']["size"] > 1000000
          ) {
               $errors['avatar'] = "avatar too large";
          }
          // check type

          // var_dump($imageFileType);
          /**
           *  type file allow image [jpeg, png, jpg]
           *  type size: 5M
           */
     } else {
          $avatar = null;
     }

     if (count($errors) == 0) {
          $avatar = null;
          if (isset($_FILES['avatar']) && !$_FILES['avatar']['error'] > UPLOAD_ERR_OK) {
               if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                    $avatar = htmlspecialchars(basename($_FILES["avatar"]["name"]));
                    // echo "The file " . htmlspecialchars(basename($_FILES["avatar"]["name"])) . " has been uploaded.";
               } else {
                    echo "Sorry, there was an error uploading your file.";
               }
          }
          var_dump($avatar);
          $db = new DBUntil();
          $db->insert("user", [
               "username" => $username,
               "email" => $email,
               "phone" => $phone,
               "password" => $hashed_password,
               "avatar" => $avatar,
               "role" => $role
          ]);
          // $_SESSION['success_message'] = "Đăng ký thành công";
          header("Location: login.php");
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
          <h2>Register form</h2>
          <form action="register.php" method="post" enctype="multipart/form-data">
               <div class="mb-3 mt-3">
                    <label for="email">Username:</label>
                    <input type="text" class="form-control" id="email" placeholder="Enter username" name="username">
                    <?php
                    if (isset($errors['username'])) {
                         echo "<span class='text-danger' style='font-size: 15px;'>$errors[username]</span>";
                    }
                    ?>
               </div>
               <div class="mb-3 mt-3">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                    <?php
                    if (isset($errors['email'])) {
                         echo "<span class='text-danger' style='font-size: 15px;'>$errors[email]</span>";
                    }
                    ?>
               </div>
               <div class="mb-3 mt-3">
                    <label for="email">Phone:</label>
                    <input type="text" class="form-control" id="email" placeholder="Enter phone" name="phone">
                    <?php
                    if (isset($errors['phone'])) {
                         echo "<span class='text-danger' style='font-size: 15px;'>$errors[phone]</span>";
                    }
                    ?>
               </div>
               <div class="mb-3">
                    <label for="email">Avatar:</label>
                    <input type="file" class="form-control" placeholder="Enter avatar" name="avatar">
                    <?php
                    if(isset($errors['avatar'])) {
                         echo "<span class='text-danger' style='font-size: 15px;'>$errors[avatar]</span>";
                    }
                    ?>
               </div>
               <div class="mb-3">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
                    <?php
                    if (isset($errors['password'])) {
                         echo "<span class='text-danger' style='font-size: 15px;'>$errors[password]</span>";
                    }
                    ?>
               </div>
               <div class="mb-3">
                    <label for="role">Role:</label>
                    <select class="form-select" name="role">
                         <option value="">Chọn role</option>
                         <option value="admin">Admin</option>
                         <option value="user">User</option>
                    </select>
                    <?php
                    if (isset($errors['role'])) {
                         echo "<span class='text-danger' style='font-size: 15px;'>$errors[role]</span>";
                    }
                    ?>
               </div>
               <a href="login.php">Login here!</a><br><br>
               <button type="submit" class="btn btn-primary">Submit</button>
          </form>
     </div>

</body>

</html>