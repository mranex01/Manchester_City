<?php
    require('../dbConnect.php');
    if(isset($_POST['save']))
    {
        session_start();
        $email = $_SESSION['Selleremail'];

        $name = $_POST['name'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $phone = $_POST['phone'];
        $store = $_POST['store'];

        $query = "UPDATE `products` SET `store_name` = '$store' WHERE `email` = '$email'";
        $result = $con->query($query) or $err = mysqli_error($con);
        if(!isset($err))
        {
             
        }

        $query = "UPDATE `sellers` SET `name` = '$name', `address` = '$address', `city` = '$city', `phone` = '$phone', `store_name` = '$store' WHERE `email` = '$email'";
        $result = $con->query($query) or $err = mysqli_error($con);
        if(!isset($err))
        {
            echo "<script>alert('Profile updated successfully!!')</script>";
            echo "<script>location.replace('profile.php');</script>";
        }
        else
        {
            echo $err;
        }
    }
?>        