<?php
require ("../dbConnect.php");

if(isset($_POST['upload'])) 
{
    if(is_array($_FILES)) 
    {
        $uploadedFile = $_FILES['file']['tmp_name']; 
        $sourceProperties = getimagesize($uploadedFile);
        $newFileName = rand();
        $dirPath = "../assets/img/ads/";
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $imageType = $sourceProperties[2];
        
        //move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext);

        $file = addslashes(file_get_contents($_FILES["file"]["tmp_name"])); 

        $query = "INSERT INTO `ads` (`img`) VALUES('$file');";
        
        
        $result = $con->query($query) or $err = mysqli_error($con);
        if(!isset($err))
        {
            echo "<script> alert('Ad added Successfully');</script>";
            echo "<script> location.replace('ads.php');</script>";
        }
        else
        {
            echo $err;
        }

        //echo "Image Resize Successfully.";
    }
    //echo "ok";
}
else
{
    echo "ok";
}
 


?>