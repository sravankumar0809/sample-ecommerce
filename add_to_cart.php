<?php
session_start();
$id = $_GET['id'];
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$_SESSION['cart'][] = $id;
echo "Added";
?>
