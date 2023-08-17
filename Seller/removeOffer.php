<?php
    require('../dbConnect.php');
    $email = $_POST['email'];

    $query = "DELETE FROM `offers` WHERE `email` = '$email'";
    $result = $con->query($query) or $err = mysqli_error($con);
        if(!isset($err)) 
        {
            echo "<script> alert('Offer Removed!!!'); </script>";
            echo "<script> location.replace('offers.php'); </script>";
        }
        else
        {
            //echo $err;
            echo "<script> location.replace('offers.php'); </script>";
        }
?>