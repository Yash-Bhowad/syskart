<?php
// checkout.php
session_start();
if(!isset($_SESSION['loggedin'])){
  header("Location:../loginsystem/login.php");
exit();
}
// Example: you already calculated total from cart
$total_amount = $_POST['proceedAmount']; // ₹500 (replace with dynamic value)
$amount_paisa = $total_amount * 100; // Razorpay needs paisa
?>

<!DOCTYPE html>
<html>
<head>
  <title>Checkout - SYSKART</title>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
  <h2>SYSKART - Checkout</h2>
  <p>Total to Pay: ₹<?php echo $total_amount; ?></p>
  <form action="payment_success.php" method="POST">
    <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="rzp_test_aV8TX8JPEUbnxJ" 
        data-amount="<?php echo $amount_paisa; ?>"
        data-currency="INR"
        data-name="SYSKART"
        data-description="Order Payment"
        data-image=""
        data-prefill.name="Yash"
        data-prefill.email=""
        data-theme.color="#528FF0">
    </script>
    <input type="hidden" custom="Hidden Element" name="hidden">
  </form>
  <script src="Payment.js"></script>
</body>
</html>
