<?php
    if(isset($_POST['orderNow']) && $_POST['paymentMethod'] == "Cash on Delivery")
    {
        require('../dbConnect.php');
        $totalPrice = 0;
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
     <?php include_once("analytic.php") ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/onlinePayment.css">
    <title>Confirm Order</title>
        <script src="https://kit.fontawesome.com/fd82d50e73.js" crossorigin="anonymous"></script>
</head>
<body>
    

        <form action="invoicePage.php" method="POST">
        <div class="row">
            <div class="col-11 col-sm-6 m-auto">      
                <center><h3>Confirm Order</h3></center>
        <table width="100%" border="red" class="table">
            <tr>
                <th>Product</th><th>DISCOUNT</th><th>QUANTITY</th><th>PRICE</th>
            </tr>


        <?php
        $store = $_POST['store'];
        $id = $_POST['id'];
        $quantity = $_POST['quantity'];
        $totalPrice = $_POST['totalPrice'];
         echo '<input type="text" value="'. $id .'" name="id" hidden>';



        $query1 = "SELECT * FROM `products` WHERE `id` = '$id'";
        $result1 = $con->query($query1) or $err1 = mysqli_error($con);
        if(!isset($err1))
        {
            while($finalRes1 = mysqli_fetch_array($result1))
            {
                $id = $finalRes1['id'];
                $productDetails = $finalRes1['productDetails'];
                $productDiscount = $finalRes1['productDiscount'];
                $productPrice = $finalRes1['productPrice'];
                $productName = $finalRes1['productName'];
            }
        }
            ?>
                 
                            <tr>
                                <td><?php echo $productName; ?> <br> <?php echo $productDetails; ?></td>
                                <td><?php echo $productDiscount; ?>%</td>
                                <td><?php echo $quantity; ?> <input type="text" hidden value="<?php echo $quantity; ?>" name="quantity<?php echo $id ?>"></td>
                                <td><?php echo $productPrice; ?>Rs.<input type="text" hidden value="<?php echo $productPrice; ?>" name="price<?php echo $id ?>"></td>
                            </tr>
                        
                            


                        <?php

       
    ?>
    </table> <br> <br>

            </div>
            <div class="col-7 m-auto">
                    Store Name : <?php echo $store; ?> <br>
    Total Price : <?php echo $totalPrice;?>Rs. <br> <br>
            </div>


            <div class="col-7 m-auto">
                    <input type="text" value="<?php echo $store; ?>" name="store" hidden>
    <input type="text" value="<?php echo $quantity; ?>" name="quantity" hidden>
    <input type="text" value="<?php echo $totalPrice; ?>" name="totalPrice" hidden>
    <button class="btn btn-primary m-5" name="OrderCarts">Order</button>
    </form>
    <div class="btn btn-danger" onclick="location.replace('index.php');">cancel</div>
            </div>
        </div>




   
    <script>
        function paymentOption(elem)
        {
            if(document.getElementById(elem).value == "Online Payment")
            {
                document.getElementById('qr').style.display="block";
            }
            else
            {
                document.getElementById('qr').style.display="none";
            }
        }
    </script>
    </body>
</html>
    <?php
}
else if(isset($_POST['orderNow']) && $_POST['paymentMethod'] == "Online")
    {
        require('../dbConnect.php');  
        $totalPrice = 0;
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
     <?php include_once("analytic.php") ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/onlinePayment.css">
    <title>Confirm Order</title>
        <script src="https://kit.fontawesome.com/fd82d50e73.js" crossorigin="anonymous"></script>
        <style>
            .qr{
                width:50%;
            }
            @media only screen and (max-width: 600px) {
  .qr {
    width: 90%;
  }
}
        </style>  
</head>
<body>
    
  
        <form action="invoicePage.php" method="POST">
             <div class="row">
            <div class="col-11 col-sm-6 m-auto">      
                <center><h3>Confirm Order</h3></center>
        <table width="100%" border="red" class="table">
            <tr>
                <th>Product</th><th>DISCOUNT</th><th>QUANTITY</th><th>PRICE</th>
            </tr>


        <?php
        $store = $_POST['store'];
        $id = $_POST['id'];
        $quantity = $_POST['quantity'];
        $totalPrice = $_POST['totalPrice'];
         echo '<input type="text" value="'. $id .'" name="id" hidden>';



        $query1 = "SELECT * FROM `products` WHERE `id` = '$id'";
        $result1 = $con->query($query1) or $err1 = mysqli_error($con);
        if(!isset($err1))
        {
            while($finalRes1 = mysqli_fetch_array($result1))
            {
                $id = $finalRes1['id'];
                $productDetails = $finalRes1['productDetails'];
                $productDiscount = $finalRes1['productDiscount'];
                $productPrice = $finalRes1['productPrice'];
                $productName = $finalRes1['productName'];
            }
        }
            ?>
                 
                            <tr>
                                <td><?php echo $productName; ?> <br> <?php echo $productDetails; ?></td>
                                <td><?php echo $productDiscount; ?>%</td>
                                <td><?php echo $quantity; ?> <input type="text" hidden value="<?php echo $quantity; ?>" name="quantity<?php echo $id ?>"></td>
                                <td><?php echo $productPrice; ?>Rs.<input type="text" hidden value="<?php echo $productPrice; ?>" name="price<?php echo $id ?>"></td>
                            </tr>
                        
                            


                        <?php

       
    ?>
    </table> <br> <br>

            </div>
            <div class="col-7 m-auto">
                    Store Name : <?php echo $store; ?> <br>
    Total Price : <?php echo $totalPrice;?>Rs. <br> <br>
            </div> <br>
            <div class="col-11 m-auto"><center>
                         <iframe width="420" class="m-auto" height="345" src="https://www.youtube.com/embed/_nZ10c5p7Ko"></iframe></center>
            </div>
            <div class="col-11 m-auto">
                <center>
                    <div class="card w-50">
                        <div class="card-header">Manchester City</div>
                        <div class="card-body qr m-auto"><center><img src="../assets/img/qrCode.png" alt="QR Code" width="100%"></center></div>
                        <div class="card-text">8308028609@okbizaxis</div>
                        <div class="inputFields row col-12">
							                <div class="transactionId col-sm-6 col-12">
							                    <input type="tel" required placeholder="12 DIGIT UPI TXN ID..." pattern="[0-9]{12}" name="transactionId" id="transactionId">
							                 </div>
							 
                                        <div class="payAmount col-sm-6 col-12"><input type="text" name="payAmount" readonly id="payAmount" value="<?php echo $totalPrice .'Rs.'; ?>"></div>
                    </div>
                </center>
  
			</div> 
			
			<div class="col-7 m-auto">
                    <input type="text" value="<?php echo $store; ?>" name="store" hidden>
    <input type="text" value="<?php echo $quantity; ?>" name="quantity" hidden>
    <input type="text" value="<?php echo $totalPrice; ?>" name="totalPrice" hidden>
    <input type="text" value="Online" hidden name="paymentMethod">
    <button class="btn btn-primary m-5" name="OrderCarts">Order</button></form><div class="btn btn-danger" onclick="location.replace('index.php');">cancel</div>
            </div>
    </body>
</html>
    <?php
}
    else
    {
        echo "<script>alert('something went wrong!!');</script>";
        echo "<script>history.back();</script>";
    }
?>