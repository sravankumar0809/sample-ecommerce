<?php
include('db.php');
session_start();

$user_id = 1; // Get user ID from session or authentication
$cart_id = $_GET['id'];

$query = "DELETE FROM cart WHERE id = $cart_id AND user_id = $user_id";
$conn->query($query);

echo "Item removed from cart!";
?>
