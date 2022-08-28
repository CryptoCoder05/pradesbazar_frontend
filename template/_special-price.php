<?php
shuffle($product_shuffle);
//request method post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (isset($_POST['special_price_submit'])) {
     if (is_login()) {
       // call method addToCart...
       $Cart->addToCart($user_id,$_POST['item_id'],$_POST['size'],$_POST['seller_id']);
      }else {
        redirect('login.php');
      }
  }
}

$in_cart = $cart->getCartId($Cart->getItemCart('cart','wishlist',0,$user_id));

// get brand name...
 $brand_id = array_map(function($pro){
  $brand_id = $pro['brand'];
  return $brand_id;
},$product_shuffle);

// call method from brand class...
$brand_name = $Brand->getBrandName($brand_id);

$unique_brand_name = array_unique($brand_name);
natcasesort($unique_brand_name);
 ?>

<!--Special price using isotope-->
<section id="special-price">
  <div class="container">
    <h4 class="font-rubik font-size-20">Special Price</h4>

    <div class="grid">
      <?php
       foreach ($product_shuffle as $item):
         $sizestring = $item['sizes'];
         $sizestring = rtrim($sizestring,',');
         $size_array = explode(',',$sizestring);

         foreach($size_array as $string) {
           $string_array = explode(':', $string);
           $size = $string_array[0];
         }

        ?>
        <div class="grid-item border col-md-2 px-0">
         <div class="item pb-2">
           <div class="product font-rale text-center">
             <?php
               $photo = explode(',',$item['image']);
              ?>
             <a href="product.php?item_id=<?=$item['id'];?>"><img src="<?=$photo[0];?>" alt="product 1" class="img-fluid img-h-220"></a>
             <div class="text-center">
               <h6><?=substr($item['title'], 0,35)."...";?></h6>
               <!--product price-->
               <p class="font-size-20 text-danger" style="margin:0;"><?=money($item['selll_price']);?></p>
               <p class="font-size-14"><strike><?=money($item['mrp_price']);?></strike></p>
               <!--!product price-->
               <form method="post">
                 <input type="hidden" name="item_id" value="<?=$item['id'];?>">
                 <input type="hidden" name="size" value="<?=$size;?>">
                 <input type="hidden" name="seller_id" value="<?=$item['user_id'];?>">

                 <?php
                   if (in_array($item['id'], $in_cart ?? [])) {
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
        </div>
        <?php
          endforeach;
        ?>
    </div>
  </div>
</section>
<!--!Special price using isotope-->
