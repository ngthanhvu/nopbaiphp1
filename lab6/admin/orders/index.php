<?php

if (isset($_GET['view'])) {
     $view = $_GET['view'];
} else {
     $view = 'order';
}
switch ($view) {
     case 'order':
          include_once "./include/header.php";
          include_once "./include/slidebar.php";
          include_once "list.php";
          include_once "./include/footer.php";

          break;
     case 'delete-order':
          include_once "delete-product.php";
          include_once "./config/DBUntil.php";
          break;
}
