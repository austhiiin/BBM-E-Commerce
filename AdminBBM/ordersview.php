<?php
// Include config file
require_once "config.php";

// Check if form is submitted and $_POST variables are set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['co_status']) && isset($_POST['co_id'])) {
    // Validate status and co_id
    $co_status = $_POST['co_status'];
    $co_id = $_POST['co_id'];

    // Prepare an update statement
    $sql = "UPDATE CheckOut SET co_status=? WHERE co_id=?";

    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("si", $co_status, $co_id);
$stmt->execute();
    }

    // Close statement
    $stmt->close();
}

// Attempt select query execution
$sql = "SELECT * FROM CheckOut";
if ($result = $mysqli->query($sql)) {
    if ($result->num_rows > 0) {
        echo '<table class="table table-bordered table-striped">';
        echo "<thead>";
        echo "<tr>";
        echo "<th>Checkout ID</th>";
        echo "<th>Username</th>";
        echo "<th>Product ID</th>";
        echo "<th>Quantity</th>";
        echo "<th>Transaction Date</th>";
        echo "<th>Product Size</th>";
        echo "<th>Status</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_array()) {
            echo "<tr>";
            echo "<td>" . $row['co_id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['product_id'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td>" . $row['transaction_date'] . "</td>";
            echo "<td>" . $row['pr_size'] . "</td>";
            echo "<td>";
            // Radio button group for selecting status
            echo "<form action='" . $_SERVER['PHP_SELF'] . "' method='post'>";
            echo "<select name='co_status'>";
            echo "<option value='Pending' " . ($row['co_status'] == 'Pending' ? 'selected' : '') . ">Pending</option>";
            echo "<option value='Cancelled' " . ($row['co_status'] == 'Cancelled' ? 'selected' : '') . ">Cancelled</option>";
            echo "<option value='Delivered' " . ($row['co_status'] == 'Delivered' ? 'selected' : '') . ">Delivered</option>";
            echo "</select>";
            echo "</td>";
            echo "<td>";
            // Hidden input field to pass checkout ID
            echo "<input type='hidden' name='co_id' value='" . $row['co_id'] . "'>";
            // Submit button to update status
            echo "<input type='submit' class='btn btn-primary' value='Update'>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        // Free result set
        $result->free();
    } else {
        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
    }
} else {
    echo "Oops! Something went wrong. Please try again later.";
}

// Close connection
$mysqli->close();
?>
