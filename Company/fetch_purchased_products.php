<?php
include 'dbconnect.php';
session_start();

if (!isset($_SESSION['username'])) {
    echo json_encode([]);
    exit();
}

$username = $_SESSION['username'];

$query = "SELECT co.product_id, p.product_name, co.quantity, co.size, p.price
          FROM CheckOut co
          JOIN Product p ON co.product_id = p.product_id
          WHERE co.username = '$username'";

$result = $mysqli->query($query);
$purchasedProducts = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $purchasedProducts[] = [
            'product_id' => $row['product_id'],
            'product_name' => $row['product_name'],
            'quantity' => $row['quantity'],
            'size' => $row['size'],
            'price' => $row['price']
        ];
    }
    $result->free();
}

echo json_encode($purchasedProducts);
?>
