<?php
    if(isset($_POST['submit']))
    {
        require('../dbConnect.php');
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mssg = $_POST['mssg'];

        $query = "INSERT INTO `contact` (`name`, `email`, `mssg`) VALUES('$name', '$email', '$mssg')";
        $result = $con->query($query) or  $err = mysqli_error($con);

        if(!isset($err))
        {
            echo '<script>alert("Contact Form Submitted Successfully");</script>';
            echo '<script>location.replace("contactus.php")</script>';
        }
        else
        {
            echo $err;
        }
    }

?>