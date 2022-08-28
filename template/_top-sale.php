<?php
 shuffle($product_shuffle);

 //request method post
 if ($_SERVER['REQUEST_METHOD'] == "POST") {
   if (isset($_POST['top_sale_submit'])) {
     if (is_login()) {
       // call method addToCart...
       $Cart->addToCart($user_id,$_POST['item_id'],$_POST['size'],$_POST['seller_id']);
     }else {
       redirect('login.php');
     }
   }
 }
 ?>
<!--Top sale using owlCarousel-->
<section id="top-sale">
  <div class="container-fluid py-2">
      <h4 class="font-rubik font-size-20"><?=(isset($_GET['item_id']))?'You May also like':'Top sale';?></h4>
    <!-- Owl carousel-->
    <div class="owl-carousel owl-theme">
      <?php foreach ($product_shuffle as $item) {
       $size = $Product->getProdSize($item['sizes']);
      ?>
        <div class="item py-1" style="padding:5px;">
          <div class="product font-rale">
            <?php $photo = explode(',',$item['image']); ?>
            <a href="product.php?item_id=<?=$item['id'];?>"><img src="<?=$photo[0];?>" alt="product image" class="img-fluid img-h-220"></a>
            <div class="text-center">
              <!-- <h6><?=substr($item['title'], 0,35)."...";?></h6> -->
              <!--product price-->
              <p class="font-size-20 text-danger" style="margin:0;"><?=money($item['selll_price']);?></p>
              <p class="font-size-14"><strike><?=money($item['mrp_price']);?></strike></p>
              <!--!product price-->
              <form method="post">
                <input type="hidden" name="item_id" value="<?=$item['id'];?>">
                <input type="hidden" name="size" value="<?=$size[0];?>">
                <input type="hidden" name="seller_id" value="<?=$item['user_id'];?>">

                <?php
                  if (in_array($item['id'], $cart->getCartId($Cart->getItemCart('cart','wishlist',0,$user_id))??[])) {
                    ?>
                    <button type="submit" class="btn btn-success font-size-12" disabled>In the Cart</button>
                    <?php
                  }else {
                    ?>
                    <button type="submit" class="btn btn-warning font-size-12" name="top_sale_submit">Add to Cart</button>
                    <?php
                  }
                 ?>
              </form>
            </div>
          </div>
        </div>
      <?php } // End for foreach loop ?>
    </div>
    <!-- !Owl carousel-->
  </div>
</section>
<!--!Top sale-->
