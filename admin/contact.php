<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Custome CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/contact.css">

    <!-- Slick Slider-->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome CDN-->
    <script src="https://kit.fontawesome.com/fd82d50e73.js" crossorigin="anonymous"></script>

    <title>Manchester City - Admin -Contacts<?php $title="Contact"; ?></title>
  </head>
  <body>
<?php require('header.php'); ?>

<div class="container-fluid">
    <?php 
        $query = "SELECT * FROM `contact`";
        $result = $con->query($query) or  $err = mysqli_error($con);
        if(!isset($err))
        {
          $row  = mysqli_num_rows($result);
          if($row == 0)
          {
            echo "<center><font color='blue'>Nothing to show here</font></center>";
          }
          else
          {
            while($finalRes=mysqli_fetch_array($result))
            {
              $name = $finalRes['name'];
              $email = $finalRes['email'];
              $mssg = $finalRes['mssg'];
              $id  = $finalRes['id'];
  
              echo '<button class="collapsible">' . $name .'</button>';
              
              echo '<div class="content">';
              echo '<form action="removeMssg.php" method="POST">';
              echo '<input type="text" name="id" hidden value="' . $id . '">';
                echo 'Email: ' . $email;
                
                echo '<br><br>';
                echo 'Message: ';
                echo '<p>' . $mssg . '</p>';
              echo '<button name="remove" class =" removeBtn btn btn-outline-danger">Remove</button>';
  
              echo '</div>';
              echo '</form>';
  
            }
          }

        }
      ?>
    
</div>



<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
</script>

<?php require('footer.php'); ?>
</body>
</html>