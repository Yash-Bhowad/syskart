<?php
include 'db.php';
?>
<?php
if(isset($_GET["q"])){
    $q= $_GET["q"];
    $query_parts = explode("+",$q);

    $search_query =implode(" ",$query_parts); ;

}

?>
<?php

    if(isset($_GET["category"])){
        $category = $_GET["category"];
        // echo 'yes selected category is'.$category;
        // exit();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/common.css">
</head>
<body>
<!-- <form  id="myForm" class="add-to-product-form" action="welcome.php" method="POST">
<input type="hidden" id="categorySet" name="categorySet" >
</form> -->

<!-- <div class="alert alert-danger" role="alert">
 Stock is empty For Men Printed Polo Neck Polyester Pink T-Shirt
</div> -->
<?php
if(isset($category)){
    if(isset($search_query)){
        $sql = "SELECT * FROM `products` WHERE MATCH (`name`, `description`) against ('$search_query')";
        // $result = mysqli_query($conn,$sql);
        // $num = mysqli_num_rows($result);
    }
else{
    $sql = "SELECT * FROM `products` WHERE `category`='$category'";
    // $result = mysqli_query($conn,$sql);
    // $num = mysqli_num_rows($result);
}
}
else{
    if(isset($search_query)){
        $sql = "SELECT * FROM `products` WHERE MATCH (`name`, `description`) against ('$search_query')";
        // $result = mysqli_query($conn,$sql);
        // $num = mysqli_num_rows($result);
    }else{
        $sql = "SELECT * FROM `products`";
// $result = mysqli_query($conn,$sql);
// $num = mysqli_num_rows($result);
    }
}
$result = mysqli_query($conn,$sql);
$num = mysqli_num_rows($result);
if($num>0){
    echo ' 
    <div class="container">
    <div class="product-grid" >';
   
        while($row = mysqli_fetch_assoc($result)){
            $image= $row['image_url'] ;
            $name= $row['name'] ;
            $description= $row['description'] ;
            $price = $row['price']  ;
            $product_id = $row['product_id']  ;
           

            echo'
           <div class="product-card">
           <form class="add-to-cart-form" action="add_to_cart.php" method="POST">
            <img src="'.$image.'" style="width:100px; height:auto;" >
                            <h3 class="product-title">'.$name.'</h3>
                             <p class="product-description">'.$description.'</p>
                            <div class="product-price">'.$price.'</div>
                             <input type="hidden" name="product_id" id="productId" value="'.$product_id.'">
                            <input type="hidden" name="name" value="'.$name.'">
                            <input type="hidden" name="price" value="'.$price.'">
                            <input type="hidden" name="image" value="'.$image.'">
                            <input type="hidden" name="description" value="'.$description.'">
                            <input type="hidden" name="quantity" value="1" min="1">
                            <button type="submit" class="btn-primary" id="addToCart">Add to Cart</button>
</form>
                            
                            </div>

            ';
        }
       
  

        echo '</div>
        </div>';

}

?>



<script>
               
                
    // let categories = document.getElementsByClassName("category");
    // let categorySet = document.getElementById('categorySet'); // Select hidden input
    // let myForm = document.getElementById('myForm'); // Select form

    // Array.from(categories).forEach((element) => {
    //     element.addEventListener("click", (e) => {
    //         let category = e.currentTarget.innerText.trim(); // Get button text
    //         categorySet.value = category; // Set hidden input value
           
    //         console.log("Selected category:", category);
            
    //         myForm.submit(); // Now submit the form programmatically
    //     });
    // });
    
                document.querySelectorAll(".add-to-cart-form").forEach(form=>{
                    form.addEventListener("submit",function(e){
                        e.preventDefault();

                       const formData = new FormData(form);
                       fetch('assets/add_to_cart.php',
                        { method: 'POST', body: formData })
                        .then(response=>response.text())
                        .then(data=>{
                            console.log("Server says:",data);
                            // Update the cart count directly from server response
    document.getElementById("cart-count").innerText = data;
                            // updateCartCount();


                        })
                        .catch(error => {
                            console.error('Error:', error);
                    })}
                )
                })
                
            
                
            </script>
            <script src="js/updateCartCount.js"></script>
</body>
</html>