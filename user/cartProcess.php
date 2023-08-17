<?php
    require('../dbConnect.php');
    if(isset($_POST['proceedOrder']))
    {
        $store = $_POST['store'];
        //echo 'orderProceeded';
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Products</title>
    <link rel="stylesheet" href="../assets/css/cartProcess.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
<form action="confirmCartOrder.php" method="POST">
<div class="container-fluid ">
<div class="row p-0 mw-100">
<?php require('../dbConnect.php'); 

            $query = "SELECT * FROM `cart` WHERE `store` = '$store'";
            $result = $con->query($query) or $err = mysqli_error($con);
            $numOfCarts = mysqli_num_rows($result);
            while($finalRes = mysqli_fetch_array($result))
            {
                $id = $finalRes['id'];

                $query2 = "SELECT * FROM `products` WHERE `id` = '$id'";
                $result2 = $con->query($query2) or $err2 = mysqli_error($con);
                if(!isset($err2))
                {
                    while($finalRes2 = mysqli_fetch_array($result2))
                    {
                        $id = $finalRes2['id'];
                        $productName = $finalRes2['productName'];
                        $productCat = $finalRes2['productCat'];
                        $productPrice = $finalRes2['productPrice'];
                        $productDetails = $finalRes2['productDetails'];
                        $productDiscount = $finalRes2['productDiscount'];
                        $productImg = $finalRes2['productImg'];
                        $ProductQuantity = $finalRes2['ProductQuantity'];
                    }
                }

            
?>

    <div class="orderBox row col-sm-6">
            <div class="row col-12 m-auto">
                <div class="col-sm-4 col-12 text-center p-2">
                    
                        <img src="data:image/jpeg;base64, <?php echo base64_encode($productImg); ?>" height="200" width="200" class="img-thumnail" />  <br>
                        <?php echo $productName; ?><br>
                        <?php echo $productDetails; ?> 

                </div>
                <div class="col-sm-3 col-3 text-center">
                    <div class="contentPosition">
                        Discount <br>
                        <font size="5vh"><?php echo $productDiscount; ?>%</font>
                    </div>

                </div>
                <div class="col-sm-3 col-4">
                <div class="contentPosition">
                    Quantity <br> <?php if($ProductQuantity <=0){echo "<font color='red'><b>Out Of Stock</b></font>";}?>
                    <input type="number" name="quantity<?php echo $id; ?>" onchange="quantityChanged('<?php echo $id; ?>');" name="quantity" id="quantity<?php echo $id; ?>" min="1" max="<?php echo $ProductQuantity; ?>" value="1" required onclick>
                </div>
                </div>   
                <div class="col-sm-2 col-5 text-center">
                    <div class="contentPosition m-0 p-0"> 
                        Price <br>
                        <font size="3vh"> 
                        <input type="text" onclick="alert(this.id);" name="price<?php echo $id; ?>" id="price<?php echo $id; ?>" value="<?php echo $productPrice; ?>" readonly>Rs</font>
                        <input type="text" name="actualPrice" id="actualPrice<?php echo $id; ?>" value="<?php echo $productPrice; ?>" hidden>
                    </div>
                </div>      
                
             
        </div>
    </div>
<?php } ?>
                <div class="col-sm-12 col-12 row p-5">
                    <div class="col-12 col-sm-6 text-center text-nowrap">
                        Total Products : <br> <?php echo $numOfCarts; ?>
                    </div>
                    <div class="col-12 col-sm-6 text-center">
                        <input type="text" name="store" id="store" hidden value="<?php echo $store; ?>">
                        <select class="custom-select w-50" name="paymentMethod"><option value="Cash On Delivery">Cash On Delivery</option><option value="Online">Online</option></select>
                        <input type = "submit" class="btn btn-success" name="ProceedCartOrder" value = '<?php if($ProductQuantity <=0){echo "Out Of Stock";} else{echo "Proceed to Order"; }?>'>  </form>

                        <div class="btn btn-danger" onclick="history.back()">Cancel</div>
                    </div>
     
                </div>

                </div>
                </div>

<script>
    function quantityChanged(id)
    {
        var quanElem = "quantity"+id;
        var priceElem = "price"+id;
        var actualPriceElem = "actualPrice"+id;
        var quan = document.getElementById(quanElem).value;
        
        var actualPrice = document.getElementById(actualPriceElem).value;
        
        var temp = parseInt(actualPrice) * parseInt(quan);
 
        document.getElementById(priceElem).value=temp;
    }
</script>

</body>
</html>

        <?php

    }
    else if(isset($_POST['removeAll']))
    {
        $store = $_POST['store'];
        $query = "DELETE FROM `cart` WHERE `store` = '$store'";
        $result = $con->query($query) or $err = mysqli_error($con);
        if(!isset($err)) 
        {
            echo "<script> alert('Carts Removed!!!'); </script>";
            echo "<script> history.back(); </script>";
        }
        else
        {
            //echo $err;
            echo "<script> history.back(); </script>";
        }

    }
    else
    {
        echo '<script>history.back();</script>';
    }

?>