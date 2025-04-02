<?php
// Start session if not already started (only if included before main file)
$skip_session_start = true;
if (session_status() === PHP_SESSION_NONE && !isset($skip_session_start)) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user_id']);
$cartCount = $_SESSION['cart_count'] ?? 0;
?>

<nav class="navbar navbar-expand-lg navbar-dark" id="main-navbar">
    <div class="container-fluid">
        <!-- Brand Logo -->
        <a class="navbar-brand" href="Mayuri.php" id="logo">
            <img src="images/logo.png" alt="Cake Bakery Logo" width="50" class="d-inline-block align-top">
            <span class="ms-2">Cake Bakery</span>
        </a>
        
        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Main Navigation -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="Mayuri.php#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Mayuri.php#cake">Cakes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Mayuri.php#gallery">Gallery</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Mayuri.php#about">About Us</a>
                </li>
            </ul>
            
            <!-- Right Side Icons -->
            <div class="d-flex align-items-center">
                <?php if($isLoggedIn): ?>
                    <div class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle fa-lg"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user me-2"></i>My Profile</a></li>
                            <li><a class="dropdown-item" href="orders.php"><i class="fas fa-box me-2"></i>My Orders</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="login.php" class="nav-link">
                        <i class="fas fa-user fa-lg"></i>
                    </a>
                <?php endif; ?>
                
                <a href="cart.php" class="nav-link position-relative ms-3">
                    <i class="fas fa-shopping-cart fa-lg"></i>
                    <?php if($cartCount > 0): ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?= $cartCount ?>
                            <span class="visually-hidden">items in cart</span>
                        </span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
#main-navbar {
    background-color: #573818;
    padding: 0.8rem 1rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.navbar-brand {
    font-weight: 700;
    font-size: 1.4rem;
    display: flex;
    align-items: center;
}

.navbar-brand img {
    margin-right: 10px;
}

.nav-link {
    font-weight: 500;
    padding: 0.5rem 1rem;
    transition: all 0.3s;
    position: relative;
    color: white;
}

.nav-link:hover, 
.nav-link:focus {
    color: #fff;
    background-color: rgba(161, 109, 14, 0.8);
    border-radius: 5px;
    transform: translateY(-2px);
}

.nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background: #ffcc00;
    transition: all 0.3s;
    transform: translateX(-50%);
}

.nav-link:hover::after {
    width: 60%;
}

.dropdown-menu {
    border: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    background-color: #573818;
}

.dropdown-item {
    color: white;
    padding: 0.5rem 1.5rem;
    transition: all 0.3s;
}

.dropdown-item:hover {
    background-color: rgba(161, 109, 14, 0.8);
    color: white;
}

.dropdown-divider {
    border-color: rgba(255,255,255,0.1);
}

.badge {
    font-size: 0.7rem;
}

@media (max-width: 992px) {
    .navbar-collapse {
        padding: 1rem 0;
    }
    
    .nav-link {
        padding: 0.5rem 0;
    }
    
    .nav-link::after {
        display: none;
    }
    
    .dropdown-menu {
        background-color: transparent;
        box-shadow: none;
        border: none;
    }
}

@media (max-width: 330px) {
    .navbar-brand {
        font-size: 1rem;
    }
}
</style>