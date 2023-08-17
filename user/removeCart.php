<?php
    require('../dbConnect.php');
    $id = $_POST['id'];

    $query = "DELETE FROM `cart` WHERE `id` = $id";
    $result = $con->query($query) or $err = mysqli_error($con);
        if(!isset($err)) 
        {
            echo "<script> alert('Cart Removed!!!'); </script>";
            echo "<script> location.replace('cart.php'); </script>";
        }
        else
        {
            echo "<script> location.replace('cart.php'); </script>";
        }
?>