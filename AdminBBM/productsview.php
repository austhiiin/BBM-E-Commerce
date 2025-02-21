<?php

// Include config file
require_once "config.php";

// Attempt select query execution
$sql = "SELECT * FROM product";
if($result = $mysqli->query($sql)){
    if($result->num_rows > 0){
        echo '<form method="post" action="">'; // Form start
        echo '<table class="table table-bordered table-striped">';
            echo "<thead>";
                echo "<tr>";
                    echo "<th>Product ID</th>";
                    echo "<th>Product Name</th>";
                    echo "<th>Product Description</th>";
                    echo "<th>Quantity</th>";
                    echo "<th>Price</th>";
                    echo "<th>Image Url</th>";
                    echo "<th>Category</th>";
                    echo "<th>Update Quantity</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while($row = $result->fetch_array()){
                echo "<tr>";
                    echo "<td>" . $row['product_id'] . "</td>";
                    echo "<td>" . $row['product_name'] . "</td>";
                    echo "<td>" . $row['product_description'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td>" . $row['image_url'] . "</td>";
                    echo "<td>" . $row['category'] . "</td>";
                    echo '<td><input type="number" name="quantity[]" value="' . $row['quantity'] . '"></td>';
                echo "</tr>";
            }
            echo "</tbody>";                            
        echo "</table>";
        echo '<button type="submit" name="update_quantity" class="btn btn-success">Update Quantity</button>';
        echo '</form>'; // Form end
        // Free result set
        $result->free();
    } else{
        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
    }
} else{
    echo "Oops! Something went wrong. Please try again later.";
}

// Check if form is submitted for updating quantity
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_quantity'])) {
    $quantities = $_POST['quantity'];
    $i = 1; // Start Eid from 1, assuming it's the primary key
    // Prepare an update statement
    $sql = "UPDATE product SET quantity = ? WHERE product_id = ?";
    if ($stmt = $mysqli->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ii", $quantity, $eid);
        // Loop through quantities array and execute the update statement for each product
        foreach ($quantities as $quantity) {
            $eid = $i; // Set Eid to current product_id
            if ($stmt->execute()) {
                
            } else {

            }
            $i++;
        }
        // Close statement
        $stmt->close();
    }
}


?>
