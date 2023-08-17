/*     -- First Slider --           */
$('.slider-one')
.not('.slick-initialized')
.slick({
    autoplay:true,
    autoplaySpeed:3000,
    dots:true,
    prevArrow:'.site-slider .slider-btn .prev',
    nextArrow:'.site-slider .slider-btn .next'
});


/* -------------------------------- order-product.html ----------------------------- */  
function quantityChanged(id)
{
    
    var quantity = document.getElementById('quantity').value;
    var productPrice = document.getElementById('productPrice').value;
    var actualPrice = document.getElementById('actualPrice').value;

    var finalPrice1 = productPrice * quantity;
    var finalPrice2 = actualPrice * quantity;

    document.getElementById('price').value = finalPrice1;
    document.getElementById('actual').value = finalPrice2;
}
 

 

 




