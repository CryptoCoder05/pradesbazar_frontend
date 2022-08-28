<?php
if (!is_login()) {
  redirect('login.php');
}
 ?>
<!--Shopping cart-->
<section id="order" class="py-3 mb-5">
  <div class="container-fluid w-75">
    <h5 class="font-baloo font-size-20">Your Orders </h5>
    <!-- shopping cart items -->
     <div class="row">
       <!-- cart item -->
       <div class="col-sm-9">
         <!-- Empty Cart -->
         <div class="row border-top py-3 mt-3">
           <div class="col-sm-12 text-center py-2">
             <img src="./assets/img/empty_cart.png" alt="Empty cart" class="img-fluid" style="height:200px;">
             <p class="font-baloo font-size-16 text-black-50">Empty Orders</p>
           </div>
         </div>
         <!-- !Empty Cart -->
       </div>
       <!-- !cart item -->

     </div> <!-- !end of row -->
    <!-- !shopping cart items -->
  </div><!-- !end of container -->
</section>
<!--!Shopping cart-->
