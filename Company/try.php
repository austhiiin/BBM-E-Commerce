<?php include 'dbconnect.php' ?>
<!DOCTYPE html>
<html>
<head>
    <title>Insert Data into Database</title>
</head>
<body>
    <h2>Enter Data</h2>
    <form action="register.php" method="post">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required><br><br>
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required><br><br>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="birhtdate">Birthdate:</label>
        <input type="date" id="birthdate" name="birthdate" required><br><br>
        <label for="PASSWORD">Password:</label>
        <input type="password" id="PASSWORD" name="PASSWORD" required><br><br>
        <a href="try.php"><input type="submit" value="Submit"></a>
    </form>
</body>
<script>
    
</script>
</html>
