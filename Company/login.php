<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "bbmdb";


$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Insert data into database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $PASSWORD = $_POST['PASSWORD'];

    // Query to check if user exists
    $sql = "SELECT * FROM users WHERE username = '$username' AND PASSWORD = '$PASSWORD'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User authenticated
        session_start();
        $_SESSION['username'] = $username;
        header("Location: Home.php"); // Redirect to welcome page
    } else {
        session_start();
        $_SESSION['login_error'] = "Incorrect username or password. Please try again.";
        header("Location: loginpage.php");
    }
   
}
$conn->close();

?>
