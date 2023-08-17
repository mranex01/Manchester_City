<?php
require ("../dbConnect.php");
ob_start(); 
    session_start();
    if(!isset($_SESSION['Selleremail']))
    {  
        echo "<script>location.replace('../sellerLogin.php');</script>";
        //ob_end_clean();
    }  
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <?php include_once("analytic.php") ?>
     
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Seller - Profile</title> -->
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/fd82d50e73.js" crossorigin="anonymous"></script>
<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<!-- Bootstrap core CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
<style>
    .backBtn
    {
        z-index:9999;
        position:absolute;
        top:5%;
        left:5%;
        border:none;
        background:"black";
        color:#33B5E5;
        border:1px solid #33B5E5;
        padding:10px;
        border-radius:5px;
        cursor:pointer;
    }
    .backBtn:hover
    {
        background-color:"#33B5E5";
        color:white;
    }
    .logout
    {
        position:absolute;
        right:0;
        z-index:9999;
        padding:10px;
        cursor:pointer;
    }
    .logout .tooltiptext 
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

    .logout:hover .tooltiptext 
    {
        visibility: visible;
    }
</style>
</head>
<body class="bg-light">
    <?php 
        // session_start();
        $email = $_SESSION['Selleremail'];

        $query = "SELECT * FROM `sellers` WHERE `email` = '$email'";
        $result = $con->query($query) or $err = mysqli_error($con);
        if(isset($err))
        {
            echo "<script>alert('Something went wrong!!!');</script>";
            session_destroy();
            echo "<script>location.replace('../login.php');</script>";
            
        }
        $finalRes = mysqli_fetch_array($result);
        $name = $finalRes['name'];
        $email = $finalRes['email'];
        $address = $finalRes['address'];
        $city = $finalRes['city'];
        $phone = $finalRes['phone'];
        $store = $finalRes['store_name'];
    ?>
                <a onclick="history.back();"><div class="backBtn">Back</div></a>

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10 mt-5 pt-5">
                <div class="row z-depth-3">
        <a href="logout.php"><div class="logout"><i class="fas fa-sign-out-alt"></i><span class="tooltiptext">Logout</span></div></a>

                    <div class="col sm-4 bg-info rounded-left">
                        <div class="card-block text-center text-white ">
                            <i class="fas fa-user-tie fa-7x mt-5"></i>
                            <h2 class="font-weight-bold mt-4"><?php echo $name; ?></h2>
                            <p>Seller</p>
                            <a href="editProfile.php"><i class="far fa-edit fa-2x mb-4"></i></a>
                        </div>
                    </div>

                    <div class="col-sm-8 bg-white rounded-right">
                        <h3 class="mt-3 text-center">Information</h3>
                        
                        <hr class="badge-primary mt-0 w-25">
                        <div class="row">
                            <div class="col-sm-6 ">
                                <p class="font-weight-bold">Name :</p>
                                <h6 class="text-muted"><?php echo $name; ?></h6>

                            </div>
                            <div class="col-sm-6 ">
                                <p class="font-weight-bold">E-mail</p>
                                <h6 class="text-muted"><?php echo $email; ?></h6>

                            </div>

                        </div>
                        <h4 class="mt-3"> Contact </h4>
                        <hr class="badge-primary">
                            <div class="row">
                            <div class="col-sm-6 ">
                                <p class="font-weight-bold">Phone: </p>
                                <h6 class="text-muted"><?php echo $phone; ?></h6>

                            </div>
                            <div class="col-sm-6 ">
                                <p class="font-weight-bold">Address: </p>
                                <h6 class="text-muted"><?php echo $address; ?></h6>

                            </div>
                            <div class="col-sm-6 ">
                                <p class="font-weight-bold">City: </p>
                                <h6 class="text-muted"><?php echo $city; ?></h6>

                            </div>   
                            <div class="col-sm-6 ">
                                <p class="font-weight-bold">Store Name: </p>
                                <h6 class="text-muted"><?php echo $store; ?></h6>

                            </div> 

                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>