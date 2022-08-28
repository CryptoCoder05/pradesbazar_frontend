<!--Shopping cart-->
<section id="cart" class="py-3 mb-5">
  <div class="container-fluid w-75">
    <h5 class="font-baloo font-size-20">Shopping Cart</h5>
    <!-- shopping cart items -->
     <div class="row">
       <!-- cart item -->
       <div class="col-sm-9">
         <!-- Empty Cart -->
         <div class="row border-top py-3 mt-3">
           <div class="col-sm-12 text-center py-2">
             <img src="./assets/img/empty_cart.png" alt="Empty cart" class="img-fluid" style="height:200px;">
             <p class="font-baloo font-size-16 text-black-50">Empty Cart</p>
           </div>
         </div>
         <!-- !Empty Cart -->
       </div>
       <!-- !cart item -->
       <!-- subtotal -->
       <div class="col-sm-3">
        <div class="sub-total text-center mt-2 border">
         <h6 class="font-size-12 font-rale text-success py-3 "><i class="fas fa-check"></i> Your order is eligible for free Delivery</h6>
         <div class="border-top py-4">
           <h5 class="font-baloo font-size-20">Subtotal(<?=0;?> items):&nbsp <span class="text-danger">Rs.<span class="text-danger" id="deal-price">0</span></span></h5>
           <button type="submit"  class="btn btn-warning mt-3"name="button">Proceed to Buy</button>
         </div>
        </div>
       </div>
       <!-- !subtotal -->
     </div> <!-- !end of row -->
    <!-- !shopping cart items -->
  </div><!-- !end of container -->
</section>
<!--!Shopping cart-->
