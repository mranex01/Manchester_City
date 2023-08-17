<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Custome CSS -->
    <link rel="stylesheet" href="../assets/css/adminStyle.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Slick Slider-->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome CDN-->
    <script src="https://kit.fontawesome.com/75e161d596.js" crossorigin="anonymous"></script>

    <title>Manchester City - Admin<?php $title="Users"; ?></title>
  </head>
  <body>
<?php require('header.php'); ?>
<!--**************************************  Main Section****************************************************************-->

    <main>
    <div class="tbl-header">
    <table cellpadding="0" cellspacing="0" border="0">
      <thead">
        <tr>
          <th>Sr.</th>
          <th>Name</th>  
          <th>Address</th>
          <th>City</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Password</th>
          <th>Manage</th>
        </tr>
      </thead>
    </table>
  </div>
  <div class="tbl-content">
    <table cellpadding="0" cellspacing="0" border="0">
      <tbody>
        <?php 
          $query = "SELECT * FROM `users`";
          $result = $con->query($query) or $err = mysqli_error($con);
          if(!isset($err)) 
          {
            $i = 0;
            while($finalRes = mysqli_fetch_array($result))
            {
              $i++;
              $name = $finalRes['name'];
              $address = $finalRes['address'];
              $email = $finalRes['email'];
              $phone = $finalRes['phone'];
              $password = $finalRes['password'];
              $city = $finalRes['city'];

              echo '<form action="remove-user.php" method="POST">';
              echo '<input type="text" hidden value="'. $email .'" name="email">';
              echo '<tr>';     
                echo '<td>'. $i .'</td>';
                echo '<td>'. $name .'</td>';
                echo '<td>'. $address .'</td>';
                echo '<td>'. $city .'</td>';
                echo '<td>'. $phone .'</td>';
                echo '<td>'. $email.'</td>';
                echo '<td>' . $password .'</td>';
                echo '<td><input type="submit" value="Remove User" class = "btn btn-outline-danger" name="remove1"></td>';
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