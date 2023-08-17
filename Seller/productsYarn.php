<!doctype html>
<html lang="en">
  <head>
       <?php include_once("analytic.php") ?>
       
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Custome CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/product.css">

    <link rel="stylesheet" href="../assets/css/seller.css">

    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome CDN-->
    <script src="https://kit.fontawesome.com/fd82d50e73.js" crossorigin="anonymous"></script>
 
    <title>Manchester City - Products - Yarn <?php $title = 'Products'; ?></title>
   
        

  </head>
  <body>
<?php require('header.php'); 

  require('../dbConnect.php'); ?>


<!--**************************************  Main Section ****************************************************************-->

     <main>
       <!-- ********************************* ADD PRODUCT BUTTON  *********************************-->
 
       <div class="subNav" style="display:flex;">
          <div class="loom btn btn-outline-primary" onclick="location.replace('products.php');">Loom</div>
          <div class="yarn btn btn-primary">Yarn</div>
          <div class="mill btn btn-outline-primary" onclick="location.replace('productsMillstore.php');">Mill</div>
      </div>  
                <a href="addProducts.php"><div class="addProductBtn" id = 'addProduct'><i class = "fa fa-plus"></i> Add Products </div></a> 
    
  <!-- ********************************************** Yarn Products *************************************** -->




  <div class = "products">
            <div class = "container">

                <div class = "product-items">
                <?php
    $email = $_SESSION['Selleremail'];
    
    $query = "SELECT * FROM `products` WHERE `email` = '$email' AND `productCat` = 'Yarn'";
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
               $id = $finalRes['id'];
               $productQuantity = $finalRes['ProductQuantity'];
               $actiavtionStatus = $finalRes['activationStatus'];

               require('../discountCount.php');
?>

               <!-- single product -->
               <div class = "product">
               
                   <div class = "product-content">
                   <form action="activation.php" method="POST">
                   <input type="text" hidden value="<?php echo $id; ?>" name="activationId">
                   <?php
                   if($actiavtionStatus == "activated")
                   {

                    ?>
                  <button onclick="document.getElementById('deactivateConfirmBox<?php echo $id;?>').style.display='block';" data-toggle="modal" data-target="#deactivateConfirmBox<?php echo $id;?>" style="position:absolute; top:0; right:0;" type = "button" class = "btn-buy btn btn-outline-danger" value="Deactivate">Deactivate</button>
                    
 

                        <!-- Deactivate Modal -->
                        <div class="modal fade" id="deactivateConfirmBox<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirm to Deactivate....</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                Do you really want to Deactivate this product??
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <input type="submit" name="deactivate" class="btn btn-primary" value="Yes"> 
                              </div>
                            </div>
                          </div>
                        </div>


                    <?php

                   }
                   else
                   {
                    ?>
                  <button onclick="document.getElementById('deactivateConfirmBox<?php echo $id;?>').style.display='block';" data-toggle="modal" data-target="#activateConfirmBox<?php echo $id;?>" style="position:absolute; top:0; right:0;" type = "button"class = "btn-buy btn btn-outline-success" value="Activate">Activate</button>
                  

                       <!-- Activate Modal -->
                       <div class="modal fade" id="activateConfirmBox<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirm to Activate....</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                Do you really want to Activate this product??
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <input type="submit" name="activate" class="btn btn-primary" value="Yes"> 
                              </div>
                            </div>
                          </div>
                        </div>


                    <?php
                 
                  }
                   echo '</form>';
                  
                       echo '<div class = "product-img">';
                           //echo '<img src = "assets/img/yarn/2.jpg" alt = "product image">';
                           echo '<img src="data:image/jpeg;base64,'.base64_encode($productImg ).'" height="200" width="200" class="img-thumnail" />';
                       echo '</div>';
                       echo '<div class = "product-btns">';
                       echo '<form action="editProduct.php" method="POST">';
                       echo '<input type="text" hidden name="id" value="' . $id . '">';
                       echo '<input type="text" hidden name="category" value="' . $productCat . '">';

                          echo '<input type = "submit" name="edit" class = "btn-cart" value=" Edit">';
                          ?>
                          <button type = "button" data-toggle="modal" data-target="#confirmBox<?php echo $id;?>" class = "btn-buy btn btn-outline-danger" onclick="document.getElementById('confirmBox<?php echo $id;?>').style.display='block';" value="Remove">Remove</button>

                        

                        
         
                        <!-- Modal -->
                        <div class="modal fade" id="confirmBox<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirm to Remove....</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                Do you really want to Remove this product??
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <input type="submit" name="remove" class="btn btn-primary" value="Yes"> 
                              </div>
                            </div>
                          </div>
                        </div>



                        <div id="confirmBox<?php echo $id;?>" style="position:absolute; top:0; right:0; left:0; bottom:0; opacity:50%; display:none;">

                        </div>
 
                        <?php

                          echo '</form>';
                       echo '</div>';
                   echo '</div>';

                   echo '<div class = "product-info">';
                       echo '<div class = "product-info-top">';
                           echo '<h2 class = "sm-title">' . $productCat . '</h2>';
                           
                       echo '</div>';
                       echo '<a href = "#" class = "product-name">' . $productDetails . '</a>';
                       echo '<p class = "product-price">' . $productPrice .'</p>';
                       echo '<p class = "product-price">' . $displayPrice.'</p>';
                       echo '<p class = "product-price">' . $productDiscount.'</p>%';
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
       
  <!-- **********************************************  *************************************** -->

 
                        

  </main>
    

<?php require('footer.php'); ?>
  </body>
</html>