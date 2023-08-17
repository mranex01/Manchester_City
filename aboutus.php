<!doctype html>
<html lang="en">
  <head>
       <?php include_once("analytic.php") ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="yarn,manchester,loom,powerloom,ichalkaranji,mill store,buy,sell,shop,store,yarn,meaning,yarn meaning in marathi,yarn architecture,yarn meaning in hindi,yarn vs npm, Buy yarn, Sell yarn, Buy Loom, Sell Loom, Buy mill store, sell mill store, mill store, yarn, loom, powerloom, textile, ichalkaranji, manchester city, seller, textile market, about us">
    <!-- Custome CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/aboutus.css">

    <!-- Slick Slider-->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome CDN-->
    <script src="https://kit.fontawesome.com/75e161d596.js" crossorigin="anonymous"></script>

    <title>Manchester City - About Us : yarn,manchester,loom,powerloom,ichalkaranji,mill store,buy,sell,shop,store,yarn,meaning,yarn meaning in marathi,yarn architecture,yarn meaning in hindi,yarn vs npm, Buy yarn, Sell yarn, Buy Loom, Sell Loom, Buy mill store, sell mill store, mill store, yarn, loom, powerloom, textile, ichalkaranji, manchester city, seller, textile market, about us <?php $title = 'About Us' ?> </title>

    <script>
      function showContent(elem)
      {
         
        if(elem == "manchesterCityBtn")
        {
          document.getElementById('aboutCard').style.display="block";
        }
        else if(elem == "serviceBtn") 
        {
          document.getElementById('serviceCard').style.display="block";
        }
        else if(elem == "contactBtn")
        {
          document.getElementById('contactCard').style.display="block";
        }
        document.getElementById('aboutContent').style.display="block";
      }

      function CloseCard(elem)
      {
        document.getElementById('aboutCard').style.display="none";
        document.getElementById('serviceCard').style.display="none";
        document.getElementById('contactCard').style.display="none";
        document.getElementById('aboutContent').style.display="none";
      }
    </script>
  </head>
  <body>
<!--**************************************  Including Header.php ****************************************************************-->
<?php require('header.php'); 
  require('aboutModal.php');
  ?>

<!--************************************** Main ****************************************************************-->
    <main>



      <div id="aboutContent"> <!-- Blured Backgrund--> </div>


      <!-- Manchester City--> 
       <div id="aboutCard">
          <h2 class="my-3"> Manchester City</h2>
          <div class="row">
            <div class="col-sm-6 col-12 p-0 p-sm-5">
              <img src="assets/img/logo.png" width="100%" alt="">
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
                <img src="assets/img/logo.png" width="100%" alt="">
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
            <img src="assets/img/logo.png" width="100%" alt="">
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

<!--**************************************  Including footer.php ****************************************************************-->
<?php require('footer.php'); ?>

      </body>
    </html>