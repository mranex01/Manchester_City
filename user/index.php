<!doctype html>
<html lang="en">
  <head>
       <?php include_once("analytic.php") ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Custome CSS -->
    <link rel="stylesheet" href="../assets/css/product.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Slick Slider-->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome CDN-->
    <script src="https://kit.fontawesome.com/fd82d50e73.js" crossorigin="anonymous"></script>
    <title>Manchester City - Home <?php $title = 'Home' ?></title>
  </head>
  <body>
<!--**************************************  Including Header.php ****************************************************************-->
<?php require('header.php'); ?>


<!--**************************************  Main Section****************************************************************-->

    <main>
      <div class="container-fluid  col-sm-8 ">
      <div id="carouselExampleControls" class="carousel slide  " data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="../assets/img/logo.png" class="img-fluid" width="fit-content" alt="...">
          </div>
        <?php
            $query = "SELECT * FROM `ads`";
            $result = $con->query($query) or $err = mysqli_error($con);
            if(!isset($err))
            {
                while($finalRes = mysqli_fetch_array($result))
                {
                  $img = $finalRes['img'];
                  
                  echo '<div class="carousel-item">';
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($img) . '" class="img-fluid" alt="...">';
                  echo '</div>';

                }
            }
        ?>

 
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      </div>



      <hr>

      
     
      <!-------------------------------Categories------------------------------->
      <div class="content-title border-bottom bg-light">Categories</div>
      <div class="container-fluid ">        
        <div class="card-group">
          
          <div class="card category-card m-2 p-2">
            <a href="yarn-category.php" style="text-decoration:none; color:black"> 
            <img class="card-img-top" src="../assets/img/yarn-trading-250x250.png" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Yarn</h5>
              <p class="card-text">Get affordable Yarn Products from trusted suppliesrs.</p>
            </div>
            </a>
          </div>
           
          
          <div class="card category-card m-2 p-2">
            <a href="loom-category.php" style="text-decoration:none; color:black">
            <img class="card-img-top" src="../assets/img/wonderlane-1WyHB_LhxfI-unsplash.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Loom</h5>
              <p class="card-text">Checkout the looms at affordable price and services.</p>
            </div>
            </a>
          </div>
           
          
          <div class="card category-card m-2 p-2">
            <a href="millStore-category.php" style="text-decoration:none; color:black">
            <img class="card-img-top" src="../assets/img/patil-mill-stores-ichalkaranji-zw5kj2rfx0.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Mill Store</h5>
              <p class="card-text">Buy all products of mill store at your affordable price and good service.</p>
            </div>
          </a>
          </div>
           
        </div>
      </div>




      <hr>

      <!-------------------------------Top Products------------------------------->
      
      <div class="content-title border-bottom bg-light">Top Products</div>

      <div class = "products">
            <div class = "container">

                <div class = "product-items">
                <?php
        
        $query = "SELECT * FROM `products`  WHERE `activationStatus` = 'activated' ORDER BY `productDiscount` DESC LIMIT 4";
        $result = $con->query($query) or $err = mysqli_error($con);
            if(!isset($err)) 
            {
                while($finalRes = mysqli_fetch_array($result))
                {
                   $id = $finalRes['id'];
                   $productImg = $finalRes['productImg'];
                   $productName = $finalRes['productName'];
                   $productCat = $finalRes['productCat'];
                   $productPrice = $finalRes['productPrice'];
                   $productDetails = $finalRes['productDetails'];
                   $productDiscount = $finalRes['productDiscount'];
                   $productQuantity = $finalRes['ProductQuantity'];
                   $store = $finalRes['store_name'];
                  require('../discountCount.php');
    
    
    
    
                   //<!-- single product -->
                   echo '<div class = "product">';
                       echo '<div class = "product-content">';
                           echo '<div class = "product-img">';
                               //echo '<img src = "assets/img/yarn/2.jpg" alt = "product image">';
                               echo '<img src="data:image/jpeg;base64,'.base64_encode($productImg ).'" height="200" width="200" class="img-thumnail" />';
                           echo '</div>';

                           echo '<form action="order-product.php" method = "POST">';
                           echo '<input type="text" name = "id" hidden value='. $id . '>';
                           echo '<div class = "product-btns">';

                                echo '<input type="submit" value="Add To Cart" class = "btn-cart" name = "addtocart" id="addtocart">' ;
                             
                                ?>
                                <input type="submit" <?php if($productQuantity <= 0){ echo "disabled"; } ?> value="Buy" class = "btn-buy btn btn-outline-success" name="buy" id="buy">
                             <?php                          
                           echo '</div>';
                           echo '</form>';
                       echo '</div>';
    
                       echo '<div class = "product-info">';
                           echo '<div class = "product-info-top">';
                               echo '<h2 class = "sm-title">' . $productCat . '</h2>';
                               
                           echo '</div>';
                       echo '<p>Store: ' . $store . '</p>';
                       if($productQuantity <= 0){ echo '<p class="product-price"><font color="red"><b>Out Of Stock</b></font>';}

                       echo '<div class = "product-name">' . $productDetails . '</div>';
    
                           echo '<p class = "product-price" style="text-decoration : line-through">' . $productPrice .'</p>';
                           echo '<p class = "product-price">' . $displayPrice.'</p>';
                           echo '<p class = "product-price">' . $productDiscount.'%</p>';
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


      <!-------------------------------Offers------------------------------->
     <!--hr>

      <div class="content-title border-bottom bg-light">Offers</div>
      <div class="container-fluid">
      <?php
           /*
    
        $query = "SELECT * FROM `offers`";
        $result = $con->query($query) or $err = mysqli_error($con);
        if(!isset($err)) 
        {
            $row = mysqli_num_rows($result);
          if( $row != 0)
          {
              while($finalRes = mysqli_fetch_array($result))
              {
                $offerTitle = $finalRes['offertitle'];         
                $offerInfo = $finalRes['offerdetails'];
                $offerTime = $finalRes['expirydate'];
                $discount = $finalRes['productdiscount'];
           
  
                    echo '<div class="card text-center">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">'. $offerTitle;
                    echo '<p class="card-text">'. $offerInfo .'</p>';
                    echo '<p class="card-text">Discount: '. $discount .'%</p>';
                    echo '<a href="allproducts.php"><button class="btn btn-primary">Explore</button></a>';
                    echo '</div>';
                    echo '<div class="card-footer text-muted">';
                    echo 'Expires On.. ' . $offerTime;
                    echo '</div>';
                    echo '</div>    ';
              }
            
              
          }
          else
          {
              echo "<center><font color='blue'>... Coming Soon ...<br> </font></center>";
          }
            
        }
           */ ?>
          
      </div-->




      <hr>

      <!-------------------------------All Products------------------------------->
      <div class="content-title border-bottom bg-light">All Products</div>

      <div class="container-fluid">
      <div class = "products">
            <div class = "container">

                <div class = "product-items">
<?php
        
    $query = "SELECT * FROM `products`  WHERE `activationStatus` = 'activated' LIMIT 8";
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
               $id = $finalRes['id'];
               $store = $finalRes['store_name'];  
              require('../discountCount.php');




               //<!-- single product -->
               echo '<div class = "product">';
                   echo '<div class = "product-content">';
                       echo '<div class = "product-img">';
                           //echo '<img src = "assets/img/yarn/2.jpg" alt = "product image">';
                           echo '<img src="data:image/jpeg;base64,'.base64_encode($productImg ).'" height="200" width="200" class="img-thumnail" />';
                       echo '</div>';
                       echo '<form action="order-product.php" method = "POST">';
                           echo '<input type="text" name = "id" hidden value='. $id . '>';
                           echo '<div class = "product-btns">';

                                echo '<input type="submit" value="Add To Cart" class = "btn-cart" name = "addtocart" id="addtocart">' ;
                             
                                ?>
                                <input type="submit" <?php if($productQuantity <= 0){ echo "disabled"; } ?> value="Buy" class = "btn-buy btn btn-outline-success" name="buy" id="buy">
                             <?php                          
                           echo '</div>';
                           echo '</form>';
                       echo '</div>';
    
                       echo '<div class = "product-info">';
                           echo '<div class = "product-info-top">';
                               echo '<h2 class = "sm-title">' . $productCat . '</h2>';
                               
                           echo '</div>';
                       echo '<p>Store: ' . $store . '</p>';
                       if($productQuantity <= 0){ echo '<p class="product-price"><font color="red"><b>Out Of Stock</b></font>';}
                       echo '<div class = "product-name">' . $productDetails . '</div>';

                       echo '<p class = "product-price" style="text-decoration : line-through">'. $productPrice .'</p>';
                       
                       echo '<p class = "product-price">' . $displayPrice.'</p>';
                       echo '<p class = "product-price">' . $productDiscount.'%</p>';
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
        <div class="m-1 p-1 w-100 border-bottom text-right"><a href="allproducts.php"><button class="btn btn-primary">More...</button></a></div>       
              
       
      </div>
      </div>
    </main>
    <!--**************************************  Including footer.php ****************************************************************-->
<?php require('footer.php'); ?>


  </body>
</html>