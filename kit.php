<?php 
include 'db_connection.php';
session_start();

// Initialize variables
$isLoggedIn = isset($_SESSION['user_id']); // Check if user is logged in
$cartCount = 0; // Initialize cart count

// If user is logged in, get cart count from database
if ($isLoggedIn) {
    $userId = $_SESSION['user_id'];
    $cartQuery = "SELECT COUNT(*) as count FROM cart WHERE user_id = '$userId'";
    $cartResult = mysqli_query($conn, $cartQuery);
    if ($cartResult) {
        $cartData = mysqli_fetch_assoc($cartResult);
        $cartCount = $cartData['count'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    #product-card h1 {
        text-align: center;
        margin-bottom: 30px;
        color:rgb(29, 26, 26);  /* Adjust color as needed */
    }
    #product-card h4 {
        text-align: center;
        margin-bottom: 30px;
        color:rgb(17, 3, 3);
    }

    #product-card .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -15px; /* Negative margin to counteract column padding */
    }

    #product-card .col-md-3 {
        width: 25%;
        padding: 0 15px;
        box-sizing: border-box;
        margin-bottom: 30px;
    }

    #product-card .card {
        position: relative;
        overflow: hidden;
        border: none;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        height: 100%;
    }

    #product-card .card img {
        width: 100%;  /* Ensure image takes full width */
        height: auto; /* Maintain aspect ratio */
        max-height: 250px; /* Limit the max height of images */
        object-fit: cover; /* Ensure image is properly cropped */
    }

    #product-card .card-body {
        padding: 15px;
        text-align: center;
    }

    #product-card .star {
        color: #FFD700;  /* Gold color for stars */
    }

    #product-card .star .bx.bxs-star.checked {
        color: #FFD700;
    }

    #product-card button {
        background-color: #007bff;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    #product-card button:hover {
        background-color: #0056b3;
    }

    #product-card .overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(0, 0, 0, 0.5);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        justify-content: space-around;
        align-items: center;
    }

    #product-card .card:hover .overlay {
        opacity: 1; /* Show overlay on hover */
    }

    #product-card .overlay button {
        background: transparent;
        border: none;
        color: white;
        cursor: pointer;
    }

    #product-card .overlay button img {
        width: 25px;
        height: 25px;
    }
    
    /* Responsive adjustments */
    @media (max-width: 992px) {
        #product-card .col-md-3 {
            width: 50%;
        }
    }
    
    @media (max-width: 576px) {
        #product-card .col-md-3 {
            width: 100%;
        }
    }
    </style>
</head>
<body>
    <section id="product-card">
        <div class="container">
          <h1> Kit Kat Cakes</h1>
          <div class="row">
            <!-- Product 1 -->
            <div class="col-md-3 py-3 py-md-0">
              <div class="card">
                <img src="images/j1.png" alt="">
                <div class="card-body">
                  <h4>KitKat Crunch Chocolate Cake</h4>
                  <div class="star">
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star "></i>
                    <i class="bx bxs-star "></i>
                  </div>
                  <span><a href="test.php?product=KitKat Crunch Chocolate Cake&price=180&image=images/j1.png">
                    <button>Order Now</button>
                  </a></span>
                </div>
              </div>
            </div>

            <!-- Product 2 -->
            <div class="col-md-3 py-3 py-md-0">
              <div class="card">
                <img src="images/j2.png" alt="">
                <div class="card-body">
                  <h4>KitKat Chocolate Truffle Cake</h4>
                  <div class="star">
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star "></i>
                    <i class="bx bxs-star "></i>
                  </div>
                  <span><a href="test.php?product=KitKat Chocolate Truffle Cake&price=180&image=images/j2.png">
                    <button>Order Now</button>
                  </a></span>
                </div>
              </div>
            </div>
            
            <!-- Product 3 -->
            <div class="col-md-3 py-3 py-md-0">
              <div class="card">
                <img src="images/j3.png" alt="">
                <div class="card-body">
                  <h4>Gems & KitKat Chocolate Truffle Cake</h4>
                  <div class="star">
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star "></i>
                    <i class="bx bxs-star "></i>
                  </div>
                  <span><a href="test.php?product=Gems & KitKat Chocolate Truffle Cake&price=180&image=images/j3.png">
                    <button>Order Now</button>
                  </a></span>
                </div>
              </div>
            </div>

            <!-- Product 4 -->
            <div class="col-md-3 py-3 py-md-0">
              <div class="card">
                <img src="images/j4.png" alt="">
                <div class="card-body">
                  <h4> Kit Kat Pastries</h4>
                  <div class="star">
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star "></i>
                    <i class="bx bxs-star "></i>
                  </div>
                  <span><a href="test.php?product=Kit Kat Pastriese&price=180&image=images/j4.png">
                    <button>Order Now</button>
                  </a></span>
                </div>
              </div>
            </div>
  
            <!-- Product 5 -->
            <div class="col-md-3 py-3 py-md-0">
              <div class="card">
                <img src="images/j5.png" alt="">
                <div class="card-body">
                  <h4>Kitkat Brownie</h4>
                  <div class="star">
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star "></i>
                    <i class="bx bxs-star "></i>
                  </div>
                  <span><a href="test.php?product=Kitkat Brownie&price=180&image=images/j5.png">
                    <button>Order Now</button>
                  </a></span>
                </div>
              </div>
            </div>

            <!-- Product 6 -->
            <div class="col-md-3 py-3 py-md-0">
              <div class="card">
                <img src="images/j6.png" alt="">
                <div class="card-body">
                  <h4>Chocolate Truffle Kit Kat Cream Cake</h4>
                  <div class="star">
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star "></i>
                    <i class="bx bxs-star "></i>
                  </div>
                  <span><a href="test.php?product=Chocolate Truffle Kit Kat Cream Cake&price=180&image=images/j6.png">
                    <button>Order Now</button>
                  </a></span>
                </div>
              </div>
            </div>

            <!-- Product 7 -->
            <div class="col-md-3 py-3 py-md-0">
              <div class="card">
                <img src="images/j7.png" alt="">
                <div class="card-body">
                  <h4>Choco Chip Truffle N Kit Kat Delight Pastrie</h4>
                  <div class="star">
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star "></i>
                    <i class="bx bxs-star "></i>
                  </div>
                  <span><a href="test.php?product=Choco Chip Truffle N Kit Kat Delight Pastrie&price=180&image=images/j7.png">
                    <button>Order Now</button>
                  </a></span>
                </div>
              </div>
            </div>

            <!-- Product 8 -->
            <div class="col-md-3 py-3 py-md-0">
              <div class="card">
                <img src="images/j8.png" alt="">
                <div class="card-body">
                  <h4>Ferrero Rocher Pinata Cake</h4>
                  <div class="star">
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star checked"></i>
                    <i class="bx bxs-star "></i>
                    <i class="bx bxs-star "></i>
                  </div>
                  <span><a href="test.php?product=Ferrero Rocher Pinata Cake&price=180&image=images/j8.png">
                    <button>Order Now</button>
                  </a></span>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
</body>
</html>