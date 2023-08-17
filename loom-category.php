<!doctype html>
<html lang="en">
  <head> 
  <?php include_once("analytic.php") ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Custome CSS -->
    <link rel="stylesheet" href="assets/css/product.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Slick Slider-->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome CDN-->

        <script src="https://kit.fontawesome.com/fd82d50e73.js" crossorigin="anonymous"></script>

    <title>Manchester City - Loom <?php $title = 'Categories    ' ?></title>
  </head>
  <body>
<!--**************************************  Including Header.php ****************************************************************-->
<?php require('header.php'); ?>

<!--************************************** BreadCrumb ****************************************************************-->
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="categories.php">Categories</a></li>
    <li class="breadcrumb-item active" aria-current="page">Loom</li>
    </ol>
    </nav>

    <main>
    <div class="container-fluid">
      <div class = "products">
            <div class = "container">

                <div class = "product-items">
<?php
        
    $query = "SELECT * FROM `products` WHERE `productCat` = 'Loom' and `activationStatus` = 'activated'";
    $result = $con->query($query) or $err = mysqli_error($con);
        if(!isset($err)) 
        {
            while($finalRes = mysqli_fetch_array($result))
            {
               $productImg = $finalRes['productImg'];
               $productName = $finalRes['productName'];
               $productCat = $finalRes['productCat'];
               $productPrice = $finalRes['productPrice'];
               $productDetails = $finalRes['productDetails'];
               $productDiscount = $finalRes['productDiscount'];
               $productQuantity = $finalRes['ProductQuantity'];
               $store = $finalRes['store_name'];

               require('discountCount.php');


               //<!-- single product -->
               echo '<div class = "product">';
                   echo '<div class = "product-content">';
                       echo '<div class = "product-img">';
                           //echo '<img src = "assets/img/yarn/2.jpg" alt = "product image">';
                           echo '<img src="data:image/jpeg;base64,'.base64_encode($productImg ).'" height="200" width="200" class="img-thumnail" />';
                       echo '</div>';
                       echo '<div class = "product-btns">';
                           echo '<button type = "button" data-toggle="modal" data-target="#exampleModalCenter" class = "btn-cart"> Add To Card' ;
                              
                           echo '</button>';
                           echo '<button type = "button" data-toggle="modal" data-target="#exampleModalCenter" class = "btn-buy btn btn-outline-success">Buy';
                               
                           echo '</button>';
                       echo '</div>';
                   echo '</div>';

                   echo '<div class = "product-info">';
                       echo '<div class = "product-info-top">';
                           echo '<h2 class = "sm-title">' . $productCat . '</h2>';
                           
                       echo '</div>';
                       echo '<div class = "product-name">' . $productDetails . '</div>';
                       echo '<p class = "product-price">' . $productPrice .'</p>';
                       echo '<p class = "product-price">' . $displayPrice.'</p>';
                       echo '<p class = "product-price">' . $productDiscount.'%</p>';
                       echo '<p>Store: ' . $store . '</p>';
                       echo ' </div>';  
               echo '</div>';
               //<!-- end of single product -->




            }
        }
        else
        {
            echo "<script> alert('$err'); </script>"; 
        }
  ?>


                </div>
            </div>
        </div>
      </div>
    </main>
<!--**************************************  Including footer.php ****************************************************************-->
<?php require('footer.php'); ?>
  </body>
</html>
