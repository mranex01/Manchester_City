<?php
     require("../dbConnect.php");
    if(isset($_POST['activate']))
    {
       $id = $_POST['activationId'];
        $query = "UPDATE `products` SET `activationStatus` = 'activated' WHERE `id` = '$id'";
        $result = $con->query($query) or $err = mysqli_error($con);
        if(isset($err))
        {
            echo '<script>history.back();</script>';
        }
        else
        {
            echo '<script>alert("Product Activated Successfully");</script>';
            echo '<script>location.replace("products.php");</script>';
        }  
 
    }
    else if(isset($_POST['deactivate']))   
    {
        $id = $_POST['activationId'];
        $query = "UPDATE `products` SET `activationStatus` = 'deactivated' WHERE `id` = '$id'";
        $result = $con->query($query) or $err = mysqli_error($con);
        if(isset($err))
        {
            echo '<script>history.back();</script>';
        }
        else
        {
            echo '<script>alert("Product Deactivated Successfully");</script>';
            echo '<script>location.replace("products.php");</script>';
        }  
 
    }   
    else
    {
        echo "jfr";
        echo '<script>history.back();</script>';
    }
?>