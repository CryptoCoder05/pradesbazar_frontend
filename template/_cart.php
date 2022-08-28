<?php
if (!is_login()) {
  redirect('login.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // delete item from cart...
  if (isset($_POST['delete-cart-submit'])) {
    $deletedrecord = $cart->deleteCart($_POST['item_id'],'cart',$customer_id);
  }

  // save for Later
  if (isset($_POST['wishlist-submit'])) {
    $cart->saveForLater($_POST['item_id'],'cart',1);
  }

  // place an order
  if (isset($_POST['place_an_order'])) {
    require './form-action/shipping-process.php';
  }
}
 ?>
<!--Shopping cart-->
<section id="cart" class="py-3 mb-5">
  <div class="container-fluid w-75">
    <h5 class="font-baloo font-size-20">Shopping Cart</h5>
    <!-- shopping cart items -->
     <div class="row">
       <!-- cart item -->
       <div class="col-sm-8">
         <?php
           $subTotal = 0;
           $i = 0;

           // get data from cart...
           foreach ($Cart->getItemCart('cart','wishlist',0,$customer_id) as $cart_item):
            $i++;
            $qty = $cart_item['qty'];

            // get data from product using cart-items
            $prod_item = $product->getProduct($cart_item['items']);
            foreach ($prod_item as  $item):

              // get size from product...
              $size = $Product->getProdSize($item['sizes']);
          ?>
         <!-- cart item-->
          <div class="row border-top py-3 mt-3">
            <!-- image--------->
            <div class="col-sm-2" >
              <?php $photo = explode(',',$item['image']) ?>
              <img src="<?=$photo[0];?>" style="height:120px;" alt="cart1" class="img-fluid">
            </div>
            <!-- end of image-->

            <div class="col-sm-8">
              <h6 class="font-baloo font-size-20"><?=$item['title'].'('.$size[0].')';?></h6>
              <small><?=$Product->getBrand($item['id']);?></small>

              <!-- product rating
              <div class="d-flex">
                <div class="rating text-warning font-size-12">
                  <span><i class="fas fa-star"></i></span>
                  <span><i class="fas fa-star"></i></span>
                  <span><i class="fas fa-star"></i></span>
                  <span><i class="fas fa-star"></i></span>
                  <span><i class="far fa-star"></i></span>
                </div>
                <a href="#" class="px-2 font-rale font-size-14">20,534 ratings
                </a>
              </div>
              <! !product ratings -->

              <!-- product qty -->
               <div class="qty d-flex pt-2 mb-2">
                <div class="d-flex font-rale" style="width:150px;">
                  <button data-id="<?=$item['id'];?>" type="button" name="button" class="qty-up border bg-light"><i class="fas fa-angle-up"></i></button>
                  <input data-id="<?=$item['id'];?>" type="text" form="ship_add" name="<?=$item['id'];?>" value="<?=(isset($qty))?$qty:'1';?>" placeholder="1" class="qty_input border px-2 w-50 bg-light text-center" disabled>
                  <button data-id="<?=$item['id'];?>" type="button" name="button" class="qty-down border bg-light"><i class="fas fa-angle-down"></i></button>
                </div>
               </div>
              <!-- !product qty -->

              <!-- delete row -->
               <div class="row">
                <form method="post">
                  <input type="hidden" name="item_id" value="<?=$item['id'];?>">
                  <button type="submit" name="delete-cart-submit" class="btn font-baloo text-danger px-3 border-right">Delete</button>
                </form>
                <form method="post">
                  <input type="hidden" name="item_id" value="<?=$item['id'];?>">
                  <button type="submit" name="wishlist-submit" class="btn font-baloo text-danger">Save for Later</button>
                </form>
               </div>
              <!-- !delete row -->
            </div>

            <div class="col-sm-2 text-right">
              <div class="font-size-20 text-danger font-baloo">
                Rs. <span class="product_price" data-id="<?=$item['id'];?>"><?=number_format($item['selll_price'] * $qty,2);?></span>
              </div>
            </div>
          </div>
         <!-- !cart item-->
         <?php
           $item_price = $item['selll_price'] * $qty;
           $subTotal += $item_price;
         endforeach; // !foreach for product table
       endforeach; // !foreach for cart table
          ?>
       </div>
       <!-- !cart item -->

       <!-- subtotal -->
       <div class="col-sm-4 sub-price">
        <div class="sub-total text-center mt-2 border">
         <h6 class="font-size-12 font-rale text-success py-3 "><i class="fas fa-check"></i> Your order is eligible for free Delivery</h6>
         <div class="border-top py-4">
           <h5 class="font-baloo font-size-20">
             Subtotal(<?=$i;?> items):&nbsp
             <span class="text-danger">Rs.
               <span class="text-danger" id="deal-price">
                 <?=(isset($subTotal))?number_format($subTotal,2):money(0);?>
               </span>
             </span>
           </h5>
          <a href="#shipping" class="btn btn-warning mt-3" >Proceed to Buy</a>
         </div>
        </div>
       </div>
       <!-- !subtotal -->

     </div> <!-- !end of row -->
    <!-- !shopping cart items -->
  </div><!-- !end of container -->
</section>
<!--!Shopping cart-->
