<?php
if (isset($_GET['id'])) {
     $id = $_GET['id'];
     include_once "../config/DBUntil.php";
     $db = new DBUntil();
     $db->delete("user", "id = $id");
     // echo "<script>alert('Xoa thanh cong');</script>";
     header("location: index.php?view=index");
}
?>
