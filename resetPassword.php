<?php
    require("dbConnect.php");

    if(isset($_POST['resetBtn']))
    {
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $role = $_POST['role'];
 
            $query = "UPDATE `$role` SET `password` = '$password' WHERE `email` = '$email'";
            $result = $con->query($query) or $err = mysqli_error($result);
            if(!isset($err))
            {
                echo "<script>alert('Password Reset Successfully!!');</script>";
                if($role == "users")
                {
                    echo "<script>location.replace('loginRegister.php');</script>";
                }
                else
                {
                    echo "<script>location.replace('loginRegister.php');</script>";
                }
            }
    
    }
?>