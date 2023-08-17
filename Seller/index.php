<!doctype html>
<html lang="en">
  <head>
       <?php include_once("analytic.php") ?>
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
   

    <title>Manchester City - Orders - Seller <?php $title = 'Orders'; ?></title>
  </head>
  <body>
<?php require('header.php'); ?>

<!--**************************************  Main Section ****************************************************************-->

     <main>
      
      <?php 
          $email = $_SESSION['Selleremail'];
          $query = "SELECT distinct(`invoiceId`) FROM `invoice` WHERE `seller` = '$email'"; 
          $result = $con->query($query) or $err = mysqli_error($con);
          
          if(!isset($err))
          {
            $i = 0;
              $row = mysqli_num_rows($result);
              if($row == 0)
              { ?>
                <div class="table-responsive">
        <table class="table" >
      <thead class="thead-dark">
        <tr>
          <th scope="col">Sr.</th>
          <th scope="col">Customer Email</th>
          <th scope="col">Product Name</th>
          <th scope="col">Quantity</th>
          <th scope="col">Total Price</th>
          <th scope="col">Time</th>
          <th scope="col">Status</th>
          <th scope="col">Payment</th>
          <th scope="col">More</th>
        </tr>
      </thead>
      <tbody>
      <?php
                echo "<tr><td><center> No Orders Yet!!! </center></td></tr>";
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
              }
              else
              {
                while($finalRes = mysqli_fetch_array($result))
                {
                  $invoiceId = $finalRes['invoiceId'];

                  $query2 = "SELECT * FROM `invoice` WHERE `invoiceId` = '$invoiceId'";
                  $result2 = $con->query($query2) or $err2 = mysqli_error($con);
                  if(isset($err2))
                  {
                    echo $err2;
                  }
                  else
                  {
                   ?>
                   <div class="table-responsive">
                        <table class="table" > 
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">Sr.</th>
                          <th scope="col">Customer Email</th>
                          <th scope="col">Product Name</th>
                          <th scope="col">Quantity</th>
                          <th scope="col">Price</th>
                          <!-- <th scope="col">Total Price</th>
                          <th scope="col">Time</th>
                          <th scope="col">Status</th>
                          <th scope="col">Payment</th>
                          <th scope="col">More</th> -->
                        </tr>
                      </thead>
                      <tbody>
                    <?php
                    
                     while($finalRes2 = mysqli_fetch_array($result2))
                     {
                        $i++;
                         
                        $item = $finalRes2['item'];
                        $quantity = $finalRes2['quantity'];
                        $Totalprice = $finalRes2['Totalprice'];
                        $date = $finalRes2['date'];
                        $invoiceId = $finalRes2['invoiceId'];
                        $customer = $finalRes2['customer'];
                        $status = $finalRes2['status'];
                        $paymentMethod = $finalRes2['paymentMethod'];
                        $tranId = $finalRes2['tranId'];
                        $rate = $finalRes2['rate'];
                        $paymentStatus = $finalRes2['paymentStatus'];
                        $payAmount = $finalRes2['payAmount'];
                        echo '<form action="showInvoice.php" method="POST">';
                        echo '<input type="text" hidden value="' . $invoiceId . '" name="invoiceId">';
                        echo '<tr>';
                        echo '<th scope="row">' . $i . '</th>';
                        echo '<td>' . $customer . '</td>';
                        echo '<td>' . $item . '</td>';
                        echo '<td>' . $quantity . '</td>';
                        echo '<td>' . $rate .'</td>';
                        
                     }
                        echo '</tr><tr class="bg-warning">';
                        echo '<td><b>Total Price </b> <br> ' . $Totalprice .'</td>';
                        echo '<td><b>Date </b> <br> ' . $date .'</td>';
                        echo '<td><b>Status </b> <br> ';
                        if($status != "Pending...."){ echo "Dispatched"; }else{ echo '<button name="proceed" value="proceed" class="btn btn-primary-light">Dispatch</button>';}
                        if($paymentMethod == "online")
                        {
                          if($paymentStatus == "Paid")
                          {
                            echo '<button class="btn btn-success ml-5" disabled>'. $paymentStatus .'</button>';
                          }
                          else
                          {
                            echo '<button class="btn btn-danger ml-5" disabled>'. $paymentStatus .'</button>';
                          }
                        }
                        echo '</td>';
                  
                        echo '<td><b>Payment Method </b> <br> ' . $paymentMethod .'</td>';
                        
                        //echo '<td>' . $date .'</td>';
                        //echo '<td>' . $date .'</td>';
                        echo '<td><button class="btn btn-outline-info" name="view">View Details</button>';
                        echo '<button class="btn btn-outline-danger" name="remove">Remove</button></td>';

                        echo '</tr>';

                        echo '</form>';
                          echo '</tbody>';
                          echo '</table>';
                          echo '</div>';
                  }


                  
                }
              }
              
          }

      ?>
    
 
         
     </main>
    <?php require('footer.php'); ?>

  </body>
</html>