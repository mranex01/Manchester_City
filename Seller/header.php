
    <!--**************************************  Header Section****************************************************************-->

<?php 
    ob_start(); 
    session_start();
    if(!isset($_SESSION['Selleremail']))
    {  
        echo "<script>location.replace('../loginRegister.php');</script>";
        //ob_end_clean();
    }  
    require('../dbConnect.php');
    $email = $_SESSION['Selleremail'];
    $query = "SELECT * FROM `sellers` WHERE `email` = '$email'";
    $result = $con->query($query) or $err = mysqli_error($con);
    if(isset($err))
    {
        echo" Please Go Back!!";
    }
    $finalRes = mysqli_fetch_array($result);
    $store = $finalRes['store_name'];
?>
<header class="p-0">
  <?php require('../dbConnect.php');  ?>
      <div class="container-fluid p-0 text-white m-0">
      <div class="row p-0 m-0 pt-1 ">
      <div class="site-title float-left col-sm-10 text-white"><a href="index.php" style="text-decoration:none; color:white;">Manchester City - Seller - <?php echo $store; ?></a></div>
      </div>
    </div>

    </header>


<!--************************************** Navbar ****************************************************************-->

    <nav class="sticky-top">
      <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light">
         
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        
          <div class="collapse text-white navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav p-md-2 p-5 mr-auto">
              <li class="nav-item active">
                <a class="nav-link <?php if($title == 'Orders'){ echo'active';} ?>" href="index.php">Orders</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if($title == 'Products'){ echo'active';} ?>" href="products.php">Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if($title == 'All Products'){ echo'active';} ?>" href="allproducts.php">All Products</a>
              </li>
              <!--li class="nav-item">
                <a class="nav-link <?php //if($title == 'Offers'){ echo'active';} ?>" href="offers.php">Offers</a>
              </li-->
            </li> 
            
            <li class="nav-item">  
              <a class="nav-link <?php if($title == 'About'){ echo'active';} ?>" href="about.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($title == 'Contact Us'){ echo'active';} ?>" href="contactus.php">Contact us</a>
            </li>
          </li>            
            </ul>
            <form class="form-inline my-2 my-lg-0">
              <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->
      <div class="header-links text-right col-sm-2"><a href="profile.php"><i class="fa fa-user-circle user-profile" aria-hidden="true"></i></a></div>
              <!-- <button class="btn  btn-outline-light my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button> -->
            </form>
          </div>
        </nav>
      </div>
    </nav>
