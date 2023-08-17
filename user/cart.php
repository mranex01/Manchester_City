<!DOCTYPE html>
<html lang="en">
<head>
     <?php include_once("analytic.php") ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Custome CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/cart.css">
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Font Awesome CDN-->
    <script src="https://kit.fontawesome.com/fd82d50e73.js" crossorigin="anonymous"></script>
    <title>Cart <?php $title = 'Cart'; ?></title>
</head>
<style>
  .collapsible {
    background-color: #777;
    color: white;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    margin-top: 20px;
  }
  
 
  
  .collapsible:after {
    content: '\002B';
    color: white;
    font-weight: bold;
    float: right;
    margin-left: 5px;
  }
  
 
  
  .content{
    position: relative;
     
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.2s ease-out;
    background-color: #f1f1f1;
  }

  .content .removeBtn
  {
    float: right;
    margin-bottom: 10px;
  }
</style>
<body>
<?php require('header.php');  ?>


<?php
        $user = $_SESSION['Useremail'];
        $query = "SELECT DISTINCT `store` FROM `cart` WHERE `customer` = '$user'";
        $resultDistinct = $con->query($query) or $err = mysqli_error($con);
            if(!isset($err)) 
            {
                $row = mysqli_num_rows($resultDistinct);
                if( $row == 0)
                {
                  echo "<tr><td colspan = '5' >No Cart!!!</td><tr>";
                }
                
             
                while($finalRes = mysqli_fetch_array($resultDistinct))
                {               
                   $store = $finalRes['store'];
                    
                   
  ?>



        <button class="collapsible"> Store:  <?php echo $store; ?></button>
              
        <div class="content">

        <div class="table-responsive">
          <table class="table">
            <thead class="thead-dark">
              <tr>
                  <th scope="col">Sr.</th>
                  <!--<th scope="col">Image</th>-->
                  <th scope="col">Product Name</th>
                  <th scope="col">Price</th>
                  <th scope="col">More</th>
              </tr>
            </thead>
          <tbody>

          <?php
        
            $query = "SELECT * FROM `cart` WHERE `store` = '$store'";
            $result = $con->query($query) or $err = mysqli_error($con);
            if(!isset($err))  
            {
                $row = mysqli_num_rows($result);
                if( $row == 0)
                {
                  echo "<tr><td colspan = '5' >No Cart!!!</td><tr>";
                }
                
                $i = 0;
                while($finalRes = mysqli_fetch_array($result))
                {
                  $i++;
                  $id = $finalRes['id'];
                   $productImg = $finalRes['productImg'];
                   $productName = $finalRes['productName'];
                   $productPrice = $finalRes['productPrice'];             
                   
                  echo '<tr>';
                   echo '<th scope="row">'. $i  .'</th>';
                   //echo '<td> <img src="data:image/jpeg;base64,'.base64_encode($productImg ).'" height="100" width="100" class="img-thumnail" /> </td>';
                   echo '<td>'. $productName .'</td>';
                   echo '<td>'. $productPrice .'</td>';
                   echo '<td><form style ="display:inline-block;" method="POST" action="showCarts.php"><input type="number" name="id" hidden value='.  $id  . '><input type="submit" value="View" name="view" class="btn btn-outline-primary">';
                   echo '<input type="submit" value="Remove" name="remove" class="btn btn-outline-danger"> </form>';
                   //echo '<form style ="display:inline-block;" action="removeCart.php" method="POST"><input type="text" name="id" id="id" hidden value="' .$id . '"> <input type="submit" value="Remove" name="remove" class="btn btn-outline-danger"> </form>';
                   echo '</tr>';
                }
            }
          ?>

        </tbody>
      </table>
    </div>
    
       <form method="POST" action="cartProcess.php">  
  
<!-- Button trigger modal -->
<button type="button" class="removeBtn btn btn-outline-danger" data-toggle="modal" data-target="#removeAll<?php echo $store;?>">
  Remove All
</button>

<!-- Modal -->
<div class="modal fade" id="removeAll<?php echo $store;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm to Remove....</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Do you really want to Remove these carts??
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <input type="text" name="store" hidden value="<?php echo $store; ?>">
        <input type="submit" value="Remove" type="button" name="removeAll" class="btn btn-primary">
      </div>
    </div>
  </div>
</div>
      <button name="proceedOrder" class =" removeBtn btn btn-outline-success">Proceed for Order</button>
      </form>
      </div>

      <?php
        } 
      } 
      ?>

<?php require('footer.php'); ?>
<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
</script>
</body>
</html>