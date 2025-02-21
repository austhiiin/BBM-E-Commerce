<?php include 'config.php'; 
  session_start();

  // Check if error message is set in session
  if (isset($_SESSION['login_error'])) {
      $errorMessage = $_SESSION['login_error'];
      // Clear the error message from session to prevent displaying it again on refresh
      unset($_SESSION['login_error']);
  } else {
      $errorMessage = "";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body{ 
            font-size: 14px; 
            font-family: 'montserrat'; 
        
        }

    </style>
</head>
<body>
    <?php if (!empty($errorMessage)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>
    <main class="container">
        <div class="row mt-5">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <h2 class="Display-2 text-center">Admin Login</h2>
                <?php 
                    if(!empty($login_err)){
                        echo '<div class="alert alert-danger">' . $login_err . '</div>';
                    }        
                ?>
                <form action="loginfetch.php" class="mt-4 text-center" method="post">
                    <label for="admin_username">Username:</label><br>
                    <input type="text" id="admin_username" name="admin_username"><br>
                    <label for="admin_ps">Password:</label><br>
                    <input type="password" id="admin_ps" name="admin_ps"><br><br>
                    <input type="submit" value="Log-in"><br>
                </form>
            </div>
            <div class="col-lg-4"></div>
        </div>
    </main>
</body>
</html>