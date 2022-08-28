<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // delete from wishlist from cart...
  if (isset($_POST['delete-cart-submit'])) {
    $deletedrecord = $cart->deleteCart($_POST['item_id']);
  }
 // add to cart...
  if (isset($_POST['cart-submit'])) {
    $cart->saveForLater($_POST['item_id'], 'cart',0);
    redirect('cart.php');
  }
}
 ?>
<!--Shopping cart-->
<section id="cart" class="py-3 mb-5">
  <div class="container-fluid w-75">
    <h5 class="font-baloo font-size-20">Wishlist</h5>
    <!-- shopping cart items -->
     <div class="row">
       <!-- cart item -->
       <div class="col-sm-9">
         <?php
           $subTotal = 0;
           $i = 0;
           foreach ($cart->getItem('cart','wishlist',1) as $cart_item):
            $i++;
            $prod_item = $product->getProduct($cart_item['items']);
            foreach ($prod_item as  $item):
          ?>
         <!-- cart item-->
          <div class="row border-top py-3 mt-3">
            <div class="col-sm-2">
              <?php $photo = explode(',',$item['image']) ?>
              <img src="<?=$photo;?>" style="height:120px;" alt="cart1" class="img-fluid">
            </div>
            <div class="col-sm-8">
              <h5 class="font-baloo font-size-20"><?=$item['title'];?></h5>
              <small>By Samsung</small>
              <!-- product rating -->
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
              <!-- !product ratings -->

              <!-- product qty -->
               <div class="qty d-flex pt-2">
                <form method="post">
                  <input type="hidden" name="item_id" value="<?=$item['id'];?>">
                  <button type="submit" name="delete-cart-submit" class="btn font-baloo text-danger pl-0 pr-3 border-right">Delete</button>
                </form>

                <form method="post">
                  <input type="hidden" name="item_id" value="<?=$item['id'];?>">
                  <button type="submit"  name="cart-submit" class="btn font-baloo text-danger">Add to Cart</button>
                </form>
               </div>
              <!-- !product qty -->
            </div>
            <div class="col-sm-2 text-right">
              <div class="font-size-20 text-danger font-baloo">
                Rs. <span class="product_price" data-id="<?=$item['id'];?>"><?=$item['selll_price'];?></span>
              </div>
            </div>
          </div>
         <!-- !cart item-->
         <?php
           $item_price = $item['selll_price'];
           $subTotal += $item_price;
         endforeach; // !foreach for product table
       endforeach; // !foreach for cart table
          ?>
       </div>
       <!-- !cart item -->
     </div> <!-- !end of row -->
    <!-- !shopping cart items -->
  </div><!-- !end of container -->
</section>
<!--!Shopping cart-->
