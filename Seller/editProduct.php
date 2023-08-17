<?php
require('../dbConnect.php');
    if(isset($_POST['remove']))
    {
        $id = $_POST['id'];

        $query = "DELETE FROM `cart` WHERE `id` = '$id'";
        $result = $con->query($query) or $err = mysqli_error($con);

        $query = "DELETE FROM `products` WHERE `id` = '$id'";
        $result = $con->query($query) or $err = mysqli_error($con);
        if(!isset($err)) 
        {
            echo "<script> alert('Product Removed!!!'); </script>";
            echo "<script> location.replace('products.php'); </script>";
        }
        else
        {
            //echo $err;
            echo "<script> location.replace('products.php'); </script>";
        }
         

    }
    else if(isset($_POST['edit']))
    {
        $id = $_POST['id'];
        $category = $_POST['category'];
    }
    else
    {
        echo "<script>location.replace('products.php');</script>";
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
     <?php include_once("analytic.php") ?>
     
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Custom Css -->
    <link rel="stylesheet" href="../assets/css/seller.css">
    <link rel="stylesheet" href="../assets/css/addProducts.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome CDN-->
    <script src="https://kit.fontawesome.com/fd82d50e73.js" crossorigin="anonymous"></script>

    <title>Seller - Add Product</title>
    <script>
    function fileValidation() 
          { 
              var fileInput = document.getElementById('ProductImage'); 
                
              var filePath = fileInput.value; 
            
              var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i; 
                
              if (!allowedExtensions.exec(filePath)) 
              { 
                  alert('Invalid file type'); 
                  fileInput.value = ''; 
                  return false; 
              }  
              else  
              {   
                
                  // Image preview 
                  if (fileInput.files && fileInput.files[0]) 
                  { 
                      var reader = new FileReader(); 
                      reader.onload = function(e) 
                                      { 
                                          document.getElementById('imagePreview').innerHTML = '<img width = 150px; src="' + e.target.result + '"/>'; 
                                      }; 
                        
                      reader.readAsDataURL(fileInput.files[0]); 
                  } 
              } 
          } </script>
</head>
<body>
<?php
        session_start();
        $email = $_SESSION['Selleremail'];
            $query = "SELECT * FROM `products` WHERE `email` = '$email' AND `id` = '$id'";
            $result = $con->query($query) or $err = mysqli_error($con);
                if(!isset($err)) 
                {
                    $finalRes = mysqli_fetch_array($result);
        
                       $productImg = $finalRes['productImg'];
                       $productName = $finalRes['productName'];
                       $productCat = $finalRes['productCat'];
                       $productPrice = $finalRes['productPrice'];
                       $productDetails = $finalRes['productDetails'];
                       $productDiscount = $finalRes['productDiscount'];
                       $productQuantity = $finalRes['ProductQuantity'];
                       $id = $finalRes['id'];
                }
        
?>
<div class="backBar"><a onclick = "history.back();" style="text-decoration: none; color:white"><div class="backBtn"><<</div></a></div>
<?php $status = 'pass'; ?>
    <div class="addContainer">
        <form action = "editProductProcess.php" method="POST" enctype="multipart/form-data">        
        <input type="text" hidden value="<?php echo $id; ?>" name="id">
            <div class="row text-center">
                <div class="col-sm-6 col-12">
                    Category:
                </div>
                <div class="col-sm-6 col-12">
                    <select name="ProductCategory">
                        <option <?php if($category == "Yarn"){echo "selected";}?> >Yarn</option>
                        <option <?php if($category == "Loom"){echo "selected";}?> >Loom</option>
                        <option <?php if($category == "Mill Store"){echo "selected";}?> >Mill Store</option>
                    </select>
                </div>

                <div class="col-sm-6 col-12 my-3">
                    Product Name:
                </div>
                <div class="col-sm-6 col-12 my-3">
                    <input type="text" name="ProductName" id="ProductName" value  = "<?php echo $productName; ?>">
                </div>

                <div class="col-sm-6 col-12 my-3">
                    Price:
                </div>
                <div class="col-sm-6 col-12 my-3">
                    <input type="number" name="ProductPrice" id="ProductPrice" value  = "<?php echo $productPrice; ?>">
                </div>

                <div class="col-sm-6 col-12 my-3">
                    Product Details:
                </div>
                <div class="col-sm-6 col-12 my-3">
                    <textarea name="ProductDetails" id="ProductDetails" cols="20" rows="4" ><?php echo $productDetails; ?></textarea>
                </div>

                <div class="col-sm-6 col-12 my-3">
                    Available Quantity:
                </div>
                <div class="col-sm-6 col-12 my-3">
                    <input type="number" name="ProductQuantity" id="ProductQuantity" value  = "<?php echo $productQuantity; ?>">
                </div>

                <div class="col-sm-6 col-12 my-3">
                    Discount:
                </div>
                <div class="col-sm-6 col-12 my-3">
                    <input type="number" name="ProductDiscount" id="ProductDiscount" value  = "<?php echo $productDiscount; ?>">
                </div>

                <div class="col-sm-6 col-12 my-3">
                    Upload Images   :
                </div>
                <div class="col-sm-6 col-12 my-3">
                                <input type="file" id="ProductImage" name="ProductImage" onchange="return fileValidation()"/> 
                           <?php echo '<img src="data:image/jpeg;base64,'.base64_encode($productImg ).'" height="200" width="200" class="img-thumnail" hidden/>'; ?>
                                <div id="imagePreview"></div> 
                </div>

                <div class="col-12">
                    <input type="submit" name="submit" id = "submit" value="Update Product">
                </div>
            </div>
        </form>
    </div>
</body>
</html>

 