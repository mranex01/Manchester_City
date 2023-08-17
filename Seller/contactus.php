<!doctype html>
<html lang="en">
  <head>
       <?php include_once("analytic.php") ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Custome CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <link rel="stylesheet" href="../assets/css/contactus.css">

    <!-- Slick Slider-->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome CDN-->
    <script src="https://kit.fontawesome.com/fd82d50e73.js" crossorigin="anonymous"></script>
   

    <title>Manchester City - Contact Us<?php $title = 'Contact Us'; ?></title>
  </head>
  <body>
<?php require('header.php'); ?>

<!--**************************************  Main Section ****************************************************************-->

     <main>
     <section class="contact">
        <div class="content">
          <h2> Contact Us</h2>
           
        </div>
        <div class="container row">
          <div class="contactInfo col-sm-6">
          <div class="box">
            <div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></i></i></div>
            <div class="text">
              <h3>Address</h3>
              <p>416115 Shahapur Road, Ichalkaranji, Maharashtra India.</p>
            </div>
          </div>
          <div class="box">
            <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
            <div class="text">
              <h3>Phone</h3>
              <p>9975- 268- 970</p>
            </div>
          </div>
          <div class="box">
            <div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
            <div class="text">
              <h3>Email</h3>
              <p>manchestercityich@gmail.com</p>
            </div>
          </div>
        </div>
          <div class="contactForm col-sm-6">
            <form>
              <h2>Send Message</h2>
              <div class="inputBox">
                <input type="text" name="contact_us_name" required="required" placeholder="Name">
              </div>
              <div class="inputBox">
                <input type="email" name="contact_us_email" required="required" placeholder="Email">
              </div>
              <div class="inputBox">
                <samp>Type your message...</samp>
    
                <textarea required="required" name="contact_us_message"> </textarea>
              </div>
              
                  <div class="inputBox">
                <input type="submit" name="" value="Send">
              </div>
            </form>
      </div>
    </div>
      </section>
     </main>
    <?php require('footer.php'); ?>

  </body>
</html>