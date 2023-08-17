<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Custome CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/Ad.css">

    <!-- Slick Slider-->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome CDN-->
    <script src="https://kit.fontawesome.com/fd82d50e73.js" crossorigin="anonymous"></script>

    <title>Manchester City - Admin -Ads<?php $title="Ads"; ?></title>
    <script>
                function fileValidation() 
          { 
              var fileInput = document.getElementById('file'); 
                
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
          } 
         
    </script>
  </head>
  <body>
<?php require('header.php'); ?>

<div class="adContent">
  <form action="uploadAd.php" method="POST" onsubmit="return validateForm()" enctype="multipart/form-data">
    <center>
    <h3 style="display:inline-block">Upload your Ads: </h3>
    <input type="file" id="file" name="file" onchange="return fileValidation()" required/> 
    <div id="imagePreview"></div> 
    <input type="submit" value="Submit" name="upload">
    </center>
  </form>

  <div class="ad">
    <center>
  <?php
            $query = "SELECT * FROM `ads`";
            $result = $con->query($query) or $err = mysqli_error($con);
            if(!isset($err))
            {
                $row = mysqli_num_rows($result);
                if($row == 0)
                {
                  echo "No Ads To Show";
                }
                else
                {
                  while($finalRes = mysqli_fetch_array($result))
                  {
                    $img = $finalRes['img'];
                    $id = $finalRes['id'];
                    echo '<form method="POST" action="removeAd.php">';
                    echo '<div class="adImg">';
                      echo '<img src="data:image/jpeg;base64,' . base64_encode($img) . '" class="img-fluid" alt="...">';
                      echo '<input type="text" name="id" value="' . $id . '" hidden>';
                      echo ' <button name="remove" value="X" class="closeBtn">X</button>';
                    echo '</div>';
                    echo '</form>';
                  }
                }

            }
        ?></center>  
  </div>
</div>

<?php require('footer.php'); ?>
</body>
</html>