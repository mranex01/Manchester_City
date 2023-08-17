<?php
    require('../dbConnect.php');
    if(!isset($_POST['OrderCarts']) )
    {
        //echo '<script>history.back();</script>';
    }
    else if(isset($_POST['OrderCarts']))          
    {
		if($_POST['paymentMethod'] == "Online")
		{
            if($_POST['transactionId'] == "")
            {
                echo '<script>alert("Enter a valid Transaction Id!!");</script>';
                echo '<script>history.back();</script>';
            }
            
            
			//$id =  $_POST['id'];   
			$store = $_POST['store'];
			$totalPrice = $_POST['totalPrice'];
			$transactionId = $_POST['transactionId'];
            $payAmount = $totalPrice;
            $paymentMethod = "online";

            //Checking douplicate transaction value//
            
            $checkTranIdQuery = "SELECT * FROM `invoice` WHERE `tranId` = '$transactionId'";
            $checkResult = $con->query($checkTranIdQuery) or $checkErr = mysqli_error($con); 
            if(mysqli_num_rows($checkResult) > 0)
            {
                echo '<script>alert("Douplicate Transaction Id");</script>';
                echo '<script>history.back();</script>';
            }







			//$quantity = $_POST['quantity'];
			//$description = $_POST['description'];
			//$sellerName = $_POST['sellerName'];
			//$sellerCity = $_POST['sellerCity'];
			//$sellerEmail = $_POST['sellerEmail'];
			//$sellerPhone = $_POST['sellerPhone'];

			//$customer = $_POST['customer'];

            $store = $_POST['store'];

            $querySeller = "SELECT * FROM `sellers` WHERE `store_name` = '$store'";
            $resultSeller = $con->query($querySeller) or $errSeller = mysqli_error($con);
            if(!isset($errSeller))
            {
                while($finalResSeller = mysqli_fetch_array($resultSeller))
                {
                    $sellerName = $finalResSeller['name'];
                    $sellerEmail = $finalResSeller['email'];
                    $sellerPhone = $finalResSeller['phone'];
                    $sellerCity = $finalResSeller['city'];
                }
            }
            session_start();
            $userEmail = $_SESSION['Useremail'];
            $query = "SELECT * FROM `users` WHERE `email` = '$userEmail'";
            $result = $con->query($query) or $err = mysqli_error($con);
            if(!isset($err)) 
            {
                while($finalRes = mysqli_fetch_array($result))
                {
                   $userName = $finalRes['name'];
                   $userPhone = $finalRes['phone'];
                   $userAddress = $finalRes['address'];
                   $userCity = $finalRes['city'];
                }
            } 
             
            $randomInvoiceId = rand(1, 255);
            
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

                        }
                        $query = "INSERT INTO `invoice` (`invoiceId`,`item`, `id`, `description`, `rate`, `Totalprice`, `quantity`, `seller`, `customer`, `paymentMethod`, `tranId`, `payAmount`) VALUES('$randomInvoiceId','$productName', '$id', '$productDetails', '$price', '$totalPrice', '$quantity', '$sellerEmail', '$userEmail', '$paymentMethod', '$transactionId', '$payAmount')";
                        $result = $con->query($query) or $err = mysqli_error($con);
                        if(isset($err)) 
                        {
                            echo $err;
                           
                        } 

                        $removeQuantityQuery = "SELECT * FROM `products` WHERE `id` = '$id'";
                        $removeQuantityResult = $con->query($removeQuantityQuery) or $removeErr = mysqli_error($con);
                        if(!isset($removeErr))
                        {
                            $removeFinalRes = mysqli_fetch_array($removeQuantityResult);
                            $quant = $removeFinalRes['ProductQuantity'];
                            $tempQuan = $quant - $quantity;
    
                            $updateQuan = "UPDATE `products` SET `ProductQuantity` = '$tempQuan' WHERE `id` = '$id'";
                            $updateRes = $con->query($updateQuan) or $updateErr = mysqli_error($con);
                            if(isset($updateErr))
                            {
                                echo "<script>alert('Something Went Wrong!!!!');</script>";
                                echo "<script>history.back();</script>";
                            }
                        }
 
                    }

                }
                        
            }        
       
                  
              
          

            $query = "SELECT * FROM `invoice` WHERE `invoiceId` = '$randomInvoiceId'";
            $result = $con->query($query) or $err = mysqli_error($con);
            if(!isset($err)) 
            {
                while($finalRes = mysqli_fetch_array($result))
                {
                   $invoiceId = $finalRes['invoiceId'];
                   $date = $finalRes['date'];
                   $item = $finalRes['item'];
                   $description = $finalRes['description'];
                   $Totalprice = $finalRes['Totalprice'];
                   $paymentMethod = $finalRes['paymentMethod'];
                   $quantity = $finalRes['quantity'];
                
                }
            }
              
   


        ?>
<html>  
<head>
   <meta charset="utf-8">
   <title>Invoice</title>
   <link rel="stylesheet" href="../assets/css/invoicePage.css">
    
   <script src="../assets/js/script.js"></script>
   <script>
   function prints()
   {
    document.getElementById("btn").style.display="none";
            document.getElementById("backBtn").style.display="none";
            window.print();
            document.getElementById("btn").style.display="block";
            document.getElementById("backBtn").style.display="block";

   }
   </script>
</head>
<body>
   <a href="index.php"><button style="padding:10px; outline:none; margin:10px; cursor:hover;" id="backBtn">Home</button></a>

   <header>
       <h1>Invoice</h1>
       <address>
           <b>Sold by, </b>
           <p><?php echo $sellerName; ?></p>
           <p><?php echo $sellerEmail; ?></p>
           <p>Tel. <?php echo $sellerPhone; ?></p>
           <p><?php echo $sellerCity; ?></p>

       </address>
       <address>
           <b>Sold To, </b>
           <p><?php echo $userName; ?></p>
           <p><?php echo $userEmail; ?></p>
           <p>Tel. <?php echo $userPhone; ?></p>
           <p><?php echo $userAddress; ?></p>
           <p><?php echo $userCity; ?></p>

       </address>
   </header>
   <article>
       
       <address>
           <p>Manchester City<br></p>
       </address>
       <table class="meta">
           <tr>
               <th><span>Invoice</span></th>
               <td><span><?php echo $invoiceId; ?></span></td>
            </tr>
            <tr>
               <th><span>Payment</span></th>
               <td><span><?php echo $paymentMethod; ?></span></td>
           </tr>
           <?php if($paymentMethod == "online"){?>
            <tr>
               <th><span>Transaction Id</span></th>
               <td><span><?php echo $transactionId; ?></span></td>
           </tr>
           <?php } ?>
           <tr>
               <th><span  >Date</span></th>
               <td><span  ><?php echo $date; ?></span></td>
           </tr>

       </table>
       <table class="inventory">
           <thead>
               <tr>
                   <th><span  >Item</span></th>
                   <th><span  >Description</span></th>
                   <th><span  >Quantity</span></th>
                   <th><span  >Price</span></th>
               </tr>
           </thead>
           <tbody>
           <?php  
                $itemQuery = "SELECT * FROM `invoice` WHERE `invoiceId` = '$invoiceId'";
                $itemResult = $con->query($itemQuery) or $itemErr = mysqli_error($con);
                if(isset($itemErr))
                {
                    echo $itemErr;
                }
                while($itemFinalRes = mysqli_fetch_array($itemResult))
                {
                    $item = $itemFinalRes['item'];
                    $description = $itemFinalRes['description'];
                    $quantity = $itemFinalRes['quantity'];
                    $Totalprice = $itemFinalRes['Totalprice'];
                    $price = $itemFinalRes['rate'];
                
           ?>
               <tr>
                   <td><span  ><?php echo $item; ?></span></td>
                   <td><span  ><?php echo $description; ?></span></td>
                   <td><span  ><?php echo $quantity; ?></span></td>
                   <td><span data-prefix> Rs.</span><span><?php echo $price; ?></span></td>
               </tr>
               <?php
                }
                ?>
           </tbody>
       </table>
       <table class="balance">
           <tr>
               <th><span  >Total Price</span></th>
               <td><span data-prefix> Rs.</span><span><?php echo $Totalprice; ?></span></td>
           </tr>

       </table>
   </article>

   <center><button id="btn" onclick="prints()" style="padding:10px; position:absolute: bottom:0; cursor:pointer;">PRINT</button></center>
</body>
</html>





		<?php
		}
		else
		{
  
			$store = $_POST['store'];
			$totalPrice = $_POST['totalPrice'];
            $payAmount = $totalPrice;
            $paymentMethod = "COD";


            //Retriving Seller's Information

            $querySeller = "SELECT * FROM `sellers` WHERE `store_name` = '$store'";
            $resultSeller = $con->query($querySeller) or $errSeller = mysqli_error($con);
            if(!isset($errSeller))
            {
                while($finalResSeller = mysqli_fetch_array($resultSeller))
                {
                    $sellerName = $finalResSeller['name'];
                    $sellerEmail = $finalResSeller['email'];
                    $sellerPhone = $finalResSeller['phone'];
                    $sellerCity = $finalResSeller['city'];
                }
            }

            //Retriving User's Information

            session_start();
            $userEmail = $_SESSION['Useremail'];
            $query = "SELECT * FROM `users` WHERE `email` = '$userEmail'";
            $result = $con->query($query) or $err = mysqli_error($con);
            if(!isset($err)) 
            {
                while($finalRes = mysqli_fetch_array($result))
                {
                   $userName = $finalRes['name'];
                   $userPhone = $finalRes['phone'];
                   $userAddress = $finalRes['address'];
                   $userCity = $finalRes['city'];
                }
            } 

                         
            $randomInvoiceId = rand(1, 255);
            
            //Retriving Product's Information

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

                        }

                        //Inserting Product Information to Invoice
                        $query = "INSERT INTO `invoice` (`invoiceId`,`item`, `id`, `description`, `rate`, `Totalprice`, `quantity`, `seller`, `customer`, `paymentMethod`) VALUES('$randomInvoiceId','$productName', '$id', '$productDetails', '$price', '$totalPrice', '$quantity', '$sellerEmail', '$userEmail', '$paymentMethod')";
                        $result = $con->query($query) or $err = mysqli_error($con);
                        if(isset($err)) 
                        {
                            echo $err;
                           
                        } 
                        $removeQuantityQuery = "SELECT * FROM `products` WHERE `id` = '$id'";
                        $removeQuantityResult = $con->query($removeQuantityQuery) or $removeErr = mysqli_error($con);
                        if(!isset($removeErr))
                        {
                            $removeFinalRes = mysqli_fetch_array($removeQuantityResult);
                            $quant = $removeFinalRes['ProductQuantity'];
                            $tempQuan = $quant - $quantity;
    
                            $updateQuan = "UPDATE `products` SET `ProductQuantity` = '$tempQuan' WHERE `id` = '$id'";
                            $updateRes = $con->query($updateQuan) or $updateErr = mysqli_error($con);
                            if(isset($updateErr))
                            {
                                echo "<script>alert('Something Went Wrong!!!!');</script>";
                                echo "<script>history.back();</script>";
                            }
                        }
 
                    }
                }
                        
            }        
       
            // Retriving data from invoice

            $query = "SELECT * FROM `invoice` WHERE `invoiceId` = '$randomInvoiceId'";
            $result = $con->query($query) or $err = mysqli_error($con);
            if(!isset($err)) 
            {
                while($finalRes = mysqli_fetch_array($result))
                {
                   $invoiceId = $finalRes['invoiceId'];
                   $date = $finalRes['date'];
                   $item = $finalRes['item'];
                   $description = $finalRes['description'];
                   $Totalprice = $finalRes['Totalprice'];
                   $paymentMethod = $finalRes['paymentMethod'];
                   $quantity = $finalRes['quantity'];
                
                }
            }
              
   


        ?>
<html>  
<head>
   <meta charset="utf-8">
   <title>Invoice</title>
   <link rel="stylesheet" href="../assets/css/invoicePage.css">
    
   <script src="../assets/js/script.js"></script>
   <script>
   function prints()
   {
    document.getElementById("btn").style.display="none";
            document.getElementById("backBtn").style.display="none";
            window.print();
            document.getElementById("btn").style.display="block";
            document.getElementById("backBtn").style.display="block";

   }
   </script>
</head>
<body>
   <a href="index.php"><button style="padding:10px; outline:none; margin:10px; cursor:hover;" id="backBtn">Home</button></a>

   <header>
       <h1>Invoice</h1>
       <address>
           <b>Sold by, </b>
           <p><?php echo $sellerName; ?></p>
           <p><?php echo $sellerEmail; ?></p>
           <p>Tel. <?php echo $sellerPhone; ?></p>
           <p><?php echo $sellerCity; ?></p>

       </address>
       <address>
           <b>Sold To, </b>
           <p><?php echo $userName; ?></p>
           <p><?php echo $userEmail; ?></p>
           <p>Tel. <?php echo $userPhone; ?></p>
           <p><?php echo $userAddress; ?></p>
           <p><?php echo $userCity; ?></p>

       </address>
   </header>
   <article>
       
       <address>
           <p>Manchester City<br></p>
       </address>
       <table class="meta">
           <tr>
               <th><span>Invoice</span></th>
               <td><span><?php echo $invoiceId; ?></span></td>
            </tr>
            <tr>
               <th><span>Payment</span></th>
               <td><span><?php echo $paymentMethod; ?></span></td>
           </tr>
           <?php if($paymentMethod == "online"){?>
            <tr>
               <th><span>Transaction Id</span></th>
               <td><span><?php echo $transactionId; ?></span></td>
           </tr>
           <?php } ?>
           <tr>
               <th><span  >Date</span></th>
               <td><span  ><?php echo $date; ?></span></td>
           </tr>

       </table>
       <table class="inventory">
           <thead>
               <tr>
                   <th><span  >Item</span></th>
                   <th><span  >Description</span></th>
                   <th><span  >Quantity</span></th>
                   <th><span  >Price</span></th>
               </tr>
           </thead>
           <tbody>
           <?php  
                $itemQuery = "SELECT * FROM `invoice` WHERE `invoiceId` = '$invoiceId'";
                $itemResult = $con->query($itemQuery) or $itemErr = mysqli_error($con);
                if(isset($itemErr))
                {
                    echo $itemErr;
                }
                while($itemFinalRes = mysqli_fetch_array($itemResult))
                {
                    $item = $itemFinalRes['item'];
                    $description = $itemFinalRes['description'];
                    $quantity = $itemFinalRes['quantity'];
                    $Totalprice = $itemFinalRes['Totalprice'];
                    $price = $itemFinalRes['rate'];
                
           ?>
               <tr>
                   <td><span  ><?php echo $item; ?></span></td>
                   <td><span  ><?php echo $description; ?></span></td>
                   <td><span  ><?php echo $quantity; ?></span></td>
                   <td><span data-prefix> Rs.</span><span><?php echo $price; ?></span></td>
               </tr>
               <?php
                }
                ?>
           </tbody>
       </table>
       <table class="balance">
           <tr>
               <th><span  >Total Price</span></th>
               <td><span data-prefix> Rs.</span><span><?php echo $Totalprice; ?></span></td>
           </tr>

       </table>
   </article>

   <center><button id="btn" onclick="prints()" style="padding:10px; position:absolute: bottom:0; cursor:pointer;">PRINT</button></center>
</body>
</html>








<?php }} ?>