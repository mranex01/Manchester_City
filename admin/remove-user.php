<?php
    require('../dbConnect.php');
    if(isset($_POST['remove']))
    {
        echo '<script>if(!window.confirm("Do your really want to Remove this User?")){ location.replace("index.php");}else{}</script>';

        $email = $_POST['email'];

        $query = "DELETE FROM `sellers` WHERE `email` = '$email'";
        $result = $con->query($query) or $err = mysqli_error($con);
        
        $query = "DELETE FROM `products` WHERE `email` = '$email'";
        $result = $con->query($query) or $err = mysqli_error($con);
        if(!isset($err))
        {
            echo '<script>alert("Seller Removed Successfully!!!");</script>';
            echo '<script> location.replace("index.php"); </script>';
        }
        else
        {
            echo $err;
        }
    }
    else if(isset($_POST['remove1']))
    {
        echo '<script>if(!window.confirm("Do your really want to Remove this Seller?")){ location.replace("users.php");}else{}</script>';

        $email = $_POST['email'];

        $query = "DELETE FROM `users` WHERE `email` = '$email'";
        $result = $con->query($query) or $err = mysqli_error($con);
        if(!isset($err))
        {
            echo '<script>alert("User Removed Successfully!!!");</script>';
            echo '<script> location.replace("users.php"); </script>';
        }
        else
        {
            echo $err;
        }
    }      
     else if(isset($_POST['view']))
    {
        $email = $_POST['email'];
        $query1 = "SELECT * FROM `sellers` WHERE `email` = '$email'";
        $result1 = $con->query($query1) or $err1 = mysqli_error($con);
        if(!isset($err1))
        {
            $finalRes = mysqli_fetch_array($result1);
            
            $upi = $finalRes['upi'];
            $storeName = $finalRes['storeName'];
            $adhaar = $finalRes['adhaar'];
            $licence = $finalRes['licence'];
            $passbook = $finalRes['passbook'];
            $name = $finalRes['name'];
            $email = $finalRes['email'];
            $phone = $finalRes['phone'];
            $address = $finalRes['address'];
            $city = $finalRes['city'];
            ?>

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
    <a href="index.php" class="btn btn-primary" style="position:absolute; top:2%; left:2%;">Back</a>
            <div class="container-fluid pt-5">
                <div class="row pt-5">
                    <div class="col bg-light p-2 col-sm-7 col-10 m-auto row">
                        <div class="col col-6 border-bottom p-2">Name: </div><div class="col col-6 border-bottom"><?php echo $name; ?></div>
                        <div class="col col-6 border-bottom p-2">Email: </div><div class="col col-6 border-bottom"><?php echo $email; ?></div>
                        <div class="col col-6 border-bottom p-2">Phone: </div><div class="col col-6 border-bottom"><?php echo $phone; ?></div>
                        <div class="col col-6 border-bottom p-2">Address: </div><div class="col col-6 border-bottom"><?php echo $address; ?></div>
                        <div class="col col-6 border-bottom p-2">City: </div><div class="col col-6 border-bottom"><?php echo $city; ?></div>
                        <div class="col col-6 border-bottom p-2">UPI Id: </div><div class="col col-6 border-bottom"><?php echo $upi; ?></div>
                        <div class="col col-6 border-bottom p-2">Store Name: </div><div class="col col-6 border-bottom"><?php echo $storeName; ?></div>
                    </div>
                    <div class="col col-sm-7 col-10 m-auto">
                        <div class="card-header bg-warning">Adhaar Card: </div>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($adhaar); ?>" width="100%">
                    </div>
                    <div class="col col-sm-7 col-10 m-auto">
                        <div class="card-header bg-warning">Store Licence: </div>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($licence); ?>" width="100%">
                    </div>
                    <div class="col col-sm-7 col-10 m-auto">
                        <div class="card-header bg-warning">Bank Passbook: </div>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($passbook); ?>" width="100%">
                    </div>
                </div>
            </div>
            </body>
            </html>
            
            
            <?php
            
        } }
    else
    {
      echo"<script>alert('Something Went Wrong!!');</script>";
      echo "<script>location.replace('index.php');</script>";
    }
?>