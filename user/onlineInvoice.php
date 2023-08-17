<?php
    require('../dbConnect.php');
    if(isset($_POST['submitOnline']))
    {
        
		
            $id =  $_POST['id'];   
            $item = $_POST['item'];
            $Totalprice = $_POST['Totalprice'];
            $quantity = $_POST['quantity'];
            $description = $_POST['description'];
            $sellerName = $_POST['sellerName'];
            $sellerCity = $_POST['sellerCity'];
            $sellerEmail = $_POST['sellerEmail'];
            $sellerPhone = $_POST['sellerPhone'];
            $paymentMethod = "online";
            $customer = $_POST['customer'];
            $transactionId = $_POST['transactionId'];
            $payAmount = $_POST['payAmount'];
              
            $query = "INSERT INTO `invoice` (`item`, `id`, `description`, `Totalprice`, `quantity`, `seller`, `customer`, `paymentMethod`, `tranId`, `payAmount`) VALUES('$item', '$id', '$description', '$Totalprice', '$quantity', '$sellerEmail', '$customer', '$paymentMethod', '$transactionId', '$payAmount')";
            $result = $con->query($query) or $err = mysqli_error($con);
               if(isset($err)) 
               {
                   if($err == "Duplicate entry '$transactionId' for key 'tranId'")
                   {
                        echo '<script>alert("Invalid Transaction Id!!!");</script>';
                       echo '<script>history.back();</script>';

                   }
                   else
                   {
                       echo '<script>history.back();</script>';
                   }
                   
               }  

            $query = "SELECT * FROM `invoice` WHERE `id` = '$id'";
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
   <a href="index.php"><button style="padding:10px; outline:none; margin:10px; cursor:hover;" id="backBtn">Back</button></a>

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
               <th><span>Payment Method</span></th>
               <td><span><?php echo $paymentMethod; ?></span></td>
           </tr>
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
               <tr>
                   <td><span  ><?php echo $item; ?></span></td>
                   <td><span  ><?php echo $description; ?></span></td>
                   <td><span  ><?php echo $quantity; ?></span></td>
                   <td><span data-prefix> Rs.</span><span><?php echo $Totalprice; ?></span></td>
               </tr>
           </tbody>
       </table>
       <table class="balance">
           <tr>
               <th><span  >Total</span></th>
               <td><span data-prefix> Rs.</span><span><?php echo $Totalprice; ?></span></td>
           </tr>

       </table>
   </article>

   <center><button id="btn" onclick="prints()" style="padding:10px; position:absolute: bottom:0; cursor:pointer;">PRINT</button></center>
</body>
</html>

<?php  
    }
?>