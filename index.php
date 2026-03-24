<?php
include 'db.php';
session_start();

?>
<!DOCTYPE html>
<html >
<head>
    <title> SYSKART</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">    <link rel="stylesheet" type="text/css" href="css/common.css">
    <link href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" rel="stylesheet" >
</head>
<body>

<?php
require 'assets/nav.php';

if (isset($_SESSION["admin"]) && $_SESSION["admin"] == true ){
  include 'admin_product.php';

}
else{
    include 'assets/menu.php';
    include 'product.php';
  
}
?>
<footer class="footer">
        <div class="footer-links">
            <a href="#">About Us</a>
            <a href="#">Careers</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
        </div>
        <div class="footer-copyright">
            © 1996-2023, Amazon.com, Inc. or its affiliates
        </div>
    </footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
 <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js" > </script>
    <script>
        $(document).ready(function () {
    $('#myTable').DataTable();
} );

    </script>
    <script src="js/dropdown.js"></script>
      
    
</body>
</html>
