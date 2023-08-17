<?php
    require("../dbConnect.php");
    require("../globleVar.php");

    if(isset($_POST['accept']))
    {
 
        $email = $_POST['email'];
        // Inserting Records in seller table...

        $query = "INSERT INTO `sellers`(`name`, `email`, `phone`, `address`, `city`, `password`, `date`,`upi`,`store_name`, `adhaar`, `licence`, `passbook`) SELECT `name`, `email`, `phone`, `address`, `city`, `password`, `date`,`storeName`, `adhaar`, `licence`, `passbook` FROM `sellerregrequest`";
        $result = $con->query($query) or $err = mysqli_error($con);
        

        // Deleting Records from sellerregrequest table

        $query2 = "DELETE FROM `sellerregrequest` WHERE `email` = '$email'";
        $result2 = $con->query($query2) or $err2 = mysqli_error($con);
        if(isset($err2))
        {
            echo $err2;
        }

        //Sending message to seller


        $query3 = "SELECT * FROM `sellers` WHERE `email` = '$email'";
        $result3 = $con->query($query3) or $err3 = mysqli_error($con);
        if(!isset($err3))
        {
            while($finalRes3 = mysqli_fetch_array($result3))
            {
                $name = $finalRes3['name'];
                $email = $finalRes3['email'];
                $phone = $finalRes3['phone'];
                $address = $finalRes3['address'];
                $city = $finalRes3['city'];
                $password = $finalRes3['password'];
            }
        }
   
        
        $fields = array(
            "sender_id" => "TXTIND",
            "message" => "Dear $name , your request to join MANCHESTER CITY has been successfully accepted. Login with email and password. Your password is $password Thank You!!! Team Manchester City...",
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

        echo "<script>location.replace('sellerReq.php');</script>";


    }
    else if(isset($_POST['decline']))
    {
        $email = $_POST['email'];

        $query3 = "SELECT * FROM `sellerregrequest` WHERE `email` = '$email'";
        $result3 = $con->query($query3) or $err3 = mysqli_error($con);
        if(!isset($err3))
        {
            while($finalRes3 = mysqli_fetch_array($result3))
            {
                $name = $finalRes3['name'];
                $email = $finalRes3['email'];
                $phone = $finalRes3['phone'];
                $address = $finalRes3['address'];
                $city = $finalRes3['city'];
            }
        }
        else
        {
            echo $err3;
        }

        //Sending declined message to seller


        $fields = array(
            "sender_id" => "TXTIND",
            "message" => "Dear $name , your request to join MANCHESTER CITY for Seller account has been declined. For any queries kindly contact to 9975268970 or 8308028609. Team Manchester City.",
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
 

            //Deleting record from sellerregrequest table

            $query1 = "DELETE FROM `sellerregrequest` WHERE `email` = '$email'";
            $result1 = $con->query($query1) or $err1 = mysqli_error($con);
    
            if(!isset($err1))
            {
                echo "<script>alert('Request Declined Successfully.');</script>";
            }

        echo "<script>location.replace('sellerReq.php');</script>";

    }
    else if(isset($_POST['verify']))
    {
        $email = $_POST['email'];
        $query1 = "SELECT * FROM `sellerregrequest` WHERE `email` = '$email'";
        $result1 = $con->query($query1) or $err1 = mysqli_error($con);
        if(!isset($err1))
        {
            $finalRes = mysqli_fetch_array($result1);
            
            $upi = $finalRes['upi'];
            $storeName = $finalRes['storeName'];
            $adhaar = $finalRes['adhaar'];
            $licence = $finalRes['licence'];
            $passbook = $finalRes['passbook'];
            $name = $finalRes['name'];
            $email = $finalRes['email'];
            $phone = $finalRes['phone'];
            $address = $finalRes['address'];
            $city = $finalRes['city'];
            ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requests <?php $title = "Requests"; ?></title>
        <!-- Custome CSS -->
        <link rel="stylesheet" href="../assets/css/adminStyle.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome CDN-->
    <script src="https://kit.fontawesome.com/fd82d50e73.js" crossorigin="anonymous"></script>
</head>
<body>
    <a href="sellerReq.php" class="btn btn-primary" style="position:absolute; top:2%; left:2%;">Back</a>
            <div class="container-fluid pt-5">
                <div class="row pt-5">
                    <div class="col bg-light p-2 col-sm-7 col-10 m-auto row">
                        <div class="col col-6 border-bottom p-2">Name: </div><div class="col col-6 border-bottom"><?php echo $name; ?></div>
                        <div class="col col-6 border-bottom p-2">Email: </div><div class="col col-6 border-bottom"><?php echo $email; ?></div>
                        <div class="col col-6 border-bottom p-2">Phone: </div><div class="col col-6 border-bottom"><?php echo $phone; ?></div>
                        <div class="col col-6 border-bottom p-2">Address: </div><div class="col col-6 border-bottom"><?php echo $address; ?></div>
                        <div class="col col-6 border-bottom p-2">City: </div><div class="col col-6 border-bottom"><?php echo $city; ?></div>
                        <div class="col col-6 border-bottom p-2">UPI Id: </div><div class="col col-6 border-bottom"><?php echo $upi; ?></div>
                        <div class="col col-6 border-bottom p-2">Store Name: </div><div class="col col-6 border-bottom"><?php echo $storeName; ?></div>
                    </div>
                    <div class="col col-sm-7 col-10 m-auto">
                        <div class="card-header bg-warning">Adhaar Card: </div>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($adhaar); ?>" width="100%">
                    </div>
                    <div class="col col-sm-7 col-10 m-auto">
                        <div class="card-header bg-warning">Store Licence: </div>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($licence); ?>" width="100%">
                    </div>
                    <div class="col col-sm-7 col-10 m-auto">
                        <div class="card-header bg-warning">Bank Passbook: </div>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($passbook); ?>" width="100%">
                    </div>
                </div>
            </div>
            </body>
            </html>
            
            
            <?php
            
        }
        
    }
    else
    {
        echo '<script>alert("Something Went Wrong!!");</script>';
        echo '<script>location.replace("sellerReq.php");</script>';
    }

?>