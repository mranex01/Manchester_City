<?php
    require('dbConnect.php');
    
    if(isset($_POST['login']))
    {
        $EnteredEmail = $_POST['email'];
        $EnteredPassword = $_POST['password'];



        // if($EnteredEmail == "Admin@gmail.com")
        // {
        //     session_start();
        //     $_SESSION['AdminSession'] = $EnteredEmail;

        //     header('location: admin/index.php');
        // }
        // else
        // {
        //     echo "<script>alert('ok');</script>";
        // }
        
         $query2 = "SELECT * FROM `sellerregrequest` WHERE `email` = '$EnteredEmail'";
         $result2 = $con->query($query2) or $err = mysqli_error($con);
  
    


        $query = "SELECT * FROM `sellers` WHERE `email` = '$EnteredEmail' AND `password` = '$EnteredPassword'";


        $result = $con->query($query) or $err = mysqli_error($con);
        if(!isset($err))
        {
            if(mysqli_num_rows($result) > 0)
            {
                $finalRes = mysqli_fetch_array($result);
                //echo $finalRes['name'];
                $email = $finalRes['email'];
                $password = $finalRes['password'];
                $name = $finalRes['name'];

                session_start();
                $_SESSION['Selleremail'] = $email;

                header('location: Seller/index.php');
     

            }
            else if($EnteredEmail == "jafar2542002@gmail.com" && $EnteredPassword == "iamadmin")
            {
                session_start();
                 $_SESSION['AdminSession'] = $EnteredEmail;

                header('location: admin/index.php');
            }
            else if(mysqli_num_rows($result2) > 0)
            {
                echo "<script>alert('Your Account Registration is in progress...');</script>";
                echo "<script>history.back();</script>";
            }
            else
            {
                session_start();
                $_SESSION['alert'] = "Invalid Email";

                //echo "<script> location.replace('login.php'); </script>";
                
                header('location: sellerLogin.php');
            }
        }
        else
        {
            session_start();
            $_SESSION['alert'] = "Invalid Email";

            //echo "<script> location.replace('login.php'); </script>";
            
            header('location: SellerLogin.php');
        }
    }
    else if(isset($_POST['register']))
    {
        $EnteredEmail = $_POST['email'];
        $EnteredName = $_POST['name'];
       
        $EnteredAddress = $_POST['address'];
        $EnteredCity = $_POST['city'];
        $EnteredPhone = $_POST['phone'];

        $checkRequestQuery = "SELECT * FROM `sellerregrequest` WHERE `email` = '$EnteredEmail'";
        $checkResult = $con->query($checkRequestQuery) or $err = mysqli_error($con);
        // if(!isset($err))
        // {
        //     if(mysqli_num_rows($result2) > 0)
        //     {

        //     }
        // }


        $query = "SELECT * FROM `sellers` WHERE `email` = '$EnteredEmail'";
        $result = $con->query($query) or $err = mysqli_error($con);
        
        if(!isset($err))
        {
            if(mysqli_num_rows($result) > 0)
            {
                session_start();
                $_SESSION['alert'] = "Email Already Exist";

                //echo "<script> location.replace('login.php'); </script>";
                
                header('location: SellerLogin.php');
            }
            else if(mysqli_num_rows($checkResult) > 0)
            {
                echo "<script>alert('Your Account Registration is in progress...');</script>";
                echo "<script>history.back();</script>";
            }
            else
            {
                function randomPassword() {
                    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                    $pass = array(); //remember to declare $pass as an array
                    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                    for ($i = 0; $i < 8; $i++) {
                        $n = rand(0, $alphaLength);
                        $pass[] = $alphabet[$n];
                    }
                    return implode($pass); //turn the array into a string
                }

                $pass = randomPassword();


                $query = "INSERT INTO `sellerregrequest` (`email`, `password`, `name`, `address`, `city`, `phone`) VALUES ('$EnteredEmail', '$pass', '$EnteredName', '$EnteredAddress', '$EnteredCity', '$EnteredPhone')";
                $result = $con->query($query) or $err = mysqli_error($con);
                if(!isset($err))
                {
                    echo "<script> alert('Registered Successfully, Your password will be sent as early as possible!!!'); </script>";
                    echo "<script>location.replace('index.php');</script>";
                    //header('location: index.php');
                }
                else
                {
                    session_start();
                    $_SESSION['alert'] = "Invalid Details $err";
    
                    //echo "<script> location.replace('login.php'); </script>";
                    
                    header('location: SellerLogin.php');
                }
            }
        }
        else
        {
            session_start();
            $_SESSION['alert'] = "Invalid Email";

            //echo "<script> location.replace('login.php'); </script>";
            
            header('location: SellerLogin.php');
        }
    }
    else
    {
        session_start();
        $_SESSION['alert'] = "Invalid Details";

        //echo "<script> location.replace('login.php'); </script>";
        
        header('location: SellerLogin.php');
    }
    
?>