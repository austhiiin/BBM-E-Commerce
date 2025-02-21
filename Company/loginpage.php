<?php include 'dbconnect.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBM | Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Teko:wght@300..700&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" href="stckimg/BBMbig.png" type="image/x-icon">
    <style>
      .divider:after,
.divider:before {
content: "";
flex: 1;
height: 1px;
background: #eee;
}
.h-custom {
height: calc(100% - 73px);
}
@media (max-width: 450px) {
.h-custom {
height: 100%;
}
}
    </style>
</head>
<body class="">
  <?php if (!empty($errorMessage)) : ?>
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
                <a class="nav-link text-white" aria-current="page" href="Home.php">Home</a>
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
                <a href="loginpage.php"><img src="stckimg/white-user.png" alt="userlogo" width="30" height="30"></a>
                <a href="cartpage.php"><img src="stckimg/white-cart.png" alt="cartlogo" width="30" height="30"></a>
            </div>
          </div>
        </div>
      </nav>
      <hr>
      <main>
      <section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="stckimg/order.png"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <p class="lead fw-normal mb-0 me-3">Sign in with</p>
            <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-grad-vio btn-floating mx-1">
              <img src="stckimg/gmailicon.jpg" alt="" style="width:30px;">
            </button>

            <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-grad-vio btn-floating mx-1">
            <img src="stckimg/igicon.jpg" alt="" style="width:30px;">
            </button>

            
          </div>

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">Or</p>
          </div>
          <form action="login.php" method="post">
          <!-- Email input -->

            <input type="text" id="username" name="username" class="form-control form-control-lg"
              placeholder="Enter username" />
            <label class="form-label" for="username">Username</label>


          <!-- Password input -->

            <input type="password" id="PASSWORD" name="PASSWORD" class="form-control form-control-lg"
              placeholder="Enter password" />
            <label class="form-label" for="password">Password</label>


          

          <div class="text-center text-lg-start mt-4 pt-2">
            <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-grad-vio btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="registerpage.php"
                class="link-danger">Register</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 color-cb">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
    Copyright © 2024. All rights reserved to DATAVAZE.
    </div>
    <!-- Copyright -->

    <!-- Right -->
    <div>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-google"></i>
      </a>
      <a href="#!" class="text-white">
        <i class="fab fa-linkedin-in"></i>
      </a>
    </div>
    <!-- Right -->
  </div>
</section>
      </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>