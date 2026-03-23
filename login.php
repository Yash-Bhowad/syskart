<?php 
session_start();
include '../partial/_dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['password'];
     

        if (password_verify($password, $storedPassword)) {
            $name = $row['name'];
           
            $name_parts = explode(" ", $name); 
            $first_name = $name_parts[0];
            $_SESSION['username'] = $first_name;
            $_SESSION['loggedin'] = true;
           
            $_SESSION['admin'] = ($row['role'] == 'admin');

            header("Location: ../partial/welcome.php");
            exit();  
        } else {
            $error = "Invalid password. Please try again!";
        }
    } else {
        $error = "No user found with that email!";
    }
}
?>



<!DOCTYPE html>
<html >
<head>

  <title>SYSKART-Login</title>

    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<div class="container">
                    <div >
                        <h2 >Sign In</h2>
                        <?php if(isset($signup)) { ?>
    <div class="success-message"><?php echo $signup; ?></div>
<?php } ?>
                        <?php if(isset($error)) { ?>
    <div class="error-message"><?php echo $error; ?></div>
<?php } ?>

                        <form action="login.php" method ="post">
                          
                            <input type="email" name="email" id="email" placeholder="User Email" required>

                            <input type="password" name="password"  id="password" placeholder="Password" required>
                            
                            <button type="submit" name="submit">Login</button>
                            <p>Don't have an account? <a href="signup.php" id="switch-to-signup">Sign Up</a></p>
</form>
                    </div>
                </div>


    
</body>
</html>