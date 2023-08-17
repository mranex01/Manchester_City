 <!DOCTYPE html>
<html lang="en">
<head>
     <?php include_once("analytic.php") ?>
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
        /*background:#BCBAE8;*/
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
                transition: 0.6s;
                padding-right:10px;
                padding-left:10px;
            }
     .closeBtn:hover
    {
        background:white;
        color:red;
    }
    input, select
    {
        border:none;
        background:none;
        border-bottom:0.6px solid white;
       
        margin:10px;
        outline:none;
    }
    input[type="email"]::placeholder
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
</style>
</head>
<body class="bg-light">

    <div class="container">
        <div class="forgotPass bg-primary text-white">
        <div class="title">Varify Your Mobile Number</div>
        <div class="closeBtn" onclick="location.replace('loginRegister.php');">X</div>
        <form action="varifyMob.php" method="POST">
            Select Your Account Type: 
            <select name="role" id="role">
                <option value="User">User</option> 
                <option value="Seller">Seller</option> 
            </select> <br>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
            <br>   <br>
            <input type="submit" value="Send OTP" name="varify" class="btn btn-light">
        </form>
        </div>
    </div>
      
</body>
</html>