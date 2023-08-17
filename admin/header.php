
    <!--**************************************  Header Section****************************************************************-->

    <?php 
    ob_start(); 
    session_start();
    if(!isset($_SESSION['AdminSession']))
    {  
        echo "<script>location.replace('../loginRegister.php');</script>";
        //ob_end_clean();
    }
?>
<header class="p-0">
  <?php require('../dbConnect.php'); ?>
      <div class="container-fluid p-0 text-white m-0">
      <div class="row p-0 m-0 pt-1 ">
      <div class="site-title float-left col-sm-10 text-white" style="cursor:pointer;" onclick="location.replace('index.php');">Manchester City - Admin</div>
      <div class="header-links text-right col-sm-2"><a href="logout.php"><abbr title="logout"><i class="fas fa-sign-out-alt"></i></abbr></a></div>
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
                <a class="nav-link <?php if($title == 'Sellers'){ echo'active';} ?>" href="index.php">Sellers</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link <?php if($title == 'Users'){ echo'active';} ?>" href="users.php">Users  </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if($title == 'Ads'){ echo'active';} ?>" href="ads.php">Ads</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if($title == 'Contact'){ echo'active';} ?>" href="contact.php">Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if($title == 'Payments'){ echo'active';} ?>" href="payment.php">Payments</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php if($title == 'Requests'){ echo'active';} ?>" href="sellerReq.php">Requests</a>
              </li>
              
            </ul>
            <!-- <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn  btn-outline-light my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
            </form> -->
             
       
 
          </div>
        </nav>
      </div>
    </nav>
