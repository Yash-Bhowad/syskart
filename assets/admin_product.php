<?php
include '_dbconnect.php';
if(($_SERVER['REQUEST_METHOD'])=='POST'){
    // echo "Form is submitted using POST method.<br>";
    if(isset($_POST["productIdEdit"])){
        // echo 'yes';
        // exit();
        $productId = $_POST["productIdEdit"];
        $image = $_POST['imageEdit'];
    $title = $_POST['titleEdit'];
    $description = $_POST['descriptionEdit'];
    $price = $_POST['priceEdit'];
    $category = $_POST['categoryEdit'];
    $sql = "UPDATE `products` SET `name` = '$title', `price` = '$price', `image_url` = '$image', `description` = '$description', `category` = '$category' WHERE `products`.`product_id` = '$productId';";
    $result = mysqli_query($conn,$sql);
    }elseif(isset($_POST["product-Id-Remove"])){
// echo 'Remove';
$productId = $_POST["product-Id-Remove"];
$sql ="DELETE FROM  `products` WHERE `products`.`product_id` = '$productId';";
$result = mysqli_query($conn,$sql);
    }else{
    $image = $_POST['image_url'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $sql = "INSERT INTO `products` (`name`, `description`, `price`, `image_url`,`category`) VALUES ('$title','$description','$price','$image','$category')";
    $result = mysqli_query($conn,$sql);}}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
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
      <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<form class="add-to-product-form" action="welcome.php" method="POST">
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <input type="hidden" id="productIdEdit" name="productIdEdit" >
      <input type="text" id="imageEdit" name="imageEdit" placeholder="image">
        <input type="text"id="titleEdit"  name="titleEdit" placeholder="title">
        <input type="text" id="descriptionEdit"  name="descriptionEdit" placeholder="description">
        <input type="text" id="priceEdit"  name="priceEdit" placeholder="price">
        <input type="text" id="categoryEdit"  name="categoryEdit" placeholder="category">
   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Update changes</button>
      </div>
    </div>
  </div>
</div>
</form>
<div class="container mt-2">
<h2 class="text-center mb-4">Add New Product</h2>
<table class="table table-bordered text-center align-middle ">
              <thead class="table-dark">
                  <tr>
                      <th>Image</th>
                      <th>Product</th>
                      <th>Description</th>
                      <th>Price (₹)</th>
                      <th>Category</th>
                      <th>Add</th>
                      
                  </tr>
              </thead>
              <tbody>
              <tr class="cart-item">
              <form class="add-to-product-form" action="welcome.php" method="POST">
                            <td><input type="text" name="image_url" placeholder="image"></td>
                            <td><input type="text" name="title" placeholder="title"></td>
                            <td><input type="text" name="description" placeholder="description"></td>
                            <td><input type="text" name="price" placeholder="price"></td>
                            <td><input type="text" name="category" placeholder="category"></td>
                            <td><button class="btn btn-danger btn-sm" type="submit">Add</button></td>
    </form>
                             </tr>
                             </tbody>
            </table>
            </div>  

<?php
 echo ' 
 <div class="container mt-2">
  <h2 class="text-center mb-4">Edit or Remove Existing Product</h2>
   <table id="myTable" class="table table-bordered text-center align-middle display">
              <thead class="table-dark">
                  <tr>
                  <th>Product ID</th>
                      <th>Image</th>
                      <th>Product</th>
                      <th>Description</th>
                      <th>Price (₹)</th>
                      <th>Category</th>
                      <th>Edit</th>
                      <th>Remove</th>
                      
                  </tr>
              </thead>
              <tbody>
                     
  ';
$sql = "SELECT * FROM `products`";
$result = mysqli_query($conn,$sql);
$num = mysqli_num_rows($result);
if($num>0){
   

        while($row = mysqli_fetch_assoc($result)){
            $image= $row['image_url'] ;
            $name= $row['name'] ;
            $description= $row['description'] ;
            $price = $row['price']  ;
            $product_id = $row['product_id']  ;
            $category= $row['category']  ;
        
        echo '
                 <tr class="cart-item">
                            <td>'.$product_id .'</td>
                            <td><img src="'. $image .'" alt="Product"></td>
                            <td>'.$name .'</td>
                            <td>'.$description .'</td>
                            <td>'. $price.'</td>
                            <td>'. $category.'</td>

                            <td><button class="edit btn btn-danger btn-sm" class="'.$row["product_id"].'" >Edit</button></td>
                             
                            <form class="remove-from-product-form" action="welcome.php" method="POST">

                            <input type="hidden" name="product-Id-Remove" value="'.$product_id.'">
                            <td><button type=submit class="remove btn btn-danger btn-sm" >Remove</button></td>
                            
                            </form>
                             </tr>
        ';
    }}
    echo '
    </tbody>
            </table>
            </div>
    ';
?>
                         
<script>
    edits = document.getElementsByClassName("edit");
    Array.from(edits).forEach((element)=>{
        element.addEventListener("click",(e)=>{
            console.log("edit",);
            tr = e.target.parentNode.parentNode;
            productId = tr.getElementsByTagName("td")[0].innerText;
            image = tr.getElementsByTagName("td")[1].innerText;
            title = tr.getElementsByTagName("td")[2].innerText;
            description = tr.getElementsByTagName("td")[3].innerText;
            price = tr.getElementsByTagName("td")[4].innerText;
            category = tr.getElementsByTagName("td")[5].innerText;
            
            imageEdit.value=image;
            titleEdit.value= title;
            descriptionEdit.value=description;
            priceEdit.value=price;
            categoryEdit.value=category;
            productIdEdit.value=productId;
            console.log(productIdEdit);
            $("#editModal").modal("toggle");
        })
    })
    document.querySelectorAll(".remove-from-product-form").forEach(form => {
    form.addEventListener("submit", function (e) {
        e.preventDefault();

        if(confirm("Are you want to remove this product")){
            console.log("yes");
        const formData = new FormData(form);
        fetch('welcome.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            const row = form.closest(".cart-item");
            
                row.remove();
        })
        .catch(error => {
            console.error("Error:", error);
        });
    }else{
                console.log("no");
            } 
    });
});

    
    </script>

       
</body>
</html>
