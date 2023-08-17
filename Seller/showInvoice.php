<?php
    require('../dbConnect.php');
    require('../globleVar.php');
    ob_start(); 
    session_start();
    if(!isset($_SESSION['Selleremail']))
    {  
        echo "<script>location.replace('../sellerLogin.php');</script>";
        //ob_end_clean();
    }  
    if(isset($_POST['view']))
    {
        $invoiceId =  $_POST['invoiceId'];
          
         $query = "SELECT * FROM `invoice` WHERE `invoiceId` = '$invoiceId'";
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
				$seller = $finalRes['seller'];
				$customer = $finalRes['customer'];
				$transactionId = $finalRes['tranId'];
                
            }
        }
		$query = "SELECT * FROM `sellers` WHERE `email` = '$seller'";
		$result = $con->query($query) or $err = mysqli_error($con);
	   if(!isset($err)) 
	   {
			$finalRes = mysqli_fetch_array($result);

			$sellerName = $finalRes['name'];
			$sellerEmail = $finalRes['email'];
			$sellerPhone = $finalRes['phone'];
			$sellerCity = $finalRes['city'];
	   }

	   $query = "SELECT * FROM `users` WHERE `email` = '$customer'";
	   $result = $con->query($query) or $err = mysqli_error($con);
	  if(!isset($err)) 
	  {
		   $finalRes = mysqli_fetch_array($result);

		   $userName = $finalRes['name'];
		   $userEmail = $finalRes['email'];
		   $userPhone = $finalRes['phone'];
		   $userCity = $finalRes['city'];
		   $userAddress = $finalRes['address'];
	  }
    
        ?>
<html>
	<head>
	     <?php include_once("analytic.php") ?>
	     
		<meta charset="utf-8">
		<title>Invoice</title>
		<link rel="stylesheet" href="../assets/css/invoicePage.css">
		 
		<script src="../assets/js/script.js"></script>
        <script>
        function prints()
        {
            document.getElementById("btn").style.display="none";
            window.print();
            document.getElementById("btn").style.display="block";

        }
        </script>
	</head>
	<body>
		<a onclick = "history.back();"><button style="padding:10px; outline:none; margin:10px; cursor:hover;" id="backBtn">Back</button></a>

		<header>
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
    else if(isset($_POST['remove']))
    {
        $invoiceId = $_POST['invoiceId'];
        $query = "DELETE FROM `invoice` WHERE `invoiceId` = '$invoiceId'";
        $result = $con->query($query) or $err = mysqli_error($con);
       if(!isset($err)) 
       {
           echo '<script>alert("Order Deleted!!!");</script>';
           echo '<script>location.replace("index.php");</script>';
       }
       else
       {
        echo '<script>alert("' . $err . '");</script>';
        echo '<script>location.replace("index.php");</script>';

       }
        
    }
	else if(isset($_POST['proceed']))
	{
        $invoiceId =  $_POST['invoiceId'];

        $query1 = "SELECT * FROM `invoice` WHERE `invoiceId` = '$invoiceId'";
        $result1 = $con->query($query1);
        $finalRes1 = mysqli_fetch_array($result1);
        $customerEmail = $finalRes1['customer'];

        $query2 = "SELECT * FROM `users` WHERE `email` = '$customerEmail'";
        $result2 = $con->query($query2);
        $finalRes2 = mysqli_fetch_array($result2);
        $customerName = $finalRes2['name'];
        $customerPhone = $finalRes2['phone'];


        $fields = array(
            "sender_id" => "TXTIND",
            "message" => "Dear $customerName , your order has been proceeded. For more information visit manchestercity.store",
            "route" => "v3",
            "numbers" => "$customerPhone",
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



		$query = "UPDATE `invoice` SET `status` = 'Proceeded' WHERE `invoiceId` = '$invoiceId'";
		
        $result = $con->query($query) or $err = mysqli_error($con);
        			echo "<script>location.replace('index.php');</script>";
       if(!isset($err)) 
       {
			echo "<script>location.replace('index.php');</script>";
		 
	   }
	   else
	   {
	       echo "$err";
	       	       echo "err";
	   }
	}
    else
    {   
        echo "<script>location.replace('index.php');</script>"; 
    }
?>