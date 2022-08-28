<?php

//request method post from add to cart
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (isset($_POST['product_submit'])) {
    if (is_login()) {
      // call method addToCart...
      $Cart->addToCart($user_id,$_POST['item_id'],$_POST['size'],$_POST['seller_id']);
    }else {
      redirect('login.php');
    }
  }
}

//request method post from process to buy
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (isset($_POST['proced_to_buy'])) {
    if (is_login()) {
      // call method addToCart...
      $Cart->addToCart($user_id,$_POST['item_id'],$_POST['size'],$_POST['seller_id']);
      redirect('cart.php');
    }else {
      redirect('login.php');
    }
  }
}

$item_id = $_GET['item_id']??1;
foreach ($product->getData() as $item) :
  if($item['id'] == $item_id):
    $size = $Product->getProdSize($item['sizes']);
 ?>
<!--Product-->
<section id="product" class="py-3">
  <div class="container">
    <div class="row">
      <!--Left side col-->
      <div class="col-sm-6 text-center">
        <div class="fotorama" data-loop="true" data-autoplay="true">
          <?php $photos = explode(',',$item['image']);
            foreach($photos as $photo): ?>
             <img src="<?= $photo; ?>" alt="<?= $item['title']; ?>" class="details img-responsive"/>
          <?php endforeach; ?>
        </div>
        <div class="form-row pt-4 font-size-16 font-baloo">
          <div class="col">
            <form method="post">
             <input type="hidden" name="item_id" value="<?=$item['id'];?>">
             <input type="hidden" name="size" value="<?=$size[0];?>">
             <input type="hidden" name="seller_id" value="<?=$item['user_id'];?>">
             <button type="submit" class="btn btn-danger form-control" name="proced_to_buy">Proceed to Buy</button>
            </form>
          </div>
          <div class="col">
            <form method="post">
              <input type="hidden" name="item_id" value="<?=$item['id'];?>">
              <input type="hidden" name="size" value="<?=$size[0];?>">
              <input type="hidden" name="seller_id" value="<?=$item['user_id'];?>">
              <?php
                if (in_array($item['id'], $cart->getCartId($Cart->getItemCart('cart','wishlist',0,$user_id))??[])) {
                  ?>
                  <button type="submit" class="btn btn-success font-size-16 form-control" disabled>In the Cart</button>
                  <?php
                }else {
                  ?>
                  <button type="submit" class="btn btn-warning font-size-16 form-control" name="product_submit">Add to Cart</button>
                  <?php
                }
               ?>
            </form>
          </div>
        </div>
      </div>
      <!--!Left side col-->

      <!--Right side col-->
      <div class="col-sm-6 py-5">
        <h5 class="font-baloo font-size-20"><?=$item['title'];?></h5>
        <small>Brand : <?=$Product->getBrand($item['id']);?></small>
        <hr class="m-0">

        <!--product price-->
        <table class="my-3">
          <tr class="font-rale font-size-14">
            <td>M.R.P :</td>
            <td><strike><?=money($item['mrp_price']);?></strike></td>
          </tr>
          <tr class="font-rale font-size-14">
            <td>Deal Price : </td>
            <td class="font-size-20 text-danger"><span> <?=money($item['selll_price']);?></span><small class="text-dark font-size-12">&nbsp&nbspInclusive of all taxes</small></td>
          </tr>
          <tr class="font-rale font-size-14">
            <td>You save : </td>
            <td><span class="font-size-16 text-danger"><?=money($item['mrp_price']-$item['selll_price']);?></span></td>
          </tr>
        </table>
        <!--!product price-->

        <!--policy-->
        <div id="policy">
          <div class="d-flex">
            <div class="return text-center mr-5">
              <div class="font-size-20 my-2 color-second">
                <span class="fas fa-retweet border p-3 rounded-pill"></span>
              </div>
              <a href="#" class="font-rale font-size-12">7 Days <br>Replacement</a>
            </div>
            <div class="return text-center mr-5">
              <div class="font-size-20 my-2 color-second">
                <span class="fas fa-truck border p-3 rounded-pill"></span>
              </div>
              <a href="#" class="font-rale font-size-12">Pradeshbazar <br>Deliverd</a>
            </div>
            <div class="return text-center mr-5">
              <div class="font-size-20 my-2 color-second">
                <span class="fas fa-check-double border p-3 rounded-pill"></span>
              </div>
              <a href="#" class="font-rale font-size-12">Quality <br>Checked</a>
            </div>
          </div>
        </div>
        <!--!policy-->
        <hr>

        <!--order details-->
        <div id="order-details" class="font-rale d-flex flex-column text-dark">
          <?php
            $date_01 = date_create(date('d-m-Y'));
            $date_03 = date_create(date('d-m-Y'));
            date_modify($date_01, '1 days');
            date_modify($date_03, '3 days');
            $add_one_day = date_format($date_01, "M-d");
            $add_three_day = date_format($date_03, "M-d");
           ?>
          <small>Delivery by : <?=$add_one_day;?> - <?=$add_three_day;?></small>
          <small>Sold by<a href="#"> Pradeshbazar </a></small>
        </div>
        <!--!order details-->

        <!--size-->
        <div class="size my-3">
          <h6 class="font-baloo">Size:</h6>
          <div class="d-flex justify-content-between w-75">
            <?php
             $size = $Product->getProdSize($item['sizes']);
             ?>
            <div class="font-rubik border p-2">
              <button type="button" name="button" class="btn p-0 font-size-14"><?=$size[0];?></button>
            </div>
          </div>
        </div>
        <!--!size-->
      </div>
      <!--!Right side col-->
    </div>
    <div class="row">
      <!--product Description-->
      <div class="col-12 my-3">
        <h6 class="font-rubik">Product Description</h6><hr>
        <p class="font-rale font-size-14"><?=$item['description'];?></p>
      </div>
      <!--!product Description-->
    </div>
  </div>
</section>
<!--!Product-->
<?php
endif;
endforeach
?>
