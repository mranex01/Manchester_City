<!doctype html>
<html lang="en">
  <head>
       <?php include_once("analytic.php") ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Custome CSS -->
    <link rel="stylesheet" href="../assets/css/addProducts.css">

    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome CDN-->
    <script src="https://kit.fontawesome.com/fd82d50e73.js" crossorigin="anonymous"></script>
    
    <title>Manchester City - New Offer</title>

  </head>
  <body>
  <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page"><a href="offers.php" style="text-decoration:none;">Back</a></li>
  </ol>
</nav>
<div class="container-fluid">
<div class="addContainer">
        <form action = "newOfferProcess.php" method="POST">        
            <div class="row text-center">

                <div class="col-sm-6 col-12 my-3">
                    Offer Title:
                </div>
                <div class="col-sm-6 col-12 my-3">
                    <input type="text" name="offerTitle" id="offerTitle" required>
                </div>  

                <div class="col-sm-6 col-12 my-3">
                    Discount on Products:
                </div>
                <div class="col-sm-6 col-12 my-3">
                    <input type="number" name="productDiscount" id="productDiscount" required>
                </div>

                <div class="col-sm-6 col-12 my-3">
                    Offer Details:
                </div>
                <div class="col-sm-6 col-12 my-3">
                    <textarea name="offerDetails" id="offerDetails" cols="20" rows="4"></textarea>
                </div>

                <div class="col-sm-6 col-12 my-3">
                    Expires On:
                </div>
                <div class="col-sm-6 col-12 my-3">
                    <input type="date" name="expiryDate" id="expiryDate">
                </div>


                <div class="col-12">
                    <input type="submit" name="submit" id = "submit" value="Set This Offer">
                </div>
            </div>
        </form>
    </div>
</div>

  </body>
</html>