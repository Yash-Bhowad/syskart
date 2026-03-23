// updateCartCount.js
document.addEventListener("DOMContentLoaded", function () {
    updateCartCount();
});

function updateCartCount() {
    fetch("cart_count.php")
        .then(response => response.text())
        .then(count => {
            document.getElementById("cart-count").innerText = count;
        })
        .catch(error => {
            console.error("Cart count fetch error:", error);
        });
}
