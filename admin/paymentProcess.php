  <?php
    require("../dbConnect.php");
    require("../globleVar.php");
    if(isset($_POST['submitPayment']))
    {
        $invoiceId = $_POST['invoiceId'];
        $query = "UPDATE `invoice` SET `paymentStatus` = 'Paid' WHERE `invoiceId` = '$invoiceId'";
        $result = $con->query($query) or $err = mysqli_error($con);
 
        echo "<script>location.replace('payment.php');</script>";
    }
    else if(isset($_POST['cancelPayment']))
    {
        $invoiceId = $_POST['invoiceId'];
        
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
            "message" => "Dear $customerName , your order has been canceled due to invalid payment. For more information contact 9975268970",
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

                    
              if ($err) {
                echo "cURL Error #:" . $err;
              } else {
              echo $response;
              }
              
        $query = "DELETE FROM `invoice` WHERE `invoiceId` = '$invoiceId'";
        $result = $con->query($query) or $err = mysqli_error($con);
 
        echo "<script>alert('Order Canceled!');</script>";
        echo "<script>location.replace('payment.php');</script>";
    }
    else
    {
               echo "<script>alert('Something Went Wrong');</script>";
        echo "<script>location.replace('payment.php');</script>";
    }
?>

