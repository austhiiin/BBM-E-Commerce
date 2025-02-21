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
    <title>BBM | Category</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="stckimg/BBMbig.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@300..700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* Custom styling for the sidebar */
        .checked {
            color: orange;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: -250px;
            /* Initially hidden */
            background-color: #f8f9fa;
            padding-top: 20px;
            transition: left 0.3s ease;
            z-index: 1;
            /* Ensure it overlays main content */
        }

        .sidebar.open {
            left: 0;
            /* Visible */
        }

        .sidebar a {
            padding: 10px 20px;
            text-decoration: none;
            font-size: 18px;
            color: #333;
            display: block;
        }

        .sidebar a:hover {
            background-color: #e9ecef;
        }

        /* Style for toggle button */
        .toggle-btn:hover {
            background-color: #e9ecef;
            z-index: 2;
            /* Ensure it overlays sidebar */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg color-cb">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">
                <img src="stckimg/BBMbig.png" alt="Logo" width="30" height="30"
                    class="d-inline-block align-text-top rounded-circle">
                <span class="text-white teko-reg">BIG BARGAIN MART</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" href="Home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-white" href="Category.php">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="FAQ.php">FAQs</a>
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


    <aside class="sidebar" id="sidebar">
        <h4 class="text-center teko-reg">Categories</h4>
        <ul class="list-unstyled">
            <li><a href="#cat1">Men's Footwear</a></li>
            <li><a href="#cat2">Ladies' Footwear</a></li>
            <li><a href="#cat3">Kids' Footwear</a></li>
            <li><a href="#cat4">Toddlers' Footwear</a></li>
            <li><a href="#cat5">Accessories</a></li>

        </ul>
        <section>
            <div class="text-center">
                <button class="btn toggle-btn" onclick="toggleSidebar()">Close</button>
            </div>
        </section>
    </aside>
    <section>
        <div class="text-center">
            <button class="btn toggle-btn" onclick="toggleSidebar()">View Categories</button>
        </div>
    </section>
    <main>
        <div class="container">

            <h2 class="display-5 teko-reg" id="cat1">Men's Footwear</h2>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php
                // Step 1: Connect to your database
                $conn = mysqli_connect("localhost", "root", "", "bbmdb");

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Step 2: Fetch data from the database
                $sql = "SELECT p.*, AVG(pr.rating) AS avg_rating
                FROM Product p
                LEFT JOIN Product_Review pr ON p.product_id = pr.product_id
                LEFT JOIN CheckOut co ON pr.co_id = co.co_id
                WHERE p.category = 'cat1'
                GROUP BY p.product_id";


                $result = mysqli_query($conn, $sql);

                // Step 3 and 4: Use Bootstrap and loop through data to display on cards
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="col mb-4">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                                    <img src="<?php echo $row["image_url"]; ?>" class="card-img-top" alt="images">
                                    <p class="card-text"><?php echo $row['product_description']; ?></p>

                                    <p>Rating:
                                        <?php
                                        // Get the average rating from the database
                                        $avg_rating = isset($row['avg_rating']) ? $row['avg_rating'] : 0;

                                        // Round the rating to the nearest half-star
                                        $rounded_rating = round($avg_rating * 2) / 2;

                                        // Loop through 5 stars
                                        for ($i = 1; $i <= 5; $i++) {
                                            // Check if the current star should be filled, half-filled, or empty
                                            if ($rounded_rating >= $i) {
                                                // Full star
                                                echo '<span class="fa fa-star checked"></span>';
                                            } elseif ($rounded_rating == $i - 0.5) {
                                                // Half star
                                                echo '<span class="fa fa-star-half-o checked"></span>';
                                            } else {
                                                // Empty star
                                                echo '<span class="fa fa-star"></span>';
                                            }
                                        }

                                        // Display the average rating as a number
                                        echo isset($row['avg_rating']) ? number_format($row['avg_rating'], 1) : "N/A";
                                        ?>
                                    </p>
                                    <p>Stocks: <?php echo $row['quantity']; ?></p>
                                    <form method="post" action="post-transact.php" class="text-center"
                                        onsubmit="return checkQuantity(this, <?php echo $row['quantity']; ?>)">
                                        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>"
                                            required>
                                        <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                                        <div class="mb-3">
                                            <label for="quantity">Quantity:</label><br>
                                            <input type="number" id="quantity" name="quantity" value="1" min="1"
                                                max="<?php echo $row['quantity']; ?>" size="4" required><br>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pr_size">Size (36-46):</label><br>
                                            <input type="number" name="pr_size" placeholder="36-46" min="36" max="46" size="4"
                                                required><br>
                                        </div>
                                        <button type="submit" class="btn btn-grad-vio mb-2 w-100 mt-2" <?php echo ($row['quantity'] == 0) ? 'disabled' : ''; ?>>Add to Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "0 results";
                }

                // Close connection
                mysqli_close($conn);
                ?>
            </div>

            <h2 class="display-5 teko-reg" id="cat2">Ladies' Footwear</h2>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php
                // Step 1: Connect to your database
                $conn = mysqli_connect("localhost", "root", "", "bbmdb");

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Step 2: Fetch data from the database
                $sql = "SELECT p.*, AVG(pr.rating) AS avg_rating
                FROM Product p
                LEFT JOIN Product_Review pr ON p.product_id = pr.product_id
                LEFT JOIN CheckOut co ON pr.co_id = co.co_id
                WHERE p.category = 'cat2'
                GROUP BY p.product_id";


                $result = mysqli_query($conn, $sql);

                // Step 3 and 4: Use Bootstrap and loop through data to display on cards
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="col mb-4">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                                    <img src="<?php echo $row["image_url"]; ?>" class="card-img-top" alt="images">
                                    <p class="card-text"><?php echo $row['product_description']; ?></p>

                                    <p>Rating:
                                        <?php
                                        // Get the average rating from the database
                                        $avg_rating = isset($row['avg_rating']) ? $row['avg_rating'] : 0;

                                        // Round the rating to the nearest half-star
                                        $rounded_rating = round($avg_rating * 2) / 2;

                                        // Loop through 5 stars
                                        for ($i = 1; $i <= 5; $i++) {
                                            // Check if the current star should be filled, half-filled, or empty
                                            if ($rounded_rating >= $i) {
                                                // Full star
                                                echo '<span class="fa fa-star checked"></span>';
                                            } elseif ($rounded_rating == $i - 0.5) {
                                                // Half star
                                                echo '<span class="fa fa-star-half-o checked"></span>';
                                            } else {
                                                // Empty star
                                                echo '<span class="fa fa-star"></span>';
                                            }
                                        }

                                        // Display the average rating as a number
                                        echo isset($row['avg_rating']) ? number_format($row['avg_rating'], 1) : "N/A";
                                        ?>
                                    </p>
                                    <p>Stocks: <?php echo $row['quantity']; ?></p>
                                    <form method="post" action="post-transact.php" class="text-center"
                                        onsubmit="return checkQuantity(this, <?php echo $row['quantity']; ?>)">
                                        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>"
                                            required>
                                        <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                                        <div class="mb-3">
                                            <label for="quantity">Quantity:</label><br>
                                            <input type="number" id="quantity" name="quantity" value="1" min="1"
                                                max="<?php echo $row['quantity']; ?>" size="4" required><br>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pr_size">Size (36-46):</label><br>
                                            <input type="number" name="pr_size" placeholder="36-46" min="36" max="46" size="4"
                                                required><br>
                                        </div>
                                        <button type="submit" class="btn btn-grad-vio mb-2 w-100 mt-2" <?php echo ($row['quantity'] == 0) ? 'disabled' : ''; ?>>Add to Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "0 results";
                }

                // Close connection
                mysqli_close($conn);
                ?>
            </div>

            <h2 class="display-5 teko-reg" id="cat3">Kids' Footwear</h2>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php
                // Step 1: Connect to your database
                $conn = mysqli_connect("localhost", "root", "", "bbmdb");

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Step 2: Fetch data from the database
                $sql = "SELECT p.*, AVG(pr.rating) AS avg_rating
                FROM Product p
                LEFT JOIN Product_Review pr ON p.product_id = pr.product_id
                LEFT JOIN CheckOut co ON pr.co_id = co.co_id
                WHERE p.category = 'cat3'
                GROUP BY p.product_id";


                $result = mysqli_query($conn, $sql);

                // Step 3 and 4: Use Bootstrap and loop through data to display on cards
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="col mb-4">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                                    <img src="<?php echo $row["image_url"]; ?>" class="card-img-top" alt="images">
                                    <p class="card-text"><?php echo $row['product_description']; ?></p>

                                    <p>Rating:
                                        <?php
                                        // Get the average rating from the database
                                        $avg_rating = isset($row['avg_rating']) ? $row['avg_rating'] : 0;

                                        // Round the rating to the nearest half-star
                                        $rounded_rating = round($avg_rating * 2) / 2;

                                        // Loop through 5 stars
                                        for ($i = 1; $i <= 5; $i++) {
                                            // Check if the current star should be filled, half-filled, or empty
                                            if ($rounded_rating >= $i) {
                                                // Full star
                                                echo '<span class="fa fa-star checked"></span>';
                                            } elseif ($rounded_rating == $i - 0.5) {
                                                // Half star
                                                echo '<span class="fa fa-star-half-o checked"></span>';
                                            } else {
                                                // Empty star
                                                echo '<span class="fa fa-star"></span>';
                                            }
                                        }

                                        // Display the average rating as a number
                                        echo isset($row['avg_rating']) ? number_format($row['avg_rating'], 1) : "N/A";
                                        ?>
                                    </p>
                                    <p>Stocks: <?php echo $row['quantity']; ?></p>
                                    <form method="post" action="post-transact.php" class="text-center"
                                        onsubmit="return checkQuantity(this, <?php echo $row['quantity']; ?>)">
                                        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>"
                                            required>
                                        <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                                        <div class="mb-3">
                                            <label for="quantity">Quantity:</label><br>
                                            <input type="number" id="quantity" name="quantity" value="1" min="1"
                                                max="<?php echo $row['quantity']; ?>" size="4" required><br>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pr_size">Size (36-46):</label><br>
                                            <input type="number" name="pr_size" placeholder="36-46" min="36" max="46" size="4"
                                                required><br>
                                        </div>
                                        <button type="submit" class="btn btn-grad-vio mb-2 w-100 mt-2" <?php echo ($row['quantity'] == 0) ? 'disabled' : ''; ?>>Add to Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "0 results";
                }

                // Close connection
                mysqli_close($conn);
                ?>
            </div>

            <h2 class="display-5 teko-reg" id="cat4">Toddlers' Footwear</h2>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php
                // Step 1: Connect to your database
                $conn = mysqli_connect("localhost", "root", "", "bbmdb");

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Step 2: Fetch data from the database
                $sql = "SELECT p.*, AVG(pr.rating) AS avg_rating
                FROM Product p
                LEFT JOIN Product_Review pr ON p.product_id = pr.product_id
                LEFT JOIN CheckOut co ON pr.co_id = co.co_id
                WHERE p.category = 'cat4'
                GROUP BY p.product_id";


                $result = mysqli_query($conn, $sql);

                // Step 3 and 4: Use Bootstrap and loop through data to display on cards
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="col mb-4">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                                    <img src="<?php echo $row["image_url"]; ?>" class="card-img-top" alt="images">
                                    <p class="card-text"><?php echo $row['product_description']; ?></p>

                                    <p>Rating:
                                        <?php
                                        // Get the average rating from the database
                                        $avg_rating = isset($row['avg_rating']) ? $row['avg_rating'] : 0;

                                        // Round the rating to the nearest half-star
                                        $rounded_rating = round($avg_rating * 2) / 2;

                                        // Loop through 5 stars
                                        for ($i = 1; $i <= 5; $i++) {
                                            // Check if the current star should be filled, half-filled, or empty
                                            if ($rounded_rating >= $i) {
                                                // Full star
                                                echo '<span class="fa fa-star checked"></span>';
                                            } elseif ($rounded_rating == $i - 0.5) {
                                                // Half star
                                                echo '<span class="fa fa-star-half-o checked"></span>';
                                            } else {
                                                // Empty star
                                                echo '<span class="fa fa-star"></span>';
                                            }
                                        }

                                        // Display the average rating as a number
                                        echo isset($row['avg_rating']) ? number_format($row['avg_rating'], 1) : "N/A";
                                        ?>
                                    </p>
                                    <p>Stocks: <?php echo $row['quantity']; ?></p>
                                    <form method="post" action="post-transact.php" class="text-center"
                                        onsubmit="return checkQuantity(this, <?php echo $row['quantity']; ?>)">
                                        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>"
                                            required>
                                        <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                                        <div class="mb-3">
                                            <label for="quantity">Quantity:</label><br>
                                            <input type="number" id="quantity" name="quantity" value="1" min="1"
                                                max="<?php echo $row['quantity']; ?>" size="4" required><br>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pr_size">Size (36-46):</label><br>
                                            <input type="number" name="pr_size" placeholder="36-46" min="36" max="46" size="4"
                                                required><br>
                                        </div>
                                        <button type="submit" class="btn btn-grad-vio mb-2 w-100 mt-2" <?php echo ($row['quantity'] == 0) ? 'disabled' : ''; ?>>Add to Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "0 results";
                }

                // Close connection
                mysqli_close($conn);
                ?>
            </div>

            <h2 class="display-5 teko-reg" id="cat5">Accessories</h2>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php
                // Step 1: Connect to your database
                $conn = mysqli_connect("localhost", "root", "", "bbmdb");

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Step 2: Fetch data from the database
                $sql = "SELECT p.*, AVG(pr.rating) AS avg_rating
                FROM Product p
                LEFT JOIN Product_Review pr ON p.product_id = pr.product_id
                LEFT JOIN CheckOut co ON pr.co_id = co.co_id
                WHERE p.category = 'cat5'
                GROUP BY p.product_id";


                $result = mysqli_query($conn, $sql);

                // Step 3 and 4: Use Bootstrap and loop through data to display on cards
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="col mb-4">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                                    <img src="<?php echo $row["image_url"]; ?>" class="card-img-top" alt="images">
                                    <p class="card-text"><?php echo $row['product_description']; ?></p>

                                    <p>Rating:
                                        <?php
                                        // Get the average rating from the database
                                        $avg_rating = isset($row['avg_rating']) ? $row['avg_rating'] : 0;

                                        // Round the rating to the nearest half-star
                                        $rounded_rating = round($avg_rating * 2) / 2;

                                        // Loop through 5 stars
                                        for ($i = 1; $i <= 5; $i++) {
                                            // Check if the current star should be filled, half-filled, or empty
                                            if ($rounded_rating >= $i) {
                                                // Full star
                                                echo '<span class="fa fa-star checked"></span>';
                                            } elseif ($rounded_rating == $i - 0.5) {
                                                // Half star
                                                echo '<span class="fa fa-star-half-o checked"></span>';
                                            } else {
                                                // Empty star
                                                echo '<span class="fa fa-star"></span>';
                                            }
                                        }

                                        // Display the average rating as a number
                                        echo isset($row['avg_rating']) ? number_format($row['avg_rating'], 1) : "N/A";
                                        ?>
                                    </p>
                                    <p>Stocks: <?php echo $row['quantity']; ?></p>
                                    <form method="post" action="post-transact.php" class="text-center"
                                        onsubmit="return checkQuantity(this, <?php echo $row['quantity']; ?>)">
                                        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>"
                                            required>
                                        <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
                                        <div class="mb-3">
                                            <label for="quantity">Quantity:</label><br>
                                            <input type="number" id="quantity" name="quantity" value="1" min="1"
                                                max="<?php echo $row['quantity']; ?>" size="4" required><br>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pr_size">Size (36-46):</label><br>
                                            <input type="number" name="pr_size" placeholder="36-46" min="36" max="46" size="4"
                                                required><br>
                                        </div>
                                        <button type="submit" class="btn btn-grad-vio mb-2 w-100 mt-2" <?php echo ($row['quantity'] == 0) ? 'disabled' : ''; ?>>Add to Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "0 results";
                }

                // Close connection
                mysqli_close($conn);
                ?>
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
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('open');
        }
    </script>
</body>

</html>