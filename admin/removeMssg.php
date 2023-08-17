<?php
    if(isset($_POST['remove']))
    {
        require('../dbConnect.php');
        $id = $_POST['id'];

        echo '<script>if(!window.confirm("Do your really want to Remove this Message?")){ location.replace("contact.php");}else{}</script>';

        $query = "DELETE FROM `contact` WHERE `id` = '$id'";
        $result = $con->query($query) or  $err = mysqli_error($con);

        if(!isset($err))
        {
            echo '<script>alert("Message Deleted Successfully!!");</script>';
            echo '<script>location.replace("contact.php")</script>';
        }
        else
        {
            echo $err;
        }
    }
    else
    {
        echo "ok";
    }
?>