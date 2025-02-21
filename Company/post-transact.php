<?php 
include 'dbconnect.php';

// Start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the product_id, and quantity from the form
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $pr_size = $_POST['pr_size']; // Assuming you are retrieving pr_size from the form

    // Check if username is set in the session
    if(isset($_SESSION['username'])) {
        // Insert the transaction into the Transaction table
        $sql = "INSERT INTO Transaction (username, product_id, quantity, pr_size, transaction_date) VALUES (?, ?, ?, ?, NOW())";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("siii", $_SESSION['username'], $product_id, $quantity, $pr_size);

        if ($stmt->execute()) {
            // Transaction successfully inserted, add product to cart
            $_SESSION['cart'][$product_id] = $quantity;
            echo "Product added to cart successfully.";
            header("Location: cartpage.php");
            exit(); // Terminate script after redirection
        } else {
            // Error inserting transaction
            $errorMessage = "Failed to add product to cart.";
        }
    } else {
        // Username is not set in the session
        $errorMessage = "User is not logged in.";
    }
}

// Display error message if any
if (!empty($errorMessage)) {
    echo $errorMessage;
}
?>
