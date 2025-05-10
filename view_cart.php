<?php
include('db.php');
session_start();

$user_id = 1; // Get user ID from session or authentication

$query = "SELECT c.id, p.name, p.price, c.quantity, p.image 
          FROM cart c
          JOIN products p ON c.product_id = p.id
          WHERE c.user_id = $user_id";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<h2>Your Cart</h2>";
    echo "<table>";
    echo "<tr><th>Product</th><th>Price</th><th>Quantity</th><th>Total</th><th>Action</th></tr>";
    
    $total = 0;
    while ($row = $result->fetch_assoc()) {
        $product_total = $row['price'] * $row['quantity'];
        $total += $product_total;
        
        echo "<tr>";
        echo "<td><img src='images/" . $row['image'] . "' alt='" . $row['name'] . "' width='100'>" . $row['name'] . "</td>";
        echo "<td>$" . $row['price'] . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "<td>$" . number_format($product_total, 2) . "</td>";
        echo "<td><button onclick='removeFromCart(" . $row['id'] . ")'>Remove</button></td>";
        echo "</tr>";
    }
    
    echo "<tr><td colspan='3'><strong>Total:</strong></td><td>$" . number_format($total, 2) . "</td></tr>";
    echo "</table>";
} else {
    echo "<p>Your cart is empty.</p>";
}
?>
<script>
    function removeFromCart(cartId) {
        fetch('remove_from_cart.php?id=' + cartId)
            .then(() => {
                alert('Item removed from cart!');
                location.reload(); // Refresh the page to reflect changes
            });
    }
</script>
