<!doctype html>
<html lang="en">
  <head>
       <?php include_once("analytic.php") ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Custome CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <link rel="stylesheet" href="../assets/css/seller.css">

    <!-- Slick Slider-->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome CDN-->
    <script src="https://kit.fontawesome.com/fd82d50e73.js" crossorigin="anonymous"></script>

    <title>Manchester City - All Products - Seller<?php $title = 'All Products'; ?></title>
  </head>
  <body>
<?php require('header.php'); ?>

<!--**************************************  Main Section ****************************************************************-->

     <main>
     <div class="table-responsive">
        <table class="table" >
      <thead class="thead-dark">
        <tr>
          <th scope="col">Sr.</th>
          <th scope="col">Product Name</th>
          <th scope="col">Product Details</th>
          <th scope="col">Quantity</th>
          <th scope="col">Price</th>
          <th scope="col">Discount</th>
        
          <th scope="col">More</th>
        </tr>
      </thead>
      <tbody>
      <?php 
      require('../dbConnect.php');
          $email = $_SESSION['Selleremail'];
          $query = "SELECT * FROM `products` WHERE `email` = '$email'"; 
          $result = $con->query($query) or $err = mysqli_error($con);
          
          if(!isset($err))
          {
                $i = 1;
              $row = mysqli_num_rows($result);
              if($row <= 0)
              {          
      
                echo "<tr><td><center> You haven't added any product yet.. </center></td></tr>";
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
              }
              else
              {
                    while($finalRes = mysqli_fetch_array($result))
                    {
                        $productName = $finalRes['productName'];
                        $productCat = $finalRes['productCat'];
                        $productPrice = $finalRes['productPrice'];
                        $productDetails = $finalRes['productDetails'];
                        $ProductQuantity = $finalRes['ProductQuantity'];
                        $productDiscount = $finalRes['productDiscount'];
                        $activationStatus = $finalRes['activationStatus'];
                        $id = $finalRes['id'];
                
                
                        
                        echo '<tr>';
                        echo '<input type="text" hidden value="' . $id . '" name="id">';
                        echo '<th scope="row">' . $i . '</th>';
                        echo '<td>' . $productName . '</td>';
                        echo '<td>' . $productDetails . '</td>';
                        echo '<td>' . $ProductQuantity . '</td>';
                        echo '<td>' . $productPrice .'</td>';
                        echo '<td>' . $productDiscount .'</td>';
                         
                        echo '<td><form action="editProduct.php" method="POST">';                                                   
                        echo '<input type="text" value="' . $id . '" hidden name="id">';
                        echo '<input type="text" value="' . $productCat . '" hidden name="category">';
                        echo '<input class="btn btn-primary" type="submit" name="edit" value="Edit"></form></td>';
                        echo '</tr>';
                        $i++;

                    }
                        
                }
   
            }
            else
            {
                echo $err;
            }
     
      ?>
    </tbody>
    </table>
    </div>
 
         
     </main>
    <?php require('footer.php'); ?>

  </body>
</html>