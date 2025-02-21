<?php
session_start();

// Function to move data from Transaction table to CheckOut table and update product quantity
function moveTransactionToCheckout($transaction_id, $connection) {
    // Query to select data from Transaction table based on transaction_id
    $selectQuery = "SELECT * FROM Transaction WHERE transaction_id = $transaction_id";
    $result = mysqli_query($connection, $selectQuery);

    if (!$result || mysqli_num_rows($result) == 0) {
        // No rows found or query failed
        echo "Error selecting transaction: " . mysqli_error($connection);
        return false;
    }

    // Fetch the row from the result
    $row = mysqli_fetch_assoc($result);

    // Extract data from the row
    $username = $row['username'];
    $product_id = $row['product_id'];
    $quantity = $row['quantity'];
    $pr_size = $row['pr_size'];
    $co_status = "Pending";

    // Query to check if quantity in Transaction is less than or equal to quantity in Product
    $checkQuantityQuery = "SELECT quantity FROM Product WHERE product_id = $product_id";
    $checkResult = mysqli_query($connection, $checkQuantityQuery);
    $productQuantity = mysqli_fetch_assoc($checkResult)['quantity'];

    if ($productQuantity < $quantity) {
        echo "Error: Insufficient quantity in stock for product with ID $product_id";
        return false;
    }

    // Query to insert data into CheckOut table
    $insertQuery = "INSERT INTO CheckOut (username, product_id, quantity, pr_size, co_status, transaction_date) 
    VALUES ('$username', $product_id, $quantity, '$pr_size', '$co_status', NOW())";

    $insertResult = mysqli_query($connection, $insertQuery);

    if (!$insertResult) {
        // Insertion failed
        echo "Error inserting into CheckOut: " . mysqli_error($connection);
        return false;
    }

    // Update product quantity
    $updateQuery = "UPDATE Product SET quantity = quantity - $quantity WHERE product_id = $product_id";
    $updateResult = mysqli_query($connection, $updateQuery);

    if (!$updateResult) {
        // Update failed
        echo "Error updating product quantity: " . mysqli_error($connection);
        return false;
    }

    // Query to delete data from Transaction table using the provided transaction_id
    $deleteQuery = "DELETE FROM Transaction WHERE transaction_id = $transaction_id";
    $deleteResult = mysqli_query($connection, $deleteQuery);

    if (!$deleteResult) {
        // Deletion failed
        echo "Error deleting from Transaction: " . mysqli_error($connection);
        return false;
    }

    // Successfully moved data from Transaction to CheckOut and updated product quantity
    return true;
}

// Example usage:
$servername = "localhost";
$username = "root";
$password = "";
$database = "bbmdb";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Call the function to move data from Transaction to CheckOut
// Assuming you want to move all transactions for the current user
$transaction_ids = []; // Array to hold transaction_ids

// Query to get all transaction_ids for the current user
$selectAllTransactions = "SELECT transaction_id FROM Transaction WHERE username = '" . $_SESSION['username'] . "'";
$result = mysqli_query($mysqli, $selectAllTransactions);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $transaction_ids[] = $row['transaction_id'];
    }
}

// Move each transaction and delete it
$success = true;
foreach ($transaction_ids as $transaction_id) {
    if (!moveTransactionToCheckout($transaction_id, $mysqli)) {
        $success = false;
        break;
    }
}

if ($success) {
    echo "Data moved successfully!";
    header("Location: cartpage.php");
    exit;
} else {
    echo "Failed to move data.";
    header("Location: cartpage.php");
    exit;
}

// Close connection
mysqli_close($mysqli);
?>
