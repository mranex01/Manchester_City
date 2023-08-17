<?php
    require('globleVar.php');
    require('dbConnect.php');
    if(isset($_POST['varify']))
    {
     
        $email = $_POST['email'];
        $otp = rand(1000, 9000);
        $role = $_POST['role'];

        if($role == "User")
        {
            $role = "users";
        }
        else if($role == "Seller")
        {
            $role = "sellers";
        }

        $query = "SELECT * FROM `$role` WHERE `email` = '$email'";
        $result = $con->query($query) or $err = mysqli_error($con);
        if(mysqli_num_rows($result) <= 0)
        {
            echo "<script>alert('Account not found...');</script>";
            echo "<script>history.back();</script>";

        }
        else
        {
            $finalRes = mysqli_fetch_array($result);
            $phone = $finalRes['phone'];
        }



        $fields = array(
            "sender_id" => "TXTIND",
            "message" => "Your One Time Code for password reset is $otp",
            "route" => "v3",
            "numbers" => "$phone",
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

                    
            //  if ($err) {
            //    echo "cURL Error #:" . $err;
            //  } else {
            //    echo $response;
            //  }
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!-- <title>Seller - Profile</title> -->
            <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <!-- Google Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
        <!-- Bootstrap core CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
        <style>
            .forgotPass
            {
                position: absolute;
                top:50%;
                left:50%;
                transform:translate(-50%, -50%);
                /* background:#BCBAE8; */
                padding:20px 50px;
                box-shadow:black 2px 1px 15px;
         
            }
             .title
             {
                 border-bottom:1px solid black;
                 margin:30px;
             }
            .closeBtn
            {
                position:fixed;
                right:0;
                top:0;
                padding:5px;
                background:red;
                color:white;
                cursor:pointer;
                transition:0.6s;
            }
            .closeBtn:hover
            {
                background:white;
                color:red;
            }
            
            input[type="tel"], input[type="text"]
            {
                border:none;
                background:none;
                border-bottom:0.6px solid gray;
                margin:10px;
                outline:none;
                color:white;
            }
            input[type="tel"], input[type="text"]::placeholder
            {
                color:white;
            }
            .tooltiptext 
            {
                visibility: hidden;
                width: 120px;
                background-color: black;
                color: #fff;
                text-align: center;
                border-radius: 6px;
                padding: 5px 0;
                position: absolute;
                z-index: 1;
                top: -5px;
                right: 110%;
            }
        
            .tooltiptext 
            {
                visibility: visible;
            }
            #ResetPassword
            {
                position: absolute;
                top:50%;
                left:50%;
                transform:translate(-50%, -50%);
                
                padding:20px 50px;
                display:none;
                box-shadow:black 2px 1px 15px;
            }
            #resetBtn
            {
                display:none;
            }
            input[type="password"]
            {
                outline:none;
                background:none;
                border:none;
                border-bottom:1px solid gray;
                margin:10px;
                color:white;
            }
            input[type="password"]::placeholder
            {
                color:white;   
            }
        </style>
        <script>
            function varify()
            {
                var otp1 = document.getElementById('EnteredOtp').value;
                var otp2 = document.getElementById('GivenOtp').value;

                if(otp1 == otp2)
                {
                    document.getElementById('ResetPassword').style.display="block";
                    document.getElementById('forgotPass').style.display="none";
                }
                else
                {
                    alert("Invalid Otp");
                }
            }

            function checkPass()
            {
                var pass1 = document.getElementById('pass').value;
                var pass2 = document.getElementById('Confpass').value;

                if(pass1 == pass2)
                {
                    document.getElementById('Confpass').style.borderColor="red";
                    document.getElementById('resetBtn').style.display="block";
                }
                else
                {
                    document.getElementById('Confpass').style.borderColor="red";
                    document.getElementById('resetBtn').style.display="none";
                }
            }
        </script>
        </head>
        <body class="bg-light">
        
            <div class="container">
                <div class="forgotPass bg-primary text-white" id="forgotPass">
                <div class="title">OTP Sent to your mobile number</div>
                <div class="closeBtn" onclick="location.replace('loginRegister.php');">X</div>
                <!-- <form action="varifyMob.php" onsubmit="" method="POST"> -->
                            <input type="text" name="GivenOtp" id="GivenOtp" hidden value="<?php echo $otp; ?>">
                    <br> <input type="text" id="EnteredOtp" name="EnteredOtp" placeholder="Enter OTP" required/> <br>
                    <input type="submit" onclick="varify();" value="Varify" name="varifyOTP" class="btn btn-light">
                <!-- </form> -->
                </div>

                <div id="ResetPassword" class="bg-primary text-white">
                    <div class="title">Reset Password</div>
                    <div class="closeBtn" onclick="location.replace('loginRegister.php');">X</div>
                    <form action="resetPassword.php" onsubmit="" method="POST">
                    <input type="text" name="email" id="email" hidden value="<?php echo $email; ?>">
                    <input type="text" name="role" id="role" hidden value="<?php echo $role; ?>">
                        <input type="password" name="pass" id="pass" placeholder="Enter a New Password.." required>
                        <br> <input oninput="checkPass();" type="password" name="Confpass" id="Confpass" placeholder="Confirm New Password.." required> <br>
                        <input type="submit" onclick="varify();" value="Reset Password" name="resetBtn" id="resetBtn" class="btn btn-light">
                    </form>
                </div>
            </div>
              
        </body>
        </html>





<?php
    }
          
?>