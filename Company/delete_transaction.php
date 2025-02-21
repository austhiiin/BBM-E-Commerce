<?php
include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id']) && isset($_POST['pr_size'])) {
    $username = $_SESSION['username']; // Assuming you're starting the session in this file as well
    $product_id = $_POST['product_id'];
    $pr_size = $_POST['pr_size'];

    $query = "DELETE FROM transaction WHERE product_id = ? AND username = ? AND pr_size = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("iss", $product_id, $username, $pr_size);

    if ($stmt->execute()) {
        // Deletion successful
        echo "Product deleted successfully.";
    } else {
        // Error in deletion
        echo "Failed to delete product.";
    }
} else {
    // Handle invalid request
    echo "Invalid request.";
}
?>
    