<?php
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the product IDs from the request body
    $requestData = json_decode(file_get_contents('php://input'), true);
    $productIds = $requestData['productIds'];

    // Query to check product availability
    $outOfStockProducts = [];
    foreach ($productIds as $productId) {
        $checkoutQuantityQuery = "SELECT SUM(quantity) AS total_quantity FROM CheckOut WHERE product_id = $productId";
        $checkoutResult = mysqli_query($connection, $checkoutQuantityQuery);
        $checkoutQuantity = mysqli_fetch_assoc($checkoutResult)['total_quantity'];

        $checkQuantityQuery = "SELECT quantity FROM Product WHERE product_id = $productId";
        $checkResult = mysqli_query($connection, $checkQuantityQuery);
        $productQuantity = mysqli_fetch_assoc($checkResult)['quantity'];

        if ($checkoutQuantity >= $productQuantity) {
            // Product is out of stock
            $outOfStockProducts[] = $productId;
        }
    }

    // Return the list of out of stock products
    echo json_encode(['outOfStock' => $outOfStockProducts]);
} else {
    // Invalid request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>
