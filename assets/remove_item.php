<?php
session_start();

if (isset($_POST['item_index'])) {
    $index = $_POST['item_index'];

    // Safely remove the item from session cart
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);

        // Re-index the cart array to prevent gaps
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }

    // Return new cart count as response
    echo count($_SESSION['cart']);
} else {
    echo "Error: item_index not provided";
}
?>
