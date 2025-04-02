<?php
// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false];
    
    $index = $_POST['index'] ?? null;
    $action = $_POST['action'] ?? '';
    
    if ($index !== null && isset($_SESSION['cart'][$index])) {
        switch ($action) {
            case 'increase':
                $_SESSION['cart'][$index]['quantity'] += 1;
                $response['success'] = true;
                break;
                
            case 'decrease':
                if ($_SESSION['cart'][$index]['quantity'] > 1) {
                    $_SESSION['cart'][$index]['quantity'] -= 1;
                    $response['success'] = true;
                } else {
                    // Remove if quantity would go to 0
                    array_splice($_SESSION['cart'], $index, 1);
                    $response['success'] = true;
                }
                break;
                
            case 'remove':
                array_splice($_SESSION['cart'], $index, 1);
                $response['success'] = true;
                break;
        }
        
        // Update cart count
        $_SESSION['cart_count'] = count($_SESSION['cart']);
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

// If not POST request, return error
header('Content-Type: application/json');
echo json_encode(['success' => false]);
exit();
?>