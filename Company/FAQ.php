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
  <title>BBM | FAQ</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
  <link rel="icon" href="stckimg/BBMbig.png" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Teko:wght@300..700&display=swap"
      rel="stylesheet"
    />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .accordion-button {
      border-radius: 50px;
      /* Rounded border for the header button */

      transition: border-radius 0.5s ease-in-out;
    }

    .accordion-button:focus {
      box-shadow: none;
    }

    .accordion-button:not(.collapsed) {
      color: #fff;
      background-color: #007bff;
      border-radius: 50px 50px 0 0;
      /* Rounded border for the open state */
    }

    .accordion-button.collapsed {
      border-radius: 50px;
      /* Rounded border for the collapsed state */
    }

    .accordion-collapse {
      border-radius: 0 0 50px 50px;
      /* Rounded border for the body */
      overflow: hidden;
      /* Ensures that the border-radius effect is visible */
    }

    .accordion-body {
      background-color: #f8f9fa;
    }
    .btn-grad-viot {
    background-image: linear-gradient(to right, #f8a4d8 0%, #6c63ff 51%, #f8a4d8 100%);
    margin: 10px;
    transition: 1.0s;
    background-size: 200% auto;
    color: white;
    box-shadow: 0 0 20px #eee;
    border-radius: 10px;
}
.btn-grad-viot:hover {
    background-position: right center;
    color: #fff;
    text-decoration: none;
}

  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg color-cb">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.html">
        <img src="stckimg/BBMbig.png" alt="Logo" width="30" height="30"
          class="d-inline-block align-text-top rounded-circle">
        <span class="text-white teko-reg"> BIG BARGAIN MART</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
            <a class="nav-link fw-bold text-white" href="FAQ.php">FAQs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="Reviews.php">Reviews</a>
          </li>
        </ul>
        <div class="d-flex">
          <a href="logout.php" class="btn btn-danger me-4"> Log out
            <?php echo htmlspecialchars($_SESSION["username"]) ?>!</a>
          <a href="cartpage.php"><img src="stckimg/white-cart.png" alt="cartlogo" width="30" height="30"></a>
        </div>
      </div>
    </div>
  </nav>
  <hr>
  <main class="container">
    <h1 class="display-1 text-center">Frequently Asked Questions</h1>
    <div class="row mt-5">
      <!-- Order and Products FAQ -->
        <h1 class="h1">Order, Delivery, and Products</h1>
      </div>
      <div class="container mt-5">
        <div class="row">
        <div class="col-lg-6">
          <div class="accordion accordion-flush" id="acc1">
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-h1">
                <button class="accordion-button btn-grad-viot collapsed" style="border-radius: 50px;" type="button"
                  data-bs-toggle="collapse" data-bs-target="#flush-1" aria-expanded="false" aria-controls="flush-1">
                  How to order?
                </button>
              </h2>
              <div id="flush-1" class="accordion-collapse collapse" style="border-radius: 25px;"
                aria-labelledby="flush-h1" data-bs-parent="#acc1">
                <div class="accordion-body">- To place an order, please log in or sign up on our website first. Once
                  logged in, you can browse through various categories to select the product you want. Finally, add the
                  item to your cart and proceed to checkout to complete your purchase.</div>
              </div>
            </div>
          </div>

          <div class="accordion accordion-flush" id="acc2">
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-h2">
                <button class="accordion-button btn-grad-viot collapsed" style="border-radius: 50px;" type="button"
                  data-bs-toggle="collapse" data-bs-target="#flush-2" aria-expanded="false" aria-controls="flush-2">
                  Are your product authentic?
                </button>
              </h2>
              <div id="flush-2" class="accordion-collapse collapse" style="border-radius: 25px;"
                aria-labelledby="flush-h2" data-bs-parent="#acc2">
                <div class="accordion-body">- Absolutely, all our products are 100% authentic. We source our original
                  shoes directly from reputable manufacturers and authorized dealers to ensure quality and authenticity.
                  Shop with confidence knowing you are getting genuine products every time</div>
              </div>
            </div>
          </div>

          <div class="accordion accordion-flush" id="acc3">
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-h3">
                <button class="accordion-button btn-grad-viot collapsed" style="border-radius: 50px;" type="button"
                  data-bs-toggle="collapse" data-bs-target="#flush-3" aria-expanded="false" aria-controls="flush-3">
                  Can I cancel my order?
                </button>
              </h2>
              <div id="flush-3" class="accordion-collapse collapse" style="border-radius: 25px;"
                aria-labelledby="flush-h3" data-bs-parent="#acc3">
                <div class="accordion-body">Yes, you can cancel your order. Please contact our customer service team
                  within 24 hours of placing your order to initiate the cancellation process. Thank you for your
                  understanding.</div>
              </div>
            </div>
          </div>

          <div class="accordion accordion-flush" id="acc4">
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-h4">
                <button class="accordion-button btn-grad-viot collapsed" style="border-radius: 50px;" type="button"
                  data-bs-toggle="collapse" data-bs-target="#flush-4" aria-expanded="false" aria-controls="flush-4">
                  How long will it take to be delivered?
                </button>
              </h2>
              <div id="flush-4" class="accordion-collapse collapse" style="border-radius: 25px;"
                aria-labelledby="flush-h4" data-bs-parent="#acc4">
                <div class="accordion-body">- International deliveries typically take around 3 to 4 weeks, while
                  national deliveries usually arrive within 3 to 7 days.</div>
              </div>
            </div>
          </div>

          <div class="accordion accordion-flush" id="acc5">
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-h5">
                <button class="accordion-button btn-grad-viot collapsed" style="border-radius: 50px;" type="button"
                  data-bs-toggle="collapse" data-bs-target="#flush-5" aria-expanded="false" aria-controls="flush-5">
                  Do you have physical stores?
                </button>
              </h2>
              <div id="flush-5" class="accordion-collapse collapse" style="border-radius: 25px;"
                aria-labelledby="flush-h5" data-bs-parent="#acc5">
                <div class="accordion-body">- At present, we operate solely online and do not have any physical stores.
                  All transactions and purchases are conducted through our website, providing a convenient and
                  accessible platform for our customers.</div>
              </div>
            </div>
          </div>

          <div class="accordion accordion-flush" id="acc6">
            <div class="accordion-item">
              <h2 class="accordion-header" id="flush-h6">
                <button class="accordion-button btn-grad-viot collapsed" style="border-radius: 50px;" type="button"
                  data-bs-toggle="collapse" data-bs-target="#flush-6" aria-expanded="false" aria-controls="flush-6">
                  Do you deliver overseas?
                </button>
              </h2>
              <div id="flush-6" class="accordion-collapse collapse" style="border-radius: 25px;"
                aria-labelledby="flush-h6" data-bs-parent="#acc6">
                <div class="accordion-body">- Yes, we do offer overseas delivery. International shipments typically take
                  about 3 to 4 weeks to arrive.</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
    <img src="stckimg/vector.jpg" alt="" width="80%">
  </div>
</div>


      </div>


    </div>

  </main>
  <footer class="container-fluid color-cb mt-5">
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