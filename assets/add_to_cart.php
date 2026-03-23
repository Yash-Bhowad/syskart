<?php
session_start();

// Always make sure cart is an array
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Simulate product details (replace with real DB or POST later)
$product_id = $_POST['product_id'] ?? null;
$name = $_POST['name'] ?? 'Unknown Product';
$price = $_POST['price'] ?? 0;
$image = $_POST['image'] ?? '';
$description = $_POST['description'] ?? '';
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

if ($product_id === null) {
    echo "Product ID missing!";
    exit;
}

// Check if product already in cart
$found = false;
foreach ($_SESSION['cart'] as $index => $item) {
    if ($item['product_id'] == $product_id) {
        $_SESSION['cart'][$index]['quantity'] += $quantity;
        $found = true;
        break;
    }
}

// Add new item if not found
if (!$found) {
    $_SESSION['cart'][] = [
        'product_id' => $product_id,
        'name' => $name,
        'price' => $price,
        'image' => $image,
        'description' => $description,
        'quantity' => $quantity
    ];
}

// Return total quantity in cart
$total_quantity = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_quantity += $item['quantity'];
}
echo $total_quantity;

?>
