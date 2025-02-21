<?php

$username = $_SESSION['username'];

// Fetch and aggregate data from the CheckOut table
$query = "SELECT 
    c.co_id,
    p.product_id,
    p.product_name,
    c.pr_size,
    SUM(c.quantity) AS total_quantity,
    p.price,
    SUM(p.price * c.quantity) AS total_price,
    c.co_status,
    p.image_url
FROM 
    CheckOut c
LEFT JOIN 
    Product p ON c.product_id = p.product_id
WHERE 
    c.username = ?
GROUP BY 
    c.co_id, p.product_id, p.product_name, c.pr_size, p.price, c.co_status, p.image_url"; // Include co_status and image_url in the GROUP BY clause

$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    echo '<table class="table table-bordered table-striped">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Order ID</th>'; // Add Order ID column
    echo '<th>Image</th>'; // Add Image column
    echo '<th>Product ID</th>';
    echo '<th>Product Name</th>';
    echo '<th>Size</th>';
    echo '<th>Total Quantity</th>';
    echo '<th>Price</th>';
    echo '<th>Total Price</th>';
    echo '<th>Status</th>'; // Add Status column
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['co_id'] . '</td>'; // Display Order ID
        echo '<td><img src="' . htmlspecialchars($row['image_url']) . '" alt="Product Image" style="max-width: 50px; max-height: 50px;"></td>'; // Display image with size restrictions
        echo '<td>' . $row['product_id'] . '</td>';
        echo '<td>' . $row['product_name'] . '</td>';
        echo '<td>' . $row['pr_size'] . '</td>';
        echo '<td>' . $row['total_quantity'] . '</td>';
        echo '<td>' . number_format($row['price'], 2) . '</td>';
        echo '<td>' . number_format($row['total_price'], 2) . '</td>';
        echo '<td>' . $row['co_status'] . '</td>'; // Display Status
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo 'No records found in the CheckOut table.';
}

// Close the database connection
$stmt->close();
$mysqli->close();
?>
