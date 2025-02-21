<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: trylogin.php"); // Redirect to login page if not logged in
    exit();
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBM | Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="stckimg/BBMbig.png" type="image/x-icon">
</head>
<body class="montserrat-font">
    <h2 class="container">Logging In</h2>
    <script>
        setTimeout(function() {
            window.location.href = "home.php"; // Redirect to home page after 3 seconds
        }, 1000); // 3000 milliseconds = 3 seconds
    </script>
</body>
</html>       
