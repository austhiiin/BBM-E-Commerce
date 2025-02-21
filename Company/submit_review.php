<?php
include 'dbconnect.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: loginpage.php"); // Redirect to login page if not logged in
    exit();
}

$username = $_SESSION['username'];
$feedback = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $product_data = explode('|', filter_input(INPUT_POST, 'product', FILTER_SANITIZE_STRING));
    $rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);
    $review_text = filter_input(INPUT_POST, 'review_text', FILTER_SANITIZE_STRING);

    if ($rating !== false && $review_text && count($product_data) == 2) {
        $co_id = (int)$product_data[0];
        $product_id = (int)$product_data[1];

        // Prepare and execute insert statement
        $query = "INSERT INTO Product_Review (co_id, product_id, username, rating, review_text, review_status) VALUES (?, ?, ?, ?, ?, 'done')";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("iisis", $co_id, $product_id, $username, $rating, $review_text);

        if ($stmt->execute()) {
            $feedback = "Review submitted successfully.";
            header("Location: Reviews.php");
            exit();
        } else {
            $feedback = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $feedback = "Invalid input.";
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Submission</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-info">
            <p><?php echo $feedback; ?></p>
            <a href="Reviews.php" class="btn btn-primary">Back to Reviews</a>
        </div>
    </div>
</body>
</html>
