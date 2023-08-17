<?php
    require('../dbConnect.php');
    if(isset($_POST['save']))
    {
        session_start();
        $email = $_SESSION['Useremail'];

        $name = $_POST['name'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $phone = $_POST['phone'];
 
        $query = "UPDATE `users` SET `name` = '$name', `address` = '$address', `city` = '$city', `phone` = '$phone' WHERE `email` = '$email'";
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