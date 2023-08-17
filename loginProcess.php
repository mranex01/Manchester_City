<?php
    require('dbConnect.php');
    
    if(isset($_POST['login']))
    {
        $EnteredEmail = $_POST['email'];
        $EnteredPassword = $_POST['password'];

        // Checking if user is customer/////////////////////////////////////////////////////////////////////

        $query = "SELECT * FROM `users` WHERE `email` = '$EnteredEmail' AND `password` = '$EnteredPassword'";
        $result = $con->query($query) or $err = mysqli_error($con);
        if(!isset($err))
        {
            if(mysqli_num_rows($result) > 0)
            {
                $finalRes = mysqli_fetch_array($result);
                //echo $finalRes['name'];
                $email = $finalRes['email'];
                $password = $finalRes['password'];

                session_start();
                $_SESSION['Useremail'] = $email;
                header('location: user/index.php');
            }
            else 
            {
                // CHecking if user is seller ////////////////////////////////////////////////////////////////////////////

                $query = "SELECT * FROM `sellers` WHERE `email` = '$EnteredEmail' AND `password` = '$EnteredPassword'";
                $result = $con->query($query) or $err = mysqli_error($con);
                if(!isset($err))
                {
                    if(mysqli_num_rows($result) > 0)
                    {
                        $finalRes = mysqli_fetch_array($result);
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
                    else
                    {
                        session_start();
                        $_SESSION['alert'] = "Invalid Email2";
        
                        header('location: loginRegister.php#login');
                    }
                }
            }
        }
        else
        {
            session_start();
            $_SESSION['alert'] = "Invalid Email3";

            header('location: loginRegister.php#login');
        }
    }
    else if(isset($_POST['register']))
    {
        if(isset($_POST['conditions']))
        {
            // Seller Registration //////////////////////////

            $email = $_POST['email'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $phone = $_POST['phone'];
            $storeName = $_POST['storeName'];
            $upi = $_POST['upi'];
            $fileAdhaar = addslashes(file_get_contents($_FILES['adhaar']["tmp_name"]));
            $fileLicence = addslashes(file_get_contents($_FILES['licence']["tmp_name"]));
            $filePassbook = addslashes(file_get_contents($_FILES['passbook']["tmp_name"]));
    
            $checkRequestQuery = "SELECT * FROM `sellerregrequest` WHERE `email` = '$email'";
            $checkResult = $con->query($checkRequestQuery) or $err = mysqli_error($con);
            $query = "SELECT * FROM `sellers` WHERE `email` = '$EnteredEmail'";
            $result = $con->query($query) or $err = mysqli_error($con);
            
            if(!isset($err))
            {
                if(mysqli_num_rows($result) > 0)
                {
                    session_start();
                    $_SESSION['alert'] = "Email Already Exist";
                    header('location: loginRegister.php#sellerRegister');
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
                        for ($i = 0; $i < 8; $i++) 
                        {
                            $n = rand(0, $alphaLength);
                            $pass[] = $alphabet[$n];
                        }
                        return implode($pass); //turn the array into a string
                    }
                    $pass = randomPassword();
    
                    $query = "INSERT INTO `sellerregrequest` (`email`, `password`, `name`,`storeName`,`upi`, `address`, `city`, `phone`,`adhaar`,`licence`,`passbook`) VALUES ('$email', '$pass', '$name','$storeName','$upi', '$address', '$city', '$phone','$fileAdhaar','$fileLicence','$filePassbook')";
                    $result = $con->query($query) or $err = mysqli_error($con);
                    if(!isset($err))
                    {
                        echo "<script> alert('Registered Successfully, We will verify your profile as early as possible!! Team Manchester City'); </script>";
                        echo "<script>location.replace('index.php');</script>";
                        //header('location: index.php');
                    }
                    else
                    {
                        session_start();
                        $_SESSION['alert'] = "Invalid Details $err";
        
                        //echo "<script> location.replace('login.php'); </script>";
                          
                        header('location: loginRegister.php#sellerRegister');
                    }
                }
            }
            else
            {
                session_start();
                $_SESSION['alert'] = "Invalid Email";
    
                header('location: loginRegister.php#sellerRegister');
            }
        }
        else
        {
            // User Register /////////////////////////////////////////////////////
            $EnteredEmail = $_POST['email'];
            $EnteredName = $_POST['name'];
            $EnteredPass = $_POST['password'];
            $EnteredAddress = $_POST['address'];
            $EnteredCity = $_POST['city'];
            $EnteredPhone = $_POST['phone'];

            $query = "SELECT * FROM `users` WHERE `email` = '$EnteredEmail'";
            $result = $con->query($query) or $err = mysqli_error($con);
            if(!isset($err))
            {
                if(mysqli_num_rows($result) > 0)
                {
                    session_start();
                    $_SESSION['alert'] = "Email Already Exist";

                    header('location: loginRegister.php#userRegister');
                }
                else
                {
                    $query = "INSERT INTO `users` (`email`, `password`, `name`, `address`, `city`, `phone`) VALUES ('$EnteredEmail', '$EnteredPass', '$EnteredName', '$EnteredAddress', '$EnteredCity', '$EnteredPhone')";
                    $result = $con->query($query) or $err = mysqli_error($con);
                    if(!isset($err))
                    {


                        $fields = array(
                        "sender_id" => "TXTIND",
                        "message" => "Dear $EnteredName , Thank you for joining Manchestetr City, Now you can explore many products with discounts. Team Manchester City!!",
                        "route" => "v3",
                        "numbers" => "EnteredPhone",
                        );
                    
                        $curl = curl_init();
                    
                        curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => json_encode($fields),
                        CURLOPT_HTTPHEADER => array(
                        "authorization: $APIkey",
                        "accept: */*",
                        "cache-control: no-cache",
                        "content-type: application/json"
                        ),
                        ));
                    
                        $response = curl_exec($curl);
                        $err = curl_error($curl);
                    
                        curl_close($curl);
                    
                        //if ($err) {
                          //echo "cURL Error #:" . $err;
                        //} else {
                        //echo $response;
                        //}
                        
                            echo "<script> alert('Registered Successfully!!!'); </script>";

                            echo "<script>location.replace('loginRegister.php#userRegister');</script>";
                    }
                    else
                    {
                        session_start();
                        $_SESSION['alert'] = "Invalid Details";
                        
                        //echo "<script> location.replace('login.php'); </script>";
                        
                        header('location: loginRegister.php#userRegister');
                    }
                }
            }
            else
            {
                session_start();
                $_SESSION['alert'] = "Invalid Email";
                header('location: loginRegister.php#userRegister');
            }
        }       
    }
    else
    {
        session_start();
        $_SESSION['alert'] = "Invalid Details!!";

        //echo "<script> location.replace('login.php'); </script>";
        
        header('location: loginRegister.php#userRegister');
    }
?>