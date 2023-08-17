<?php
    if((int)$productDiscount > 0)
    {
      $temp = (int)$productPrice / 5;
      $temp2 = ((int)$productPrice / 100) * (int)$productDiscount;
      $temp3 = (int)$productPrice - (int)$temp2;
      $displayPrice = (int)$temp3;
     /*$temp = (int)$productPrice/(int)$productDiscount;
     $displayPrice = (int)$productPrice - (int)$temp;*/
    }
    else
    {
     

      $displayPrice = $productPrice;
      $productPrice = (int)$productPrice + 1;
    }

?>