
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments <?php $title = "Payments"; ?></title>
        <!-- Custome CSS -->
        <link rel="stylesheet" href="../assets/css/adminStyle.css">
    <link rel="stylesheet" href="../assets/css/style.css">

 

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome CDN-->
    <script src="https://kit.fontawesome.com/fd82d50e73.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php require('header.php'); ?>

    <main>
    <div class="tbl-header">
    <table cellpadding="0" cellspacing="0" border="0">
      <thead">
        <tr>
          <th>Sr.</th>
          <th>Invoice Id</th>
          <th>Date</th>
          <th>Customer</th>  
          <th>Seller</th>
          <th>Payed Amount</th>
          <th>Transaction Id</th>
          <th>Status</th>
          <!-- <th>Manage</th> -->
        </tr>
      </thead>
    </table>
  </div>
  <div class="tbl-content">
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody>
        <?php 
          $query = "SELECT * FROM `invoice` WHERE `paymentMethod` = 'online'";
          $result = $con->query($query) or $err = mysqli_error($con);
          if(!isset($err)) 
          {
            $i = 0;
            while($finalRes = mysqli_fetch_array($result))
            {
              $i++;
              $invoiceId = $finalRes['invoiceId'];
              $date = $finalRes['date'];
              $seller = $finalRes['seller'];
              $customer = $finalRes['customer'];
              $payAmount = $finalRes['Totalprice'];  
              $tranId = $finalRes['tranId'];
              $paymentStatus = $finalRes['paymentStatus'];
              echo '<form action="paymentProcess.php" method="POST">';
              
              echo '<tr>';     
                echo '<td>'. $i .'</td>';
                echo '<td>'. $invoiceId .'<input type="text" value="'. $invoiceId .'" name="invoiceId" hidden></td>';
                echo '<td>'. $date .'</td>';
                echo '<td>'. $customer .'</td>';
                echo '<td>'. $seller .'</td>';
                echo '<td>'. $payAmount.'Rs.</td>';
                echo '<td>' . $tranId .'</td>';

                echo '<td>';
                if($paymentStatus == 'Paid')
                {
                  echo '<input type="button" class="btn btn-success" disabled value="Proceeded" name="submitPayment"></td>';
                }
                else
                {
                  echo '<input type="submit" value="Proceed To Order" class="btn btn-primary" name="submitPayment">';
                  echo '<input type="submit" class="btn btn-danger" value="Cancel Order" name="cancelPayment"></td>';
                }
                
              echo '</tr>';
              echo '</form>';

            }
          }


        ?>
         
        
      </tbody>
    </table>
  </div>
</section>


</div>
    </main>
    


    <?php require('footer.php'); ?>
</body>
</html>