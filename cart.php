<?php
// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include header
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your existing head content -->
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - Cake Bakery</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .cart-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 15px;
            min-height: calc(100vh - 120px);
        }
        .cart-item {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            overflow: hidden;
        }
        .cart-item-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }
        .quantity-control {
            display: flex;
            align-items: center;
        }
        .quantity-btn {
            width: 30px;
            height: 30px;
            border: 1px solid #ddd;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
        .quantity-input {
            width: 50px;
            text-align: center;
            margin: 0 5px;
        }
        .empty-cart {
            text-align: center;
            padding: 50px 0;
        }
        
        /* Footer Styles */
        footer {
            background-color: #343a40;
            color: white;
            padding: 40px 0 20px;
        }
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }
        .footer-section h5 {
            color: #fff;
            margin-bottom: 20px;
            font-size: 18px;
            position: relative;
            padding-bottom: 10px;
        }
        .footer-section h5::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 2px;
            background: #d50000;
        }
        .footer-section ul {
            list-style: none;
            padding: 0;
        }
        .footer-section ul li {
            margin-bottom: 10px;
        }
        .footer-section ul li a {
            color: #adb5bd;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .footer-section ul li a:hover {
            color: #d50000;
            padding-left: 5px;
        }
        .social-icons a {
            display: inline-block;
            color: white;
            background: rgba(255,255,255,0.1);
            width: 36px;
            height: 36px;
            border-radius: 50%;
            text-align: center;
            line-height: 36px;
            margin-right: 10px;
            transition: all 0.3s ease;
        }
        .social-icons a:hover {
            background: #d50000;
            color: white;
            transform: translateY(-3px);
        }
        .copyright {
            text-align: center;
            padding-top: 20px;
            margin-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: #adb5bd;
            font-size: 14px;
        }
    </style>
</head>
</head>
<body>
    <div class="cart-container">
        <h2>Your Shopping Cart</h2>
        
        <?php if (empty($_SESSION['cart'])): ?>
            <!-- Empty cart message -->
        <?php else: ?>
            <div class="row">
                <div class="col-md-8">
                    <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                        <div class="cart-item p-3 d-flex">
                            <div class="flex-shrink-0">
                                <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="cart-item-image">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5><?= htmlspecialchars($item['name']) ?></h5>
                                <p class="mb-1">Weight: <?= htmlspecialchars($item['weight']) ?></p>
                                <p class="mb-1">Price: ₹<?= number_format($item['price'], 2) ?></p>
                                <?php if (!empty($item['message'])): ?>
                                    <p class="mb-1">Message: <?= htmlspecialchars($item['message']) ?></p>
                                <?php endif; ?>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <div class="quantity-control">
                                        <button class="quantity-btn minus" data-index="<?= $index ?>">-</button>
                                        <input type="text" class="quantity-input" value="<?= $item['quantity'] ?>" readonly>
                                        <button class="quantity-btn plus" data-index="<?= $index ?>">+</button>
                                    </div>
                                    <div>
                                        <span class="fw-bold">₹<?= number_format($item['price'] * $item['quantity'], 2) ?></span>
                                    </div>
                                </div>
                                <button class="btn btn-link text-danger remove-item" data-index="<?= $index ?>">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order Summary</h5>
                            <hr>
                            <?php
                            $subtotal = 0;
                            foreach ($_SESSION['cart'] as $item) {
                                $subtotal += $item['price'] * $item['quantity'];
                            }
                            $delivery = 50; // Example delivery charge
                            $total = $subtotal + $delivery;
                            ?>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span>₹<?= number_format($subtotal, 2) ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Delivery</span>
                                <span>₹<?= number_format($delivery, 2) ?></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold">
                                <span>Total</span>
                                <span>₹<?= number_format($total, 2) ?></span>
                            </div>
                            <a href="checkout.php" class="btn btn-danger w-100 mt-3">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Quantity controls
        document.querySelectorAll('.quantity-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const index = this.dataset.index;
                const isPlus = this.classList.contains('plus');
                
                fetch('update_cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `index=${index}&action=${isPlus ? 'increase' : 'decrease'}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            });
        });
        
        // Remove item
        document.querySelectorAll('.remove-item').forEach(btn => {
            btn.addEventListener('click', function() {
                const index = this.dataset.index;
                
                fetch('update_cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `index=${index}&action=remove`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            });
        });
    </script>
</body>
</html>