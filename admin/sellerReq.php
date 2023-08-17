
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requests <?php $title = "Requests"; ?></title>
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
          <th>Email</th>
          <th>Name</th>
          <th>Address</th>  
          <th>City</th>
          <th>Mobile</th>
          <th>Date</th>
          <th>Other</th>
        </tr>
      </thead>
    </table>
  </div>
  <div class="tbl-content">
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody>
        <?php 
          $query = "SELECT * FROM `sellerregrequest`";
          $result = $con->query($query) or $err = mysqli_error($con);
          if(mysqli_num_rows($result) <= 0)
          {
            echo "<tr><td colspan='7'>No Requests Yet!!!</td></tr>";
          }
          if(!isset($err)) 
          {
            $i = 0;
            while($finalRes = mysqli_fetch_array($result))
            {
              $i++;
              $date = $finalRes['date'];
              $name = $finalRes['name'];
              $email = $finalRes['email'];
              $address = $finalRes['address'];
              $city = $finalRes['city'];  
              $phone = $finalRes['phone'];
              
              echo '<form action="sellerReqProcess.php" method="POST">';
              
              echo '<tr>';     
                echo '<td>'. $i .'</td>';
                echo '<td>'. $email .'<input type="text" value="'. $email .'" name="email" hidden></td>';
                echo '<td>'. $name .'</td>';
                echo '<td>'. $address .'</td>';
                echo '<td>'. $city .'</td>';
                echo '<td>'. $phone.'</td>';
                echo '<td>' . $date .'</td>';

                echo '<td>';
                  echo '<input type="submit" value="Verify Documents" class="btn btn-success mb-1" name="verify">';
                  echo '<input type="submit" value="Accept" class="btn btn-primary mr-1" name="accept">';
                  echo '<input type="submit" value="Decline" class="btn btn-danger" name="decline"></td>';
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