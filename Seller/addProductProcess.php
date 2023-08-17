<?php

ob_start(); 
session_start();


if(isset($_POST["submit"])) {
    if(is_array($_FILES)) {
        $uploadedFile = $_FILES['ProductImage']['tmp_name']; 
        $sourceProperties = getimagesize($uploadedFile);
        $newFileName = rand();
        $dirPath = "../assets/img/productImages/";
        $ext = pathinfo($_FILES['ProductImage']['name'], PATHINFO_EXTENSION);
        $imageType = $sourceProperties[2];


        switch ($imageType) {


            case IMAGETYPE_PNG:
                $imageSrc = imagecreatefrompng($uploadedFile); 
                $tmp = imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1]);
                imagepng($tmp,$dirPath. $newFileName. "_thump.". $ext);
                break;           

            case IMAGETYPE_JPEG:
                $imageSrc = imagecreatefromjpeg($uploadedFile); 
                $tmp = imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1]);
                imagejpeg($tmp,$dirPath. $newFileName. "_thump.". $ext);
                break;
            
            case IMAGETYPE_GIF:
                $imageSrc = imagecreatefromgif($uploadedFile); 
                $tmp = imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1]);
                imagegif($tmp,$dirPath. $newFileName. "_thump.". $ext);
                break;

            default:
                echo "<script>alert('Invalid Image type.');</script>";

                echo "<script> location.replace('addProducts.php'); </script>";
                
                
                exit;
                break;
        }

        $ProductCategory = $_POST['ProductCategory'];
        $ProductName = $_POST['ProductName'];
        $ProductQuantity = $_POST['ProductQuantity'];
        $ProductPrice = $_POST['ProductPrice'];
        $ProductDetails = $_POST['ProductDetails'];
        $ProductDiscount = $_POST['ProductDiscount'];
        
        //move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext);
        require('../dbConnect.php');
        $email = $_SESSION['Selleremail'];

        $query = "SELECT * FROM `sellers` WHERE `email` = '$email'";
        $result = $con->query($query) or $err = mysqli_error($con);
        if(!isset($err)) 
        {
            $finalRes = mysqli_fetch_array($result);
            $store = $finalRes['store_name'];
        }

        $file = addslashes(file_get_contents($_FILES["ProductImage"]["tmp_name"])); 
        $id = rand(); 
        $query = "INSERT INTO `products`(`productImg`, `productImgId`, `productCat`, `productName`, `productQuantity`, `productPrice`, `productDetails`, `productDiscount`, `email`,`store_name`) VALUES ('$file', '$id', '$ProductCategory', '$ProductName', '$ProductQuantity', '$ProductPrice', '$ProductDetails', '$ProductDiscount', '$email', '$store')"; 
        $result = $con->query($query) or $err = mysqli_error($con);
        if(!isset($err)) 
        {
            echo '<script>alert("Product Added Successfully")</script>';  
            echo '<script>location.replace("products.php");</script>';  
        }
        else
        {
            echo $err; 
        }

        //echo "Image Resize Successfully.";
    }
}


function imageResize($imageSrc,$imageWidth,$imageHeight) {

    $newImageWidth =200;
    $newImageHeight =200;

    $newImageLayer=imagecreatetruecolor($newImageWidth,$newImageHeight);
    imagecopyresampled($newImageLayer,$imageSrc,0,0,0,0,$newImageWidth,$newImageHeight,$imageWidth,$imageHeight);

    return $newImageLayer;
}







?>