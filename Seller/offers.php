<?php header('location: index.php'); ?>

<!doctype html>
<html lang="en">
  <head>
       <?php include_once("analytic.php") ?>
       
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Custome CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/offers.css">

    <link rel="stylesheet" href="../assets/css/seller.css">

    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome CDN-->
    <script src="https://kit.fontawesome.com/fd82d50e73.js" crossorigin="anonymous"></script>
    
    <title>Manchester City - Offers - Seller <?php $title = 'Offers'; ?></title>

  </head>
  <body>
<?php require('header.php'); ?>

<!--**************************************  Main Section ****************************************************************-->

    <main>
    
    <div class="container-fluid">
       <!-- ********************************* ADD Offers BUTTON  *********************************-->
       <?php
          $email = $_SESSION['Selleremail'];
    
        $query = "SELECT * FROM `offers` WHERE `email` = '$email'";
        $result = $con->query($query) or $err = mysqli_error($con);
        if(!isset($err)) 
        {
            $row = mysqli_num_rows($result);
          if( $row != 0)
          {
              $finalRes = mysqli_fetch_array($result);
            
              $offerTitle = $finalRes['offertitle'];         
              $offerInfo = $finalRes['offerdetails'];
              $offerTime = $finalRes['expirydate'];
              $discount = $finalRes['productdiscount'];
         

                  echo '<div class="card text-center">';
                  echo '<div class="card-body">';
                  echo '<h5 class="card-title">'. $offerTitle;
                  echo '<p class="card-text">'. $offerInfo .'</p>';
                  echo '<p class="card-text">Discount: '. $discount .'%</p>';
                  echo '<form action="removeOffer.php" method="POST">';
                  echo '<input type="text" hidden name = "email" value="' . $email . '">';
                  echo '<button class="btn btn-danger">Remove Offer</button>';
                  echo '</from>';
                  echo '</div>';
                  echo '<div class="card-footer text-muted">';
                  echo 'Expires On.. ' . $offerTime;
                  echo '</div>';
                  echo '</div>    ';
          }
          else
          {
echo "<center><font color='red'>No Offers <br> </font><a href='newOffer.php'><button class='newOffers' id='newofferBtn'>Create New Offer</button></a></center>";
          }
            
        }
            ?>
          </div>
    </main>
    

<?php require('footer.php'); ?>
  </body>
</html>