<?php
  if(isset($_POST['remove']))
  {
     
    require('../dbConnect.php');
    $id = $_POST['id'];

    $query = "DELETE FROM `cart` WHERE `id` = $id";
    $result = $con->query($query) or $err = mysqli_error($con);
        if(!isset($err)) 
        {
            echo "<script> alert('Cart Removed!!!'); </script>";
            echo "<script> location.replace('cart.php'); </script>";
        }
        else
        {
            echo "<script> location.replace('cart.php'); </script>";
        }

  }
  else if(isset($_POST['view']))
  {
    $id = $_POST['id'];
    
     
  }
  else
  {
    echo "<script> location.replace('cart.php'); </script>";
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
     <?php include_once("analytic.php") ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <!-- CSS -->
    <link href="../assets/css/showCarts.css" rel="stylesheet">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/fd82d50e73.js" crossorigin="anonymous"></script>

</head>
<body>
    <?php require('../dbConnect.php');

        $query = "SELECT * FROM `products` WHERE `id` = $id";
        $result = $con->query($query) or $err = mysqli_error($con);
            if(!isset($err)) 
            {
              $row = mysqli_num_rows($result);
              if($row == 0)
              {
                echo "<script>alert('This Cart Currently Unavailable');</script>";
                echo "<script>location.replace('cart.php');</script>";
              }

               $finalRes = mysqli_fetch_array($result);
                   $productImg = $finalRes['productImg'];
                   $productName = $finalRes['productName'];
                   $productCat = $finalRes['productCat'];
                   $productPrice = $finalRes['productPrice'];
                   $productDetails = $finalRes['productDetails'];
                   $productDiscount = $finalRes['productDiscount'];
                   $productQuantity = $finalRes['ProductQuantity'];
                   $productId = $finalRes['id'];
                   $store = $finalRes['store_name'];
            }
    ?>    

<main class="container">
<a href="cart.php"><div class="closeBtn"><i class="fa fa-times-circle" aria-hidden="true"></i></div></a>

<div class="left-column">
    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($productImg ).'" alt="loading..."/>';  ?>
</div>

<div class="right-column">
<?php if($productQuantity <=0){ echo '<font color="red"><b>Out of Stock</b></font>';} ?>
<h3><?php echo $store; ?></h3>
  <div class="product-description">
    <span><?php echo $productCat; ?></span>
    <h1><?php echo $productName; ?></h1>
    <p><?php echo $productDetails; ?></p>
  </div>

  <!-- Product Configuration -->
  <div class="product-configuration">


    <!-- Cable Configuration -->
    <div class="cable-config">
      <span><?php echo $productDiscount; ?>% Discount</span>

    </div>
  </div>

  <!-- Product Pricing -->
  <div class="product-price">
    <span><?php echo $productPrice; ?>Rs.</span>
    <form action="order-product.php" method="POST">
    <input type="text" name="id" hidden value="<?php echo $id; ?>">                
    <input type="submit" <?php if($productQuantity <= 0){ echo "disabled"; } ?> value="Buy This" name="buy" class="btn btn-outline-success"> 
    </form>
  </div>
  <br>
  <form action="showCarts.php" method="POST">
  <input type="text" name="id" id="id" hidden value="<?php echo $id; ?>">
  <input type="submit" name="remove" value="Remove From Cart" class="btn btn-outline-danger">
  </form>
</div>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" charset="utf-8"></script>
    <script src="../assets/js/script.js" charset="utf-8"></script>
</body>
</html>