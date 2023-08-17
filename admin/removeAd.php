<?php
    require('../dbConnect.php');
    if(isset($_POST['remove']))
    {
        $id = $_POST['id'];
        $query = "DELETE FROM `ads` WHERE `id` = '$id'";
        $result = $con->query($query) or $err = mysqli_error($con);
        if(!isset($err))
        {
            echo "<script>alert('Ad Removed Successfully!!');</script>";
            echo "<script>location.replace('ads.php');</script>";
        }
        else
        {
            echo $err;
        }
    }
?>