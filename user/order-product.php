<?php require('../dbConnect.php'); 
    if(isset($_POST['addtocart']))
    {
        session_start();
        $customer = $_SESSION['Useremail'];
        $id = $_POST['id']; 
        
    $query1 = "SELECT * FROM `products` WHERE `id` = '$id'";
    $result1 = $con->query($query1) or $err1 = mysqli_error($con);
        if(!isset($err1)) 
        {
            while($finalRes1 = mysqli_fetch_array($result1))
            {
                $productImg = $finalRes1['productImg'];
                $productName = $finalRes1['productName'];
                $productPrice = $finalRes1['productPrice'];
                $store = $finalRes1['store_name'];
            }
        }

        $query = "INSERT INTO `cart`(`id`, `productName`, `productPrice`, `store`, `customer`) VALUES('$id', '$productName', '$productPrice', '$store', '$customer')";
        $result = $con->query($query) or $err = mysqli_error($con);
        if(!isset($err)) 
        {
             echo "<script> alert('Added To Cart'); </script>";
             echo "<script>location.replace('index.php');</script>";
        }
        else
        {
            echo $err;
            //echo "<script> history.back(); </script>";
            
        }
    }
    else
    {
         
        
    
?>





<!doctype html>
<html lang="en">
  <head>
       <?php include_once("analytic.php") ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Custome CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Slick Slider-->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome CDN-->
    <script src="https://kit.fontawesome.com/fd82d50e73.js" crossorigin="anonymous"></script>
    <title>Order Product</title>
  </head>
<body>
    <?php require('header.php'); ?>
    <?php
        $id = $_POST['id'];
         

        $query = "SELECT * FROM `products` WHERE `id` = $id";
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
                   $productId = $finalRes['id'];
                   $sellerEmail = $finalRes['email'];

                   require('../discountCount.php');

                }
            }
            $query = "SELECT * FROM `sellers` WHERE `email` = '$sellerEmail'";
            $result = $con->query($query) or $err = mysqli_error($con);
                if(!isset($err)) 
                {
                    while($finalRes = mysqli_fetch_array($result))
                    {
                        $sellerName = $finalRes['name'];
                        $sellerEmail = $finalRes['email'];
                        $sellerCity = $finalRes['city'];
                        $sellerPhone = $finalRes['phone'];
                        $store = $finalRes['store_name'];
                    }  

                }
    ?>
    <div class="container-fluid p-5">
    <div class="order-product bg-light shadow">
        <div class="row">
            <div class="col-12 col-sm-6">
                <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($productImg ).'"  width="100%" class="img-thumnail" />';?>
            </div>
            <div class="col-12 col-sm-6 mt-1">
                <div class="product-name mt-1" style="font-size: 3vh;"><?php echo $productName; ?></div>
                <div class="product-info mt-1"><?php echo $productDetails; ?></div>
                <div class="seller-info mt-1">Seller :<?php echo $sellerName; ?> <br> Email :<?php echo $sellerEmail; ?> <br> City :<?php echo $sellerCity; ?> <br> Phone :<?php echo $sellerPhone; ?></div>
                <div class="product-rating mt-1"></div>
            </div>
            <div class="col-12 col-sm-6 text-center pt-3">
                    <div class="product-info">Discount: <?php echo $productDiscount; ?>%</div>
            </div>
            <div class="col-12 col-sm-6 mt-1 p-5">
                <form method="post" action="confirm-order.php">
                    <div class="product-prising font-weight-bold">
                        Price 
                        <input type="number" id="productPrice" name="productPrice" hidden  value="<?php echo $productPrice; ?>">
                        <input type="number" id="actualPrice" name="total" hidden  value="<?php echo $displayPrice; ?>">

                        <input type="text" name="id" id="id" hidden value="<?php echo $id; ?>">
                        <input type="text" name="store" id="store" hidden value="<?php echo $store; ?>">


                        <input type="text" id="price" name="price" min="1" max="100000" style="text-align: right; background:none; text-decoration:line-through; border:none; display: inline-block; outline:none;" readonly value="<?php echo $productPrice; ?>">
                        <input type="text" id="actual" name="totalPrice" min="1" max="100000" style="text-align: right; background:none; border:none; display: inline-block; outline:none;" readonly value="<?php echo $displayPrice; ?>">Rs.
                      <br>  
                    </div>
                    <div class="product-quantity font-weight-bold">
                        Quantity 
                        <input onchange="quantityChanged(this)" class="border" type="number" id="quantity" name="quantity" min="1" max="<?php echo $productQuantity; ?>" value="1" style="border:none; outline:none;" required> 
                    </div>
                    Payment Method: <select name="paymentMethod" class="custom-select"><option value="Cash on Delivery">Cash on Delivery</option><option value="Online">Online</option></select>
                    <button class="btn btn-primary mt-2" name="orderNow">Order Now</button>
                </form>
                    <form action="" method="POST"><input type="text" name="id" hidden value="<?php echo $id; ?>"><button class="btn btn-primary mt-2" name="addtocart">Add to Cart</button></form>
            </div>
            
        </div>
    </div>
    </div>

    
    <?php require('footer.php'); ?>
    <script src="../assets/js/script.js"></script>
</body>
</html>
<?php } ?>