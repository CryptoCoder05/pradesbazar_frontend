<?php
shuffle($product_shuffle);
//request method post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (isset($_POST['new_phone_submit'])) {
    if (isset($catgory_id)) {
      if (is_login()) {
        // call method addToCart...
        $Cart->addToCartByCat($catgory_id,$user_id,$_POST['item_id'],$_POST['size'],$_POST['seller_id']);
       }else {
         redirect('login.php');
       }
    }else {
      if (is_login()) {
        // call method addToCart...
        $Cart->addToCart($user_id,$_POST['item_id'],$_POST['size'],$_POST['seller_id']);
      }else {
        redirect('login.php');
      }
    }
  }
}
 ?>
<!--New phone-->
<section id="new-phones">
  <div class="container-fluid py-5">
    <h4 class="font-rubik font-size-20">New Product</h4><hr>
    <div class="row">
      <!-- Owl carousel-->
      <div class="owl-carousel owl-theme">
        <?php foreach ($product_shuffle as $new_price_item):
          $size = $Product->getProdSize($new_price_item['sizes']);
          ?>
          <div class="item py-2 bg-light" style="padding:5px;">
            <div class="product font-rale">
              <?php
                $photo = explode(',',$new_price_item['image']);
               ?>
              <a href="product.php?item_id=<?=$new_price_item['id'];?>"><img src="<?=$photo[0];?>" alt="product 1" class="img-fluid img-h-220"></a>
              <div class="text-center">
                <h6><?=substr($new_price_item['title'], 0,40);?></h6>
                <!--product price-->
                <p class="font-size-20 text-danger" style="margin:0;"><?=money($new_price_item['selll_price']);?></p>
                <p class="font-size-14"><strike><?=money($new_price_item['mrp_price']);?></strike></p>
                <!--!product price-->
                <form method="post">
                  <input type="hidden" name="item_id" value="<?=$new_price_item['id'];?>">
                  <input type="hidden" name="size" value="<?=$size[0];?>">
                  <input type="hidden" name="seller_id" value="<?=$new_price_item['user_id'];?>">

                  <?php
                    if (in_array($new_price_item['id'], $cart->getCartId($Cart->getItemCart('cart','wishlist',0,$user_id))??[])) {
                      echo '<button type="submit" class="btn btn-success font-size-12" disabled>In the Cart</button>';
                    }else {
                      echo '<button type="submit" class="btn btn-warning font-size-12" name="new_phone_submit">Add to Cart</button>';
                    }
                   ?>
                 </form>
              </div>
            </div>
          </div>
        <?php endforeach; // !for foreach loop ?>
      </div>
      <!-- !Owl carousel-->
    </div><!-- !row -->
  </div> <!-- !container-->
</section>
<!--!New phone-->
