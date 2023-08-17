<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("analytic.php") ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <style>
        html
        {  
            scroll-behavior:smooth;
        }
        .sec
        {
            width:100%;
            min-height: 100vh;
            overflow: hidden;
            position:relative;
        }
        .loginContainer
        {
            width:50vh;
            padding:20px;
            position: absolute;
            top:50%;
            left:50%;
            transform: translate(-50%, -50%);
            box-shadow: gray 1px 1px 15px;
            border-radius: 10px;
        }
    </style>
</head>
<body style="overflow: hidden;">
<?php session_start();
      if(isset($_SESSION['Selleremail']))
      {
        echo '<script>location.replace("Seller/index.php");</script>';
      }
      else if(isset($_SESSION['Useremail']))
      {
        echo '<script>location.replace("user/index.php");</script>';
      }
      else
      {
  
      }
       ?>
       <a class="btn btn-primary" href="index.php" style="position:fixed; top:2%; left:2%; z-index:999;">Back</a>
  <!-- alerts -->
    <div class="alert-warning" style="position:fixed; top:5%; opacity:90%; border-radius:10px; z-index:9999; left:50%; transform: translateX(-50%); display:<?php if(isset($_SESSION['alert'])){echo "block"; }else{ echo"none";} ?>; padding:10px; background-color:#ff5252;" role="alert" id="alertBox">
    <strong name="alertMessage"><?php echo $_SESSION['alert']; ?></strong>
     <button type="button" class="close" style="  padding:5px; background-color: white; color:red; outline:none; border:none; cursor:pointer;" onclick=closeAlert()>
        <span aria-hidden="true">&times;</span>
    </button>
  </div>

<!-- ----------------------- Login -------------------------------------->   
    <div class="sec" id="login">
        <div class="loginContainer border border-primary bg-light">
            <div class="card-header font-weight-bold font-size-3 bg-primary text-white">Sign In</div>
            <form action="loginProcess.php" method="POST" class="p-3">
                <input type="email" name="email" id="email" required placeholder="Email" autocomplete="off" class="form-control mb-3 border-bottom" style="background:none; border:none; outline:none;">
                <input type="password" name="password" id="password" required placeholder="Password" class="form-control mb-3 border-bottom" style="background:none; border:none; outline:none;">
                <input type="submit" class="btn btn-primary" name="login" value="Login">
            </form>
            <hr>
            <small><center class="text-muted"><a href="forgotPassword.php">Forgot Password?</a></center></small>
            <hr>
            <center>
                <a href="#userRegister" class="registerHereBtn btn btn-sm btn-warning">Create Account</a>
                <a href="#sellerRegister" class="registerHereBtn btn btn-sm btn-outline-success">Become a Seller</a>
            </center>
        </div>
    </div>


<!-- ----------------- User Register ----------------->   
    <div class="sec" id="userRegister">
        <div class="loginContainer border border-warning bg-light">
            <div class="card-header font-weight-bold font-size-3 bg-warning text-white">Sign Up</div>
            <form action="loginProcess.php" method="POST" class="p-3">
                <input type="email" name="email" id="email" required placeholder="Email" autocomplete="off" class="form-control mb-3 border-bottom" style="background:none; border:none; outline:none;">
                <input type="password" name="password" id="password" required placeholder="Password" class="form-control mb-3 border-bottom" style="background:none; border:none; outline:none;">
                <input type="text" name="name" id="name" required placeholder="Name" class="form-control mb-3 border-bottom" style="background:none; border:none; outline:none;">
                <input type="tel" name="phone" pattern="[7-9]{1}[0-9]{9}" id="phone" required placeholder="Phone" class="form-control mb-3 border-bottom" style="background:none; border:none; outline:none;">
                <select name="city" id="city" class="custom-select mb-3 border-bottom" style="background:none; border:none; outline:none;">
                    <option value="Ichalkaranji">Ichalkaranji</option>
                    <option value="Kolhapur">Kolhapur</option>
                    <option value="Sangli">Sangli</option>
                    <option value="Satara">Satara</option>
                </select>
                <input type="text" name="address" id="address" required placeholder="Address" class="form-control mb-3 border-bottom" style="background:none; border:none; outline:none;">
                <input type="submit" class="btn btn-warning" name="register" value="Sign Up">
            </form>
            <hr>    
            <small><center class="text-muted">Already Have An Account?</center></small> <br>
            <center>
                <a href="#login" class="registerHereBtn btn btn-sm btn-primary">Login Here</a>
                <a href="#sellerRegister" class="registerHereBtn btn btn-sm btn-outline-success">Become a Seller</a>
            </center>
        </div>
    </div>      



    <!-- ----------------- Seller Register 1 ----------------->   
    <div class="sec" id="sellerRegister">
        <div class="loginContainer border border-success bg-light" id="sellerReg1" style="display:block;">
            <div class="card-header font-weight-bold font-size-3 bg-success text-white">Create Seller Account</div>
            <form action="loginProcess.php" method="POST" enctype="multipart/form-data" class="p-3">    
                <input type="email" name="email" id="seller-email" required placeholder="Email" autocomplete="off" class="form-control mb-3 border-bottom" style="background:none; border:none; outline:none;">
               
                <input type="text" name="name" id="seller-name" required placeholder="Name" class="form-control mb-3 border-bottom" style="background:none; border:none; outline:none;">
                <input type="tel" name="phone" pattern="[0-9]{10}" id="seller-phone" required placeholder="Phone" class="form-control mb-3 border-bottom" style="background:none; border:none; outline:none;">
                <select name="city" id="city" class="custom-select mb-3 border-bottom" style="background:none; border:none; outline:none;">
                    <option value="Ichalkaranji">Ichalkaranji</option>
                    <option value="Kolhapur">Kolhapur</option>
                    <option value="Sangli">Sangli</option>
                    <option value="Satara">Satara</option>
                </select>
                <input type="text" name="address" id="address" required placeholder="Address" class="form-control mb-3 border-bottom" style="background:none; border:none; outline:none;">
                <input type="button" class="btn btn-success" onclick="validate()" value="Next">
            
            <hr>     
            <small><center class="text-muted">Already Have An Account?</center></small> <br>
            <center>
                <a href="#login" class="registerHereBtn btn btn-sm btn-primary">Login Here</a>
            </center>
        </div>

        <div class="loginContainer border border-success bg-light" id="sellerReg2" style="display:none;">
            <div class="card-header font-weight-bold font-size-3 bg-success text-white"><span class="btn btn-primary btn-sm mr-2" onclick="backForm();"><<</span>Create Seller Account</div>
                <label for="adhaar">Shop Name: </label>
                <input type="text" name="storeName" id="storeName" placeholder="Store Name.." required class="form-control mb-3 border-bottom"  style="background:none; border:none; outline:none;">
                <label for="adhaar">UPI ID: </label>
                <input type="text" name="upi" id="upi" placeholder="Enter your upi id.." required class="form-control mb-3 border-bottom"  style="background:none; border:none; outline:none;">
                <label for="adhaar">Adhaar Card Photo: </label>
                <input type="file" name="adhaar" id="adhaar" onchange="fileValidation(this.id)" class="form-control mb-3" title="doc" required  style="background:none; border:none; outline:none;">
                
                <label for="licence">Shop Licence Photo: </label>
                <input type="file" name="licence" id="licence" onchange="fileValidation(this.id)" class="form-control mb-3" title="doc" required style="background:none; border:none; outline:none;">
                
                 <label for="passbook">Bank Passbook Photo: </label>
                <input type="file" name="passbook" id="passbook" onchange="fileValidation(this.id)" class="form-control mb-3" title="doc" required  style="background:none; border:none; outline:none;">
                
                <input type="checkbox" name="conditions" id="conditions" required>
                <label for="conditions">I accept all your turms and conditions</label>
                <input type="submit" class="btn btn-success" name="register" value="Create Your Account">
            </form>
            <hr>
            <small><center class="text-muted">Already Have An Account?</center></small> <br>
            <center>
                <a href="#login" class="registerHereBtn btn btn-sm btn-primary">Login Here</a>
            </center>
        </div>


    </div>
    
<script>
    function validate()
    {
        let name = document.getElementById('seller-name');
        let email = document.getElementById('seller-email');
        let phone = document.getElementById('seller-phone');

        if(!name.checkValidity() || !email.checkValidity() || !phone.checkValidity())
        {
            alert("Please Fill the Form Correctly")
        }
        else
        {  
            document.getElementById('sellerReg1').style.display="none";
            document.getElementById('sellerReg2').style.display="block";
        }
    }
    function backForm()
    {
        document.getElementById('sellerReg1').style.display="block";
        document.getElementById('sellerReg2').style.display="none";
    }  
    function closeAlert(elem)
      {
        document.getElementById('alertBox').style.display="none";
        <?php unset($_SESSION['alert']); ?>
      }

      // Validating Images

      function fileValidation(id) 
          { 
              var fileInput = document.getElementById(id); 

              var preview = "preview"+id;
                
              var filePath = fileInput.value; 
            
              var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i; 
                
              if (!allowedExtensions.exec(filePath)) 
              { 
                  fileInput.value = ''; 
                  alert('Invalid File Type, only .jpg, .jpeg, .png, .gif format is valid.')
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
                                          document.getElementById(preview).innerHTML = '<img width = 150px; src="' + e.target.result + '"/>'; 
                                      }; 
                        
                      reader.readAsDataURL(fileInput.files[0]); 
                  } 
              } 
          } 
</script>
</body>
</html>