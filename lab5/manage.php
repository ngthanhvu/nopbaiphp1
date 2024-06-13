<?php
include_once('DBUntil.php');
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}
$db = new DBUntil();
$user = $db->select("SELECT * FROM user");

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
    <h2>Striped Rows</h2>
    <?php
    if (isset($_SESSION['username'])) {
      echo "<p>Xin chào " . $_SESSION['username'] . "</p>";
    }

    if (isset($_SESSION['success_message'])) {
      echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
      unset($_SESSION['success_message']);
    }

    ?>
    <a href="index.php" class="btn btn-success">Back home</a>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Id</th>
          <th>Username</th>
          <th>Avatar</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Role</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($user as $users) {
          echo "<tr>";
          echo "<td>" . $users['id'] . "</td>";
          echo "<td>" . $users['username'] . "</td>";
          echo "<td><img src='uploads/" . $users['avatar'] . "' width='100px'></td>";
          echo "<td>" . $users['email'] . "</td>";
          echo "<td>" . $users['phone'] . "</td>";
          echo "<td>" . $users['role'] . "</td>";
          echo "<td>
          <a class='btn btn-danger' href=\"delete.php?id={$users['id']}\">Delete</a>
          <a class='btn btn-primary' href=\"edit.php?id={$users['id']}&username={$users['username']}&email={$users['email']}&phone={$users['phone']}\">Edit</a>
          </td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

</body>

</html>