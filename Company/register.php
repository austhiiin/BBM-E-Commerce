<?php
$servername = "localhost";
$db_username = "root";
$password = "";
$database = "bbmdb";


$conn = new mysqli($servername, $db_username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$username = $_POST['username'];
$email = $_POST['email'];
$birthdate = $_POST['birthdate'];
$PASSWORD = $_POST['PASSWORD'];

// Insert data into database
$sql = "INSERT INTO `users`(`first_name`, `last_name`, `username`, `email`, `birthdate`, `PASSWORD`) VALUES ('$first_name','$last_name','$username','$email','$birthdate','$PASSWORD')";
$check_query = "SELECT * FROM users WHERE username='$username'";
$check_result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    // Username already exists, display error message
        session_start();
        $_SESSION['login_error'] = "$username Username already exist. Choose a unique one.";
        
} else {
if ($conn->query($sql) === TRUE) {
    echo "Successfully Registered";
    header("Location: loginpage.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}

$conn->close();
?>
