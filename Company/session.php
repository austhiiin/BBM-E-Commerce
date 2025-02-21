<?php
session_start();
$_SESSION['username'] = $username;
if (isset($_SESSION['username'])) {
    // User is logged in
    $username = $_SESSION['username'];
    // Retrieve user information from the database and display
} else {
    // User is not logged in
    // Redirect to login page or display a message
}
session_destroy();
?>