<!doctype html>
<html lang="en">
  <head>
       <?php include_once("analytic.php") ?>
       <?php include_once("analytic.php") ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Custome CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/aboutus.css">


    <link rel="stylesheet" href="../assets/css/seller.css">

    <!-- Slick Slider-->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome CDN-->
    <script src="https://kit.fontawesome.com/75e161d596.js" crossorigin="anonymous"></script>
   

    <title>Manchester City - About - Seller <?php $title = 'About'; ?></title>
  </head>
  <body>
<?php require('header.php');
  require('aboutModal.php');
  ?>

<!--**************************************  Main Section ****************************************************************-->
     <main>
       
      <div id="aboutContent"> <!-- Blured Backgrund--> </div>


<!-- Manchester City--> 
 <div id="aboutCard">
    <h2 class="my-3"> Manchester City</h2>
    <div class="row">
      <div class="col-sm-6 col-12 p-0 p-sm-5">
        <img src="/assets/img/logo.png" width="100%" alt="">
      </div>
      <div class="col-sm-6 col-12 p-5 m-auto text-left">
          non architecto dignissimos modi explicabo? Aliquam, perf nsequuntur repellendus esse deleniti?            
      </div>
    </div>
    <div class="aboutCardClose" onclick="CloseCard();">&#9932;</div>
 </div>

       <!-- Services--> 
  <div id="serviceCard">
    <h2 class="my-3"> Services</h2>
     <div class="row">
        <div class="col-sm-6 col-12 p-0 p-sm-5">
          <img src="/assets/img/logo.png" width="100%" alt="">
        </div>
        <div class="col-sm-6 col-12 p-5 m-auto text-left">
           non architecto dignissimos modi explicabo? Aliquam, perf nsequuntur repellendus esse deleniti?            
        </div>
     </div>
        <div class="aboutCardClose" onclick="CloseCard();">&#9932;</div>
  </div>


           <!--Contact--> 
 <div id="contactCard">
  <h2 class="my-3">Contact</h2>
  <div class="row">
    <div class="col-sm-6 col-12 p-0 p-sm-5">
      <img src="/assets/img/logo.png" width="100%" alt="">
    </div>
    <div class="col-sm-6 col-12 p-5 m-auto text-left">
        non architecto dignissimos modi explicabo? Aliquam, perf nsequuntur repellendus esse deleniti?            
    </div>
  </div>
  <div class="aboutCardClose" onclick="CloseCard();">&#9932;</div>
</div>


<section class="aboutus"> 
   
   <h2>About Us</h2>
   <hr>

   <p>Grow your business and Explore the wide range of products from anyware...</p>

   <center>   
     <a href = "#" data-toggle="modal" data-target="#exampleModalLong1" id="manchesterCityBtn" style="text-decoration: none;">Manchester City</a>

     <div class="vertical-line"></div>

     <a href = "#" data-toggle="modal" data-target="#exampleModalLong2" style="text-decoration: none;" id="serviceBtn">Service</a>

     <div class="vertical-line"></div>

     <a href = "#" data-toggle="modal" data-target="#exampleModalLong3" style="text-decoration: none;" id="contactBtn">Contact</a>
   </center>   
</section>
     </main>
    <?php require('footer.php'); ?>

  </body>
</html>