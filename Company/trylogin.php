<?php include 'dbconnect.php' ?>
<!DOCTYPE html>
<html>
<head>
    <title>Insert Data into Database</title>
</head>
<body>
    <h2>Enter Data</h2>
    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="PASSWORD">Password:</label>
        <input type="password" id="PASSWORD" name="PASSWORD" required><br><br>
        <a href="try.php"><input type="submit" value="Submit"></a>
    </form>
</body>
<script>
    
</script>
</html>
