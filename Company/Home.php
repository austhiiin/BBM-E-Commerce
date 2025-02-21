<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: loginpage.php"); // Redirect to login page if not logged in
    exit();
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBM | Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="stckimg/BBMbig.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Teko:wght@300..700&display=swap"
      rel="stylesheet"
    />
</head>
<body>
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
              <a class="nav-link fw-bold text-white" aria-current="page" href="#">Home</a>
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
          <a href="cartpage.php"><img src="stckimg/white-cart.png" alt="cartlogo" width="30" height="30"></a>
        </div>
      </div>
    </div>
  </nav>
      <hr>

      <section class="container">
        <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="stckimg/adver3.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="stckimg/ads2.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="stckimg/advertise1.jpg" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </section>
      <section class="container mt-5">
        <h1 class="display-1 text-center mt-5 teko-reg">Best Seller</h1>
        <div class="row text-center teko-reg">
            <div class="card col-lg-4 gy-5 border-0 select move-bottom">
                <img src="stckimg/lady1.jpg" alt="" class="rounded-circle shadow">
            </div>
            <div class="card col-lg-4 gy-5 border-0 select move-bottom">
                <img src="stckimg/lady2.jpg" alt="" class="rounded-circle shadow">
            </div>
            <div class="card col-lg-4 gy-5 border-0 select move-bottom">
                <img src="stckimg/lady5.jpg" alt="" class="rounded-circle shadow">
            </div>
        </div>
      </section>
      <hr class="mt-5">
      <section class="container mb-5">
        <h1 class="display-1 text-center teko-reg">Honest Reviews</h1>
        <div class="row">
            <div class="card col-lg-8 gy-5 border-0 shadow-lg move-left">
                <h2 class="mt-3">@lisacutie</h2>
                <p class="card-body">Maganda po ang item. Bibili ulit ako sa susunod gustong-gusto ni mommy for her collection. Thank you po sa pagiging one within.</p>
                <p class="card-body text-gray text-end">Confidence Shoes</p>
            </div>
            <div class="card col-lg-4 gy-5 border-0"></div>
        </div>
        <div class="row">
            <div class="card col-lg-4 gy-5 border-0">
            </div>
            <div class="card col-lg-8 gy-5 border-0 shadow-lg move-right">
                <h2 class="mt-3">@imeeganduh</h2>
                <p class="card-body">Maganda po ang item. Bibili ulit ako sa susunod gustong-gusto ni mommy for her collection. Thank you po sa pagiging one within.</p>
                <p class="card-body text-gray text-end">Confidence Shoes</p>
            </div>
        </div>
        <div class="row">
            <div class="card col-lg-8 gy-5 border-0 shadow-lg move-left">
                <h2 class="mt-3">@imelitaclc</h2>
                <p class="card-body">Maganda po ang item. Bibili ulit ako sa susunod gustong-gusto ni mommy for her collection. Thank you po sa pagiging one within.</p>
                <p class="card-body text-gray text-end">Confidence Shoes</p>
            </div>
            <div class="card col-lg-4 gy-5 border-0"></div>
        </div>
      </section>
      <footer class="container-fluid color-cb">
        <div class="row">
          <div class="col-lg-3 text-white mt-2 mb-2">
            <img src="stckimg/BBMlogo.png" alt="" width="30" height="30 " class="rounded-circle">
            BIG BARGAIN MARKET
          </div>
          <div class="col-lg-6"></div>
          <div class="col-lg-3 text-end">
            <img src="stckimg/igicon.jpg" alt="" width="30" height="30 " class="mt-2 mb-2">
            <img src="stckimg/gmailicon.jpg" alt="" width="30" height="30 " class="mt-2 mb-2">
          </div>
        </div>
      </footer>
      


    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>