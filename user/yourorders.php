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
    <title>Manchester City - Your Orders <?php $title = 'Your Orders' ?></title>
  </head>
  <body>
<!--**************************************  Including Header.php ****************************************************************-->
<?php require('header.php'); ?>

<!--************************************** Main ****************************************************************-->

<main>
      
      <?php 
          $user = $_SESSION['Useremail'];
          $query = "SELECT distinct(`invoiceId`) FROM `invoice` WHERE `customer` = '$user'";
          $result = $con->query($query) or $err = mysqli_error($con);
          if(isset($err))
          {
            echo $err;
          } 
          $r = mysqli_num_rows($result);
          if($r<=0)
          {
              echo "<center>No orders yet!!</center>";
          }
          while($finalRes = mysqli_fetch_array($result))
          {
            $invoiceId = $finalRes['invoiceId'];

            $query1 = "SELECT *  FROM `invoice` WHERE `invoiceId` = '$invoiceId'"; 
            $result1 = $con->query($query1) or $err1 = mysqli_error($con);
            
            if(!isset($err1))
              {
                $i = 0;
                $row = mysqli_num_rows($result1);
                
                if($row <= 0)
                {
                  echo "<center> No Orders Yet!!! </center>";
                }
                else
                {
                  ?>

                <div class="table-responsive">  
                        <table class="table" >
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">Sr.</th>
                          <th scope="col">Product Name</th>
                          <th scope="col">Quantity</th>
                          <th scope="col">Price</th>
                          <!-- <th scope="col">Time</th>
                          <th scope="col">Status</th>   
                          <th scope="col">More</th> -->
                        </tr>
                      </thead>
                      <tbody>

                  <?php
                  $rowspan = mysqli_num_rows($result1);
                  
           
                  while($finalRes1 = mysqli_fetch_array($result1))
                  {

                      
                    $i++;
                    //  $name = $finalRes['name'];
                    $item = $finalRes1['item'];
                    $quantity = $finalRes1['quantity'];
                    $Totalprice = $finalRes1['Totalprice'];
                    $date = $finalRes1['date'];
                    $invoiceId = $finalRes1['invoiceId'];
                    $status = $finalRes1['status'];
                    $price = $finalRes1['rate'];
                    echo '<form action="showInvoice.php" method="POST">';
                    echo '<input type="text" hidden value="' . $invoiceId . '" name="invoiceId">';
                    echo '<tr>';
                    echo '<th scope="row">' . $i . '</th>';
                    echo '<td>' . $item . '</td>';
                    echo '<td>' . $quantity . '</td>';
                    echo '<td>' . $price .'</td>';
                    


                  }
                  echo '</tr><tr class="bg-light">';
                  echo '<td><b>Date</b><br>' . $date .'</td>';
                  echo '<td><b>Status</b><br>';
                   if($status != "Proceeded")
                   {
                   echo "<input type='submit' class='btn btn-outline-danger'  name='remove' value='Cancel Order'><font color='red'>";}
                   else if($status == "Proceeded"){echo "<font color='green'>";} 
                   echo $status;
                   echo '</td>';
                  echo '<td><b>Total Price</b><br>' . $Totalprice  .'</td>';
                  echo '<td><button class="btn btn-outline-info" name="view">View Details</button></td>';
                  echo '</tr>';
                  echo '</form>';
                  echo '</tbody>';
                  echo '</table>';
                } 
              }
            }

      ?>
    

        </div>
         
     </main>




   <!--**************************************  Including footer.php ****************************************************************-->
<?php require('footer.php'); ?>
      </body>
    </html>