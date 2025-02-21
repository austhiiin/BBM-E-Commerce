<?php
session_start();
include 'dbconnect.php';

if (!isset($_SESSION['username'])) {
    header("Location: loginpage.php"); // Redirect to login page if not logged in
    exit();
  }
  
  $username = $_SESSION['username'];
// Function to delete a transaction from the Transaction table
function deleteTransaction($transaction_id, $connection) {
    // Split the transaction_id to get product_id and pr_size
    list($product_id, $pr_size) = explode('_', $transaction_id);
    
    // Query to delete data from Transaction table using the provided product_id and pr_size
    $deleteQuery = "DELETE FROM Transaction WHERE product_id = $product_id AND pr_size = '$pr_size'";
    $deleteResult = mysqli_query($connection, $deleteQuery);

    if (!$deleteResult) {
        // Deletion failed
        echo "Error deleting from Transaction: " . mysqli_error($connection);
        return false;
    }

    // Successfully deleted the transaction
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

if (isset($_POST['checkout']) && isset($_POST['selected_transactions'])) {
    $transaction_ids = $_POST['selected_transactions'];

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
}
if (isset($_POST['delete_transaction'])) {
    $delete_transaction_id = $_POST['delete_transaction'];
    
    // Call function to delete transaction
    if (deleteTransaction($delete_transaction_id, $mysqli)) {
        // Redirect to cart page after successful deletion
        header("Location: cartpage.php");
        exit;
    } else {
        echo "Failed to delete transaction.";
    }
}
// Function to move data from Transaction table to CheckOut table and update product quantity
function moveTransactionToCheckout($transaction_id, $connection) {
    // Split the transaction_id to get product_id and pr_size
    list($product_id, $pr_size) = explode('_', $transaction_id);
    
    // Query to select data from Transaction table based on product_id and pr_size
    $selectQuery = "SELECT * FROM Transaction WHERE product_id = $product_id AND pr_size = '$pr_size'";
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
    $quantity = $row['quantity'];
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

    // Query to delete data from Transaction table using the provided product_id and pr_size
    $deleteQuery = "DELETE FROM Transaction WHERE product_id = $product_id AND pr_size = '$pr_size'";
    $deleteResult = mysqli_query($connection, $deleteQuery);

    if (!$deleteResult) {
        // Deletion failed
        echo "Error deleting from Transaction: " . mysqli_error($connection);
        return false;
    }

    // Successfully moved data from Transaction to CheckOut and updated product quantity
    return true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBM | Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Teko:wght@300..700&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" href="stckimg/BBMbig.png" type="image/x-icon">
</head>
<body>
    <?php if (!empty($errorMessage)): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>
    <nav class="navbar navbar-expand-lg color-cb">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="stckimg/BBMbig.png" alt="Logo" width="30" height="30" class="d-inline-block align-text-top rounded-circle">
                <span class="text-white teko-reg">BIG BARGAIN MART</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="Category.php">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="FAQ.php">FAQs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="Reviews.php">Reviews</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="logout.php" class="btn btn-danger me-4"> Log out <?php echo htmlspecialchars($_SESSION["username"]) ?>!</a>
                    <a href="cartpage.php"><img src="stckimg/white-cart.png" alt="cartlogo" width="30" height="30" ></a>
                </div>
            </div>
        </div>
    </nav>
    <hr>
    <main class="container">
        <h3 class="h3">My Shopping Cart</h3>

        <?php
        $username = $_SESSION['username'];

        $sql = "SELECT transaction.product_id, product.product_name, SUM(transaction.quantity) AS quantity, transaction.pr_size, product.price, product.price * SUM(transaction.quantity) AS TotalPrice, product.image_url
                FROM transaction 
                LEFT JOIN product ON transaction.product_id = product.product_id
                LEFT JOIN users ON transaction.username = users.username 
                WHERE transaction.username = ?
                GROUP BY transaction.product_id, transaction.pr_size, product.product_name, product.price, product.image_url";

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            echo '<form method="post" action="">'; // Form for delete action
            echo '<table class="table table-bordered table-striped">';
            echo "<thead>";
            echo "<tr>";
            echo "<th>Select</th>"; // Added Select column
            echo "<th>Product ID</th>";
            echo "<th>Image</th>"; // Added Image column
            echo "<th>Product Name</th>";
            echo "<th>Quantity</th>";
            echo "<th>Size</th>";
            echo "<th>Price</th>";
            echo "<th>Total Price</th>";
            echo "<th>Delete</th>"; // Added Delete column
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            $overallTotal = 0;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo '<td><input type="checkbox" name="selected_transactions[]" value="' . $row['product_id'] . '_' . $row['pr_size'] . '" class="transaction-checkbox"></td>'; // Checkbox
                echo "<td>" . $row['product_id'] . "</td>";
                echo '<td><img src="' . htmlspecialchars($row['image_url']) . '" alt="Product Image" style="max-width: 50px; max-height: 50px;"></td>'; // Image column
                echo "<td>" . $row['product_name'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>" . (isset($row['pr_size']) ? $row['pr_size'] : 'N/A') . "</td>";
                echo "<td>" . number_format($row['price'], 2) . "</td>";
                echo "<td>" . number_format($row['TotalPrice'], 2) . "</td>";
                echo '<td><button type="submit" name="delete_transaction" class="btn btn-danger btn-sm" value="' . $row['product_id'] . '_' . $row['pr_size'] . '">Delete</button></td>'; // Delete button
                echo "</tr>";
                $overallTotal += $row['TotalPrice'];
            }
            echo "</tbody>";
            echo "</table>";
            echo '<p class="text-end"><b>Overall Total: $' . number_format($overallTotal, 2) . "</b></p>";
            echo '<button type="submit" name="checkout" class="btn btn-success" id="checkout-btn" disabled>Checkout</button>'; // Checkout button
            echo '</form>'; // Close form for delete action
        
            // Free result set
            $result->free();
        } else {
            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
        }
        $stmt->close();
        
        ?>

    </main>
    <footer class="text-center align-bottom">
        <p><a href="#" data-bs-toggle="modal" data-bs-target="#viewPurchasedProductModal" style="color:#6c63ff;">View Purchased Product</a></p>
    </footer>
    <div class="modal fade" id="viewPurchasedProductModal" tabindex="-1" aria-labelledby="viewPurchasedProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewPurchasedProductModalLabel">Purchased Products</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php include 'showcheckout.php'; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.querySelector('[data-bs-target="#viewPurchasedProductModal"]').addEventListener('click', function() {
        fetchPurchasedProducts();
    });

    function fetchPurchasedProducts() {
        fetch('fetch_purchased_products.php')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('purchasedProductTableBody');
                tableBody.innerHTML = '';

                data.forEach(product => {
                    const row = document.createElement('tr');

                    const productIdCell = document.createElement('td');
                    productIdCell.textContent = product.product_id;
                    row.appendChild(productIdCell);

                    const productNameCell = document.createElement('td');
                    productNameCell.textContent = product.product_name;
                    row.appendChild(productNameCell);

                    const quantityCell = document.createElement('td');
                    quantityCell.textContent = product.quantity;
                    row.appendChild(quantityCell);

                    const sizeCell = document.createElement('td');
                    sizeCell.textContent = product.size;
                    row.appendChild(sizeCell);

                    const priceCell = document.createElement('td');
                    priceCell.textContent = product.price.toFixed(2);
                    row.appendChild(priceCell);

                    const totalPriceCell = document.createElement('td');
                    totalPriceCell.textContent = (product.price * product.quantity).toFixed(2);
                    row.appendChild(totalPriceCell);

                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error('Error fetching purchased products:', error));
    }

    document.querySelectorAll('.transaction-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const checked = document.querySelectorAll('.transaction-checkbox:checked').length > 0;
            document.getElementById('checkout-btn').disabled = !checked;
        });
    });
    </script>
</body>
</html>
