<?php

ob_start(); 
session_start();


if(isset($_POST["submit"])) 
{

    $ProductCategory = $_POST['ProductCategory'];
    $ProductName = $_POST['ProductName'];
    $ProductQuantity = $_POST['ProductQuantity'];
    $ProductPrice = $_POST['ProductPrice'];
    $ProductDetails = $_POST['ProductDetails'];
    $ProductDiscount = $_POST['ProductDiscount'];
    $id = $_POST['id'];
    
    //move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext);
    require('../dbConnect.php');
    $email = $_SESSION['Selleremail'];

    if(isset($_POST['ProductImage']))
    {
        if(is_array($_FILES)) 
        {
            $uploadedFile = $_FILES['ProductImage']['tmp_name']; 
            $sourceProperties = getimagesize($uploadedFile);
            $newFileName = rand();
            $dirPath = "../assets/img/productImages/";
            $ext = pathinfo($_FILES['ProductImage']['name'], PATHINFO_EXTENSION);
            $imageType = $sourceProperties[2];

            switch ($imageType) 
            {
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

                    echo "<script> location.replace('products.php'); </script>";


                    exit;
                    break;
            }



            $query = "SELECT * FROM `sellers` WHERE `email` = '$email'";
            $result = $con->query($query) or $err = mysqli_error($con);
            if(!isset($err)) 
            {
                $finalRes = mysqli_fetch_array($result);
                $store = $finalRes['store_name'];
            }

            $file = addslashes(file_get_contents($_FILES["ProductImage"]["tmp_name"])); 
        
   
            $query = "UPDATE `products` SET `productImg` = '$file', `productImgId`='$id', `productCat`='$ProductCategory', `productName`='$ProductName', `productQuantity`='$ProductQuantity', `productPrice`='$ProductPrice', `productDetails`='$ProductDetails', `productDiscount`='$ProductDiscount', `email`='$email',`store_name`='$store' WHERE `id` = '$id'"; 
            $result = $con->query($query) or $err = mysqli_error($con);
            if(!isset($err)) 
            {
                echo '<script>alert("Product Updated Successfully")</script>';  
                echo '<script>location.replace("products.php");</script>';  
            }
            else
            {
                echo $err; 
            }
  

        //echo "Image Resize Successfully.";
        }
    }
    else
    {

        $query = "SELECT * FROM `sellers` WHERE `email` = '$email'";
        $result = $con->query($query) or $err = mysqli_error($con);
        if(!isset($err)) 
        {
            $finalRes = mysqli_fetch_array($result);
            $store = $finalRes['store_name'];
        }

        $query = "UPDATE `products` SET `productCat`='$ProductCategory', `productName`='$ProductName', `productQuantity`='$ProductQuantity', `productPrice`='$ProductPrice', `productDetails`='$ProductDetails', `productDiscount`='$ProductDiscount', `email`='$email',`store_name`='$store' WHERE `id` = '$id'"; 
        $result = $con->query($query) or $err = mysqli_error($con);
        if(!isset($err)) 
        {
            echo '<script>alert("Product Updated Successfully")</script>';  
            echo '<script>location.replace("products.php");</script>';  
        }
        else
        {
            echo $err; 
        }
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