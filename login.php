<!-- DOCTYPE html>
<html lang="en">
  <head>
       <?php // include_once("analytic.php") ?>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
 
    <link rel="stylesheet" href="assets/css/login.css" />
    
    <title>Sign in - User</title>
  </head>
  <body>
  <?php /*session_start();
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
  <!-- alerts -->
    <div class="alert-warning" style="position:fixed; top:5%; opacity:90%; border-radius:10px; z-index:9999; left:50%; transform: translateX(-50%); display:<?php if(isset($_SESSION['alert'])){echo "block"; }else{ echo"none";} ?>; padding:10px; background-color:#ff5252;" role="alert" id="alertBox">
    <strong name="alertMessage"><?php echo $_SESSION['alert']; ?></strong>
     <button type="button" class="close" style="  padding:5px; background-color: white; color:red; outline:none; border:none; cursor:pointer;" onclick=closeAlert()>
        <span aria-hidden="true">&times;</span>
    </button>
  </div>

    <div class="container">
      <a href="index.php">
        <button class="backTohome Sidebtn">                                               
          <i class="fa fa-home" aria-hidden="true"></i>
        </button>
      </a>
      <a href="sellerLogin.php">
        <button class="SellerLogin Sidebtn">                                               
          Seller
        </button>
      </a>

      <div class="forms-container">
        <div class="signin-signup">
        <!-- LOGIN -->
          <form action="loginProcess.php" method="POST" class="sign-in-form">
            <h2 class="title">Sign in - User</h2>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="email" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" required/>
            </div>
            <input type="submit" value="Login" name="login" class="btn solid" />

          <a href="forgotPassword.php">forgot Password?</a>
           
          </form>


          <!-- REGISTER -->
          <form action="loginProcess.php" method="POST" class="sign-up-form">
            <h2 class="title">Sign up - User</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" pattern="[A-Za-z]{3}" title="Only alphabets are valid for this field." placeholder="Name" required name="name"/>
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" required name="email"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" required name="password"/>
            </div>
            <div class="input-field">
              <i class="fa fa-map-marker"></i>
              <input type="text" placeholder="Address" required name="address"/>
            </div>
            <div class="input-field">
              <i class="fas fa-building"></i>
              <select name="city" required>
                <option>Ichalkaranji</option>
                <option>Kolhapur</option>
                <option>Sangli</option>
                <option>Satara</option>
              </select>

            </div>
            <div class="input-field">
              <i class="fas fa-mobile"></i>
             
             <!-- <form action="login.php" method="POST"> -->
              <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" placeholder="Mobile" required/>
                <?php $otp = rand(); ?>
                <input type="text" id="otp" name="otp" value="<?php echo $otp; ?>" hidden readonly>
            </div>
          
            <!-- </form> -->
            <input type="submit" class="btn zIndexTop"  value="Sign up" name="register"/>
            
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Manchester City</h3>
            <p>
              New here?
              Connect with us by creating your own account and explore our site.
            </p>
            <button class="btn transparent Sidebtn" id="sign-up-btn">
              Sign up
            </button>
          </div>
           
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Manchester City</h3>
            <p>
              Already have an account? <br>
              Sign in here!!!
            </p>
            <button class="btn transparent Sidebtn" id="sign-in-btn">
              Sign in
            </button>
            
          </div>
           
        </div>
      </div>
    </div>

    <script src="assets/js/login.js"></script>
    <script>
      function closeAlert(elem)
      {
        document.getElementById('alertBox').style.display="none";
        <?php unset($_SESSION['alert']); ?>
      }
    </script>
  </body>
</html-->

*/
 header('location: loginRegister.php');
    
?>