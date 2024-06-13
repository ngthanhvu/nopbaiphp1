<?php
include_once('DBUntil.php');
$id = $_GET['id'];
var_dump($id);


$dbHelper = new DBUntil();

$categories = $dbHelper->delete("user", "id = $id");
header("Location: manage.php");
