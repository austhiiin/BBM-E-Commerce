<?php
include 'dbconnect.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: loginpage.php"); // Redirect to login page if not logged in
    exit();
}

$username = $_SESSION['username'];

// Initialize $feedback variable
$feedback = "";

// Retrieve all reviews
$query = "SELECT p.product_name, r.rating, r.review_text FROM Product_Review r
          INNER JOIN Product p ON r.product_id = p.product_id
          WHERE r.username = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$reviews = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
}
$stmt->close();

// Retrieve products with 'delivered' status that haven't been reviewed yet
$query = "SELECT co.co_id, p.product_id, p.product_name 
          FROM CheckOut co
          INNER JOIN Product p ON co.product_id = p.product_id
          LEFT JOIN Product_Review pr ON p.product_id = pr.product_id AND pr.username = ?
          WHERE co.username = ? AND co.co_status = 'delivered' AND pr.product_id IS NULL";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ss", $username, $username);
$stmt->execute();
$result = $stmt->get_result();

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$stmt->close();
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBM | Review</title>
    <link rel="icon" href="stckimg/BBMbig.png" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@300..700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .checked {
            color: orange;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg" style="background-color: #6c63ff;">
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
                <li class="nav-item active">
                    <a class="nav-link fw-bold text-white" href="Reviews.php">Reviews</a>
                </li>
            </ul>
            <div class="d-flex">
                <a href="logout.php" class="btn btn-danger me-4"> Log out
                    <?php echo htmlspecialchars($_SESSION["username"]); ?>!</a>
                <a href="cartpage.php"><img src="stckimg/white-cart.png" alt="cartlogo" width="30" height="30"></a>
            </div>
        </div>
    </div>
</nav>
<main class="container mt-5">
    <section>
        <div class="container mt-5 mb-4">
            <h2>Reviews</h2>
            <?php if (!empty($reviews)): ?>
                <div class="list-group">
                    <?php foreach ($reviews as $review): ?>
                        <div class="list-group-item">
                            <h5 class="mb-1"><?php echo htmlspecialchars($review['product_name']); ?></h5>
                            <p class="mb-1">Rating: 
                                <?php
                                $rating = $review['rating'];
                                for ($i = 1; $i <= 5; $i++) {
                                    echo $i <= $rating ? '<span class="fa fa-star checked"></span>' : '<span class="fa fa-star"></span>';
                                }
                                ?>
                            </p>
                            <p class="mb-1"><?php echo htmlspecialchars($review['review_text']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No reviews found.</p>
            <?php endif; ?>
        </div>
    </section>
    <div class="card">
        <div class="card-header">
            <h2>Submit Your Review</h2>
        </div>
        <div class="card-body">
            <?php if ($feedback): ?>
                <div class="alert alert-info">
                    <?php echo htmlspecialchars($feedback); ?>
                </div>
            <?php endif; ?>
            <form action="submit_review.php" method="post">
                <div class="mb-3">
                    <label for="product" class="form-label">Product</label>
                    <select class="form-select" id="product" name="product" required>
                        <option value="">Select a product to review</option>
                        <?php foreach ($products as $product): ?>
                            <option value="<?php echo htmlspecialchars($product['co_id']) . '|' . htmlspecialchars($product['product_id']); ?>">
                                <?php echo htmlspecialchars($product['product_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating (1 to 5)</label>
                    <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" required>
                </div>
                <div class="mb-3">
                    <label for="review_text" class="form-label">Review</label>
                    <textarea class="form-control" id="review_text" name="review_text" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-grad-vio text-white" onclick="showLoading()">Submit Review</button>
            </form>
        </div>
    </div>
</main>
<footer class="container-fluid color-cb mt-5">
    <div class="row">
        <div class="col-lg-3 text-white mt-2 mb-2">
            <img src="stckimg/BBMlogo.png" alt="" width="30" height="30" class="rounded-circle">
            BIG BARGAIN MART
        </div>
        <div class="col-lg-6"></div>
        <div class="col-lg-3 text-end">
            <img src="stckimg/igicon.jpg" alt="" width="30" height="30" class="mt-2 mb-2">
            <img src="stckimg/gmailicon.jpg" alt="" width="30" height="30" class="mt-2 mb-2">
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
