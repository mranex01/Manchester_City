<?php
require('../dbConnect.php');
if(isset($_POST["submit"])) 
{
    session_start();
    $email = $_SESSION['Selleremail'];
    $offerTitle = $_POST['offerTitle'];
    $productDiscount = $_POST['productDiscount'];
    $offerDetails = $_POST['offerDetails'];
    $expiryDate = $_POST['expiryDate'];
    

    $query = "DELETE FROM `offers` WHERE `email` = '$email'"; 
    $result = $con->query($query) or $err = mysqli_error($con);


    $query = "INSERT INTO `offers`(`email`, `offertitle`, `productdiscount`, `offerdetails`, `expirydate`) VALUES ('$email', '$offerTitle', '$productDiscount', '$offerDetails', '$expiryDate')"; 
    $result = $con->query($query) or $err = mysqli_error($con);
    if(!isset($err)) 
    {
        echo '<script>alert("Offer set Successfully")</script>';  
        echo '<script>location.replace("offers.php");</script>';  
    }
    else
    {
        echo $err; 
    }
}

?>