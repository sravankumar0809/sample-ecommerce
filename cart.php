<?php
session_start();
include 'db.php';

$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    echo "<h2>Your cart is empty</h2>";
    exit;
}

$ids = implode(",", array_map('intval', $cart));
$result = $conn->query("SELECT * FROM products WHERE id IN ($ids)");

while ($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "<h3>{$row['name']}</h3>";
    echo "<p>Price: \${$row['price']}</p>";
    echo "</div><hr>";
}
?>
