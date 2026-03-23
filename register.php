<?php 
include '../partial/_dbconnect.php';
session_start();
if(($_SERVER['REQUEST_METHOD'])=='POST'){
  
    $email = $_POST['email'];
    $sql = "SELECT * FROM `users` WHERE `email` = '$email' ";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    if($num==1){
      $_SESSION['signup'] = false;
    $error = "Invalid username or password. Please try again!
    This username is already exist.";
}
else{
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $address = array("flat"=>$_POST['flat'],"city"=>$_POST['city'],"state"=>$_POST['state'],"zipcode"=>$_POST['zipcode']);
  $input_address = implode(",",$address);
   $password = $_POST['password'];
   $cpassword =  $_POST['cpassword'];
   if($password == $cpassword){
     $hash = password_hash($password, PASSWORD_DEFAULT);
     $sql = "INSERT INTO `users` (`name`, `email`, `password`, `phone`, `address`) VALUES ('$name', '$email', '$hash', '$phone', '$input_address');";
     $result = mysqli_query($conn,$sql);
     $_SESSION['signup'] = true;
     $signup = "You are Successfully Registered !!";
     header("Location: login.php");
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SYSKART-Signup</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="container">
                    <div >
                        <h2 >Sign Up</h2>
                        <?php if(isset($error)) { ?>
    <div class="error-message"><?php echo $error; ?></div>
<?php } ?>
<form action="signup.php" method ="post">
                          
                            <input type="text" name="name" id="name" placeholder="Full Name" minlength="5" maxlength="50" required>

                            <div class="address-row">
                              <input type="text" name="flat" id="address" placeholder="Flat/Building" autocomplete="address-level2">
                              <input type="text" name="city" id="city" placeholder="City" autocomplete="address-level2">
                              <input type="text" name="state" id="state" placeholder="State" autocomplete="address-level1">
                              <input type="text" name="zipcode" id="zipcode" placeholder="Zipcode" autocomplete="postal-code" minlength="5" maxlength="6">
                            </div>

                            <input type="tel" name="phone" id="phone" placeholder="Mobile No." maxlength="10" required>

                            <input type="email" name="email" id="email" placeholder="Email" minlength="5" maxlength="30" required>

                            <input type="password" name="password"  id="password" placeholder="Password" minlength="8" maxlength="30" required>
                             <input type="password" name="cpassword"  id="cpassword" placeholder="Confirm Password" minlength="8" maxlength="30" required>
                            
                            <button type="submit" name="submit">signup</button>
                            <p>If already have an account? <a href="login.php" id="switch-to-login">Sign In</a></p>
</form>
                        </div>

<script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


</body>
</html>