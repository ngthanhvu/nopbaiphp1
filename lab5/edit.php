<?php
include_once "DBUntil.php";
$db = new DBUntil();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $id = $_POST['id'];
     $username = $_POST['username'];
     $email = $_POST['email'];
     $phone = $_POST['phone'];
     $role = $_POST['role'];

     $db->update("user", [
          "username" => $username,
          "email" => $email,
          "phone" => $phone,
          "role" => $role
     ], "id = $id");
     header("Location: manage.php");
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
          <h2>Update user</h2>
          <form action="edit.php" method="post">
               <div class="mb-3 mt-3">
                    <label for="email">Id:</label>
                    <input type="text" class="form-control" id="email" name="id" value="<?php echo $_GET['id'] ?>">
               </div>
               <div class="mb-3 mt-3">
                    <label for="email">Username:</label>
                    <input type="text" class="form-control" id="email" name="username" value="<?php echo $_GET['username'] ?>">
               </div>
               <div class="mb-3 mt-3">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $_GET['email'] ?>">
               </div>
               <div class="mb-3 mt-3">
                    <label for="email">Phone:</label>
                    <input type="text" class="form-control" id="email" name="phone" value="<?php echo $_GET['phone'] ?>">
               </div>
               <div class="mb-3 mt-3">
                    <label for="role">Role:</label>
                    <select class="form-select" name="role">
                         <option value="admin">Admin</option>
                         <option value="user">User</option>
                    </select>
               </div>
               <button type="submit" class="btn btn-primary">Submit</button>
          </form>
     </div>

</body>

</html>