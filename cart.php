<?php
session_start();

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

// DEBUG: Log session cart to file (for testing only)
file_put_contents("cart_log.txt", "CART ON LOAD: " . json_encode($_SESSION['cart'] ?? []) . PHP_EOL, FILE_APPEND);

// Optional: Prevent overwriting cart if it's already set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = []; // Only initialize if cart doesn't exist
}


$total = 0;
$gst_rate = 0.18;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .cart-item img {
            width: 80px;
            object-fit: contain;
        }
        .qty-control {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }
        .qty-control input {
            width: 50px;
            text-align: center;
        }
    </style>
</head>
<body>
<?php
require 'nav.php';
?>
<div class="container mt-5">
    <h2 class="text-center mb-4">🛒 Your Shopping Cart</h2>

    <?php
  
     if (isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0): ?>
        <!-- <form  class="remove-from-cart-form" action="remove_item.php" method="POST"> -->
            <table class="table table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Description</th>
                        <th>Price (₹)</th>
                        <th>Quantity</th>
                        <th>Subtotal (₹)</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                     foreach ($_SESSION["cart"] as $index => $item): ?>
                        <?php
                            $qty = $item['quantity'] ?? 1;
                            $subtotal = $item['price'] * $qty;
                            $total += $subtotal;
                        ?>
                        <tr class="cart-item">
                            <td><img src="<?= $item['image'] ?>" alt="Product"></td>
                            <td><?= $item['name'] ?></td>
                            <td><?= $item['description'] ?></td>
                            <td><?= $item['price'] ?></td>
                            <td>
                            <form  class="qty-control" action="remove_item.php" method="POST">
                                
                                    <button type="button" data-index="<?= $index ?>" class="btn btn-sm btn-outline-secondary btn-decrease">-</button>
                                    <input type="text" id="quantity" name="quantity[<?= $index ?>]" value="<?= $qty ?>" readonly>
                                    <button type="button" data-index="<?= $index ?>" class="btn btn-sm btn-outline-secondary btn-increase">+</button>
                     </form>
                            </td>
                            <td><?= $subtotal ?></td>
                            <td>
                                
                            <form class="remove-from-cart-form" action="remove_item.php" method="POST">
                <input type="hidden" name="item_index" value="<?= $index ?>">
                <input type="hidden" name="quantity" value="<?= $qty ?>">
                <button class="btn btn-danger btn-sm" type="submit">Remove</button>
            </form>

                                
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <!-- </form> -->

        <?php
        $gst = $total * $gst_rate;
        $grand_total = $total + $gst;
        ?>

<div class="text-end">
    <p><strong>Subtotal:</strong> ₹<span id="subtotal"><?= number_format($total, 2) ?></span></p>
    <p><strong>GST (18%):</strong> ₹<span id="gst"><?= number_format($gst, 2) ?></span></p>
    <h4><strong>Grand Total:</strong> ₹<span id="grandtotal"><?= number_format($grand_total, 2) ?></span></h4>

            <form action="../paymentSystem/proceed_to_checkout.php" method="post">
                <input id="proceedAmount" type="hidden" name="proceedAmount" >
            <button type="submit" class="btn btn-success mt-3" id="proceedToCheckout">Proceed to Checkout</a>
                     </form>
        </div>
        
    <?php else: ?>
        <div class="alert alert-info text-center">Your cart is empty.</div>
        <div class="text-center">
            <a href="welcome.php" class="btn btn-primary">Continue Shopping</a>
        </div>
    <?php endif; ?>
</div>

<script>
window.addEventListener('DOMContentLoaded', updateCartTotals);

    // Remove 
document.querySelectorAll(".remove-from-cart-form").forEach(form => {
    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(form);
        console.log("Submitting remove item request...");
        fetch('remove_item.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            const row = form.closest(".cart-item");
            if (row) {
                row.remove();
                console.log("Row removed.");
            } else {
                console.warn("Row not found.");
            }
            document.getElementById("cart-count").innerText = data;
            updateCartTotals();
        
           
        })
        .catch(error => {
            console.error("Error:", error);
        });
    });
});

function updateCartTotals() {
    let subtotal = 0;
    const gstRate = 0.18;

    document.querySelectorAll(".cart-item").forEach(row => {
        const price = parseFloat(row.children[3].innerText); // Price column
        const quantity = parseInt(row.querySelector("input[type='text']").value); // Quantity input
        const itemSubtotal = price * quantity;

        row.children[5].innerText = itemSubtotal.toFixed(2); // Update item's subtotal
        subtotal += itemSubtotal;
    });

    const gst = subtotal * gstRate;
    const grandTotal = subtotal + gst;

    document.getElementById("subtotal").innerText = subtotal.toFixed(2);
    document.getElementById("gst").innerText = gst.toFixed(2);
    document.getElementById("grandtotal").innerText = grandTotal.toFixed(2);
    document.getElementById("proceedAmount").value = grandTotal.toFixed(2);

    // If no items left, show empty cart message
    if (document.querySelectorAll(".cart-item").length === 0) {
        document.querySelector(".container").innerHTML = `
            <div class="alert alert-info text-center">Your cart is empty.</div>
            <div class="text-center">
                <a href="welcome.php" class="btn btn-primary">Continue Shopping</a>
            </div>`;
    }
}
// decrease quantity
document.querySelectorAll(".btn-decrease").forEach(button =>{
    button.addEventListener("click",function(e){
        
        const input = button.parentNode.querySelector("input");

        let currentQty = parseInt(input.value);

        if (currentQty > 1){
            input.value = currentQty -1 ;
            
        }
        
        updateCartTotals();
        updateCartCount();
    });
});

//increase
document.querySelectorAll(".btn-increase").forEach(button =>{
    button.addEventListener("click",function(e){
        
        const input = button.parentNode.querySelector("input");

        let currentQty = parseInt(input.value);
        if (currentQty > 0){
            input.value = currentQty + 1 ;
        }
        
        updateCartTotals();
        updateCartCount();
    });
});

</script>
<script src="dropdown.js"></script>
<script src="updateCartCount.js"></script>
</body>
</html>
