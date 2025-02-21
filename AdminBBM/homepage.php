<?php
// Initialize the session
session_start();
if (!isset($_SESSION['admin_username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}
$admin_username = $_SESSION['admin_username'];

// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$database = "bbmdb";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve admin name from database
$sql = "SELECT admin_name FROM admins WHERE admin_username = '$admin_username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $admin_name = $row['admin_name'];
} else {
    $admin_name = "Unknown"; // Set a default name if not found
}

// Query to count the number of records with co_status as "Delivered"
$sqldeliver = "SELECT COUNT(*) as delivered_count FROM CheckOut WHERE co_status = 'Delivered'";
$result = $conn->query($sqldeliver);

$delivered_count = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $delivered_count = $row["delivered_count"];
}

// Query to count the number of records with co_status as "Pending"
$sqlpending = "SELECT COUNT(*) as pending_count FROM CheckOut WHERE co_status = 'Pending'";
$result = $conn->query($sqlpending);

$pending_count = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $pending_count = $row["pending_count"];
}

// Query to count the number of records with co_status as "cancelled"
$sqlcc = "SELECT COUNT(*) as cc_count FROM CheckOut WHERE co_status = 'Cancelled'";
$result = $conn->query($sqlcc);

$cc_count = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $cc_count = $row["cc_count"];
}

//Total
$sqltt = "SELECT SUM(quantity) as total_quantity FROM Product";
$result = $conn->query($sqltt);

$total_quantity = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_quantity = $row["total_quantity"];
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title>Home</title>
</head>
<body>
    <header class="container">
        <div class="row mt-2">
            <div class="col-lg-6"><h2>Home page</h2></div>
            <div class="col-lg-6 text-end">
                <a href="logout.php" class="btn btn-danger ml-4"> Log out</a>
            </div> 
        </div>
        <p class="h4">Welcome, Admin  <?php echo htmlspecialchars($admin_name) ?>! </p> <!-- Display admin's name -->
    </header>
    <main class="mt-5 text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                <div class="card bg-dark">
          <div class="card-body">
            <h5 class="card-title text-white">Today's Date</h5>
            <p class="card-text text-white">The current date is: <span id="currentDate"></span></p>
          </div>
        </div>
                </div>
                <div class="col-lg-3">
                <div class="card bg-success">
          <div class="card-body">
            <h5 class="card-title text-white">Delivered Order for this month</span></h5>
            <p class="card-text text-white">Total Delivered Orders: <?php echo $delivered_count; ?></p>
          </div>
        </div>
                </div>
                <div class="col-lg-3">
                <div class="card bg-warning">
          <div class="card-body">
            <h5 class="card-title text-white">Pending Orders for this month</h5>
            <p class="card-text text-white">Total Pending Orders: <?php echo $pending_count; ?></p>
          </div>
        </div>
                </div>
                <div class="col-lg-3">
                <div class="card bg-danger">
          <div class="card-body">
            <h5 class="card-title text-white">Cancelled Orders for this month</h5>
            <p class="card-text text-white">Total Cancelled Orders: <?php echo $cc_count; ?></p>
          </div>
        </div>
                </div>
            </div>
        </div>
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12">
                <div class="card btn-grad-vio">
                    <div class="card-body">
                        <h5 class="card-title">Total Quantity of Products</h5>
                        <p class="card-text">Total Quantity: <?php echo $total_quantity; ?></p>
                    </div>
                </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="container mb-5">
            <div class="row">
                <div class="col-lg-12 gy-5">
                    <div class="card">
                        <div class="title text-center">
                            <h6 class="card-title display-3">Manage Products</h6>
                        </div>
                        <div class="card-body">
                            <?php include 'productsview.php'?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 gy-5">
                <div class="card">
                        <div class="title text-center">
                            <h6 class="card-title display-3">Manage Orders</h6>
                        </div>
                        <div class="card-body">
                            <?php include 'ordersview.php'?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
    // Get today's date
    var today = new Date();

    // Format the date as per your requirement
    var formattedDate = today.toLocaleDateString('en-US', {
      weekday: 'long',
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    });

    var formattedMonth = today.toLocaleDateString('en-US', {
      month: 'long',
      day: 'numeric'
    });

    // Display the formatted date
    document.getElementById('currentDate').textContent = formattedDate;
    document.getElementById('currentMonth').textContent = formattedMonth;

    function showLoading() {
    // Display loading animation
    var loader = '<div class="loader"></div>';
    document.body.innerHTML += loader;

    // Submit the form after a brief delay (you can adjust the delay as needed)
    setTimeout(function() {
      document.getElementById('myForm').submit();
    }, 1000); // 1000 milliseconds = 1 second
  }
  </script>
</body>
</html>
