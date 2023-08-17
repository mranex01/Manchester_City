<?php
    if(isset($_POST['ProceedCartOrder']))
    {   require('../dbConnect.php');
        if($_POST['paymentMethod'] == "Online"){
     
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
        <script src="https://kit.fontawesome.com/fd82d50e73.js" crossorigin="anonymous"></script>
    <title>Confirm Order</title>
    <style>
        .card
        {
            width: 50%;
        }
        @media only screen and (max-width: 600px){
            .card img
            {
                width: 100%;
            }
            .card
            {
                width:90%;
            }
        }
    </style>
</head>
<body>
    

        <form action="confirmCartOrderProcess.php" method="POST" class="p-5">
        <center><h3>Confirm Order</h3></center>
        <table width="100%" border="red">
            <tr>
                <th>Product</th><th>DISCOUNT</th><th>QUANTITY</th><th>PRICE</th>
            </tr>


        <?php
        $store = $_POST['store'];
        $query1 = "SELECT * FROM `cart` WHERE `store` = '$store'";
        $result1 = $con->query($query1) or $err1 = mysqli_error($con);
        if(!isset($err1))
        {
            while($finalRes1 = mysqli_fetch_array($result1))
            {
                $id = $finalRes1['id'];
                $query2 = "SELECT * FROM `products` WHERE `id` = '$id'";
                $result2 = $con->query($query2) or $err2 = mysqli_error($con);
                if(!isset($err2))
                {
                    while($finalRes2 = mysqli_fetch_array($result2))
                    {
                        $id = $finalRes2['id'];
                        $productDiscount = $finalRes2['productDiscount'];
                        $productDetails = $finalRes2['productDetails'];
                        $productName = $finalRes2['productName'];
                        $quantity = $_POST['quantity'.$id];
                        $price = $_POST['price'.$id];
                       
                        $totalPrice = $price + $totalPrice;
                        ?>

                        
                            <tr>
                                <td><?php echo $productName; ?> <br> <?php echo $productDetails; ?></td>
                                <td><?php echo $productDiscount; ?></td>
                                <td><?php echo $quantity; ?> <input type="text" hidden value="<?php echo $quantity; ?>" name="quantity<?php echo $id ?>"></td>
                                <td><?php echo $price; ?><input type="text" hidden value="<?php echo $price; ?>" name="price<?php echo $id ?>"></td>
                            </tr>
                        
                            


                        <?php

                    }            
                }
            }
        }
    ?>
    </table> <br> <br>
 


    Store Name : <?php echo $store; ?> <br>
    Total Price : <?php echo $totalPrice;?> <br> <br>
       <center>
                    <div class="card">
                        <div class="card-header">Manchester City</div>
                        <div class="card-body"><img src="../assets/img/qrCode.png" alt="" width="50%"></div>
                        <div class="card-text">8308028609@okbizaxis</div>
                        <div class="inputFields row col-12">
							                <div class="transactionId col-sm-6 col-12">
							                    <input type="tel" required placeholder="12 DIGIT UPI TXN ID..." pattern="[0-9]{12}" name="transactionId" id="transactionId">
							                 </div>
							 
                                        <div class="payAmount col-sm-6 col-12"><input type="text" name="payAmount" readonly id="payAmount" value="<?php echo $totalPrice .'Rs.'; ?>"></div>
                    </div>
                </center>
  


    <input type="text" value="<?php echo $store; ?>" name="store" hidden>
    <input type="text" value="<?php echo $totalPrice; ?>" name="totalPrice" hidden>
    <input type="text" value="Online" name="paymentMethod" hidden>
    <div>
    <button class="btn btn-primary m-5" name="OrderCarts">Order</button>
    </form>
    <button class="btn btn-danger" onclick="index.php">Cancel</button>
    </div>
    </body>
</html>
    <?php
}else
{
    
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
        <script src="https://kit.fontawesome.com/fd82d50e73.js" crossorigin="anonymous"></script>
    <title>Confirm Order</title>
</head>
<body>
    

        <form action="confirmCartOrderProcess.php" method="POST">
        <center><h3>Confirm Order</h3></center>
        <table width="100%" border="red">
            <tr>
                <th>Product</th><th>DISCOUNT</th><th>QUANTITY</th><th>PRICE</th>
            </tr>


        <?php
        $store = $_POST['store'];
        $query1 = "SELECT * FROM `cart` WHERE `store` = '$store'";
        $result1 = $con->query($query1) or $err1 = mysqli_error($con);
        if(!isset($err1))
        {
            while($finalRes1 = mysqli_fetch_array($result1))
            {
                $id = $finalRes1['id'];
                $query2 = "SELECT * FROM `products` WHERE `id` = '$id'";
                $result2 = $con->query($query2) or $err2 = mysqli_error($con);
                if(!isset($err2))
                {
                    while($finalRes2 = mysqli_fetch_array($result2))
                    {
                        $id = $finalRes2['id'];
                        $productDiscount = $finalRes2['productDiscount'];
                        $productDetails = $finalRes2['productDetails'];
                        $productName = $finalRes2['productName'];
                        $quantity = $_POST['quantity'.$id];
                        $price = $_POST['price'.$id];
                       
                        $totalPrice = $price + $totalPrice;
                        ?>

                        
                            <tr>
                                <td><?php echo $productName; ?> <br> <?php echo $productDetails; ?></td>
                                <td><?php echo $productDiscount; ?></td>
                                <td><?php echo $quantity; ?> <input type="text" hidden value="<?php echo $quantity; ?>" name="quantity<?php echo $id ?>"></td>
                                <td><?php echo $price; ?><input type="text" hidden value="<?php echo $price; ?>" name="price<?php echo $id ?>"></td>
                            </tr>
                        
                            


                        <?php

                    }            
                }
            }
        }
    ?>
    </table> <br> <br>
 
  

    Store Name : <?php echo $store; ?> <br>
    Total Price : <?php echo $totalPrice;?> <br> <br>
        
							 
                            <div class="payAmount col-sm-6 col-12"><input type="text" name="payAmount" readonly id="payAmount" value="<?php echo $totalPrice .'Rs.'; ?>"></div>
						</div>
						<!-- <hr> -->
                </div>
			</div> 


    <input type="text" value="<?php echo $store; ?>" name="store" hidden>
    <input type="text" value="<?php echo $totalPrice; ?>" name="totalPrice" hidden>
    <div>
    <button class="btn btn-primary m-5" name="OrderCarts">Order</button>
    </form>
    <button class="btn btn-danger" onclick="index.php">Cancel</button>
   
 </div>
    </body>
</html>
<?php
}
}
    else
    {
        echo "JFR";
    }
?>