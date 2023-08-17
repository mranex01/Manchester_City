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
<div class="backBar"><a onclick="history.back();" style="text-decoration: none; color:white"><div class="backBtn"><<</div></a></div>
<?php $status = 'pass'; ?>
    <div class="addContainer">
        <form action = "addProductProcess.php" method="POST" enctype="multipart/form-data">        
            <div class="row text-center">
                <div class="col-sm-6 col-12">
                    Category:
                </div>
                <div class="col-sm-6 col-12">
                    <select name="ProductCategory">
                        <option>Yarn</option>
                        <option>Loom</option>
                        <option>Mill Store</option>
                    </select>
                </div>

                <div class="col-sm-6 col-12 my-3">
                    Product Name:
                </div>
                <div class="col-sm-6 col-12 my-3">
                    <input type="text" name="ProductName" id="ProductName" required>
                </div>

                <div class="col-sm-6 col-12 my-3">
                    Price:
                </div>
                <div class="col-sm-6 col-12 my-3">
                    <input type="number" name="ProductPrice" id="ProductPrice" required>
                </div>

                <div class="col-sm-6 col-12 my-3">
                    Product Details:
                </div>
                <div class="col-sm-6 col-12 my-3">
                    <textarea name="ProductDetails" id="ProductDetails" cols="20" rows="4"></textarea>
                </div>

                <div class="col-sm-6 col-12 my-3">
                    Available Quantity:
                </div>
                <div class="col-sm-6 col-12 my-3">
                    <input type="number" name="ProductQuantity" id="ProductQuantity">
                </div>

                <div class="col-sm-6 col-12 my-3">
                    Discount:
                </div>
                <div class="col-sm-6 col-12 my-3">
                    <input type="number" name="ProductDiscount" id="ProductDiscount">
                </div>

                <div class="col-sm-6 col-12 my-3">
                    Upload Images   :
                </div>
                <div class="col-sm-6 col-12 my-3">
                                <input type="file" id="ProductImage" name="ProductImage" onchange="return fileValidation()" required/> 
                                <div id="imagePreview"></div> 
                </div>

                <div class="col-12">
                    <input type="submit" name="submit" id = "submit" value="Add This Product">
                </div>
            </div>
        </form>
    </div>
</body>
</html>


 