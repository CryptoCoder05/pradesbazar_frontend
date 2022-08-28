<?php
if (!is_login()) {
  redirect('login.php');
}

 ?>

<section id="order" class="py-3 mb-5">
  <div class="container-fluid w-75">
    <h5 class="font-baloo font-size-20 text-<?=(isset($_GET['success']))?'success':'info';?>"><?=(isset($_GET['success']))?'Your Order has Been Placed.':'Your Orders';?></h5>

    <?php
    $subTotal = 0;
    $subTotal1 = 0;
    // get data from transaction table...
    foreach ($Transaction->getOrder($customer_id) as $orders):

       // get prod_details from transaction...
       $prod_det1 = json_decode($orders['prod_details'],true);
       foreach ($prod_det1 as $prod1){
        // get data from product using transaction-prod_details
        $prod_item1 = $product->getProduct($prod1['prod_id']);
        foreach ($prod_item1 as  $item1){
           $item_price1 = $item1['selll_price'] * $prod1['qty'];
           $subTotal1 += $item_price1;
        }
       }

      $payment_det = json_decode($orders['payment_details'],true);
      $add_det = json_decode($orders['address_details'],true);

      if($orders['pickup'] == 1){
         $staus = 'Your order has been pickup.';
      }else {
         $staus = 'Your order has been Processing.';
      }
      if($orders['dispatched'] == 1){
         $staus = 'Your order has been Dispatched.';
      }
      if($orders['delivered'] == 1) {
         $staus = 'Your order has been Deliverd.';
      }

     ?>

     <!-- orders items -->
     <div class="row border mb-3" style="border-radius:5px;">
       <!-- first row -->
       <div class="col-md-12 border" style="border-top-radius:5px;background-color:#f6f6f6;">
        <div class="row">
         <div class="col-sm-2 p-2">
          <div><span class="font-baloo">ORDER PLACED</span></div>
          <div><span class="font-baloo"><?=date_format(date_create($orders['txn_date']),'j F Y') ;?></span></div>
         </div>
         <div class="col-sm-2 p-2">
          <div><span class="font-baloo">TOTAL</span></div>
          <div><span class="font-baloo"><?=money($subTotal1);?></span></div>
         </div>
         <div class="col-sm-2 p-2">
          <div><span class="font-baloo">SHIP TO</span></div>
          <div><span class="font-baloo"><?=$add_det['first_name'];?></span></div>
         </div>
         <div class="col-sm-3"></div>
         <div class="col-sm-3 p-2">
          <div><span class="font-baloo">STATUS</span></div>
          <div><span class="font-baloo"><?=$staus;?></span></div>
         </div>
        </div>
       </div>
       <!-- End of first row -->

       <!-- customer item -->
       <div class="col-sm-8">
         <?php
            // get prod_details from transaction...
             $prod_det = json_decode($orders['prod_details'],true);
             foreach ($prod_det as $prod) :

             // get data from product using transaction-prod_details
              $prod_item = $product->getProduct($prod['prod_id']);
              foreach ($prod_item as  $item):

              // get size from product...
              $size = $Product->getProdSize($item['sizes']);
          ?>
         <!-- left side column-->
          <div class="row border-bottom py-3 mt-4">
            <div class="col-sm-2">
              <?php $photo = explode(',',$item['image']) ?>
              <img src="<?=$photo[0];?>" style="height:120px;" alt="cart1" class="img-fluid">
            </div>
            <div class="col-sm-7">
              <h5 class="font-baloo font-size-20"><?=$item['title'].'('.$size[0].')';?></h5>
              <small><?=$Product->getBrand($item['id']);?></small>
            </div>
            <div class="col-sm-3 text-right">
              <div class="font-size-20 text-danger font-baloo">
                Qty : <span class="product_price"><?=$prod['qty'];?></span>
              </div>
              <div class="font-size-20 text-danger font-baloo">
                 <span class="product_price"><?=money($item['selll_price'] * $prod['qty']);?></span>
              </div>
            </div>
          </div>
         <!-- !end of left side column-->
         <?php
           $item_price = $item['selll_price'] * $prod['qty'];
           $subTotal += $item_price;
           endforeach; // !foreach for prod_details from transactions table
           endforeach; // !foreach for product table
          ?>
       </div>
       <!-- !customer item -->

       <!-- subtotal -->
       <div class="col-sm-4">
         <h4 class="text-center font-baloo font-size-20">Payment Details</h4>
          <div class="mt-2 border px-3">
          <h4 class="font-baloo py-3 ml-2 font-size-20"> Cart Total</h4>
          <div class="d-flex pb-2">
            <div class="col-6">
              <h4 class="font-baloo font-size-20 text-black-50">Subtotal</h4>
            </div>
            <div class="col-6">
              <input type="hidden" form="ship_add" name="subtotal" value="<?= isset($subTotal)? $subTotal:0?>">
              <h4 class="font-baloo font-size-20 text-black-50" id="deal-price_ship_adr"><?= isset($subTotal)?money($subTotal):0?></h4>
            </div>
          </div>
          <div class="d-flex py-2">
            <div class="col-6">
              <h4 class="font-baloo font-size-20 text-black-50">Delivery</h4>
            </div>
            <div class="col-6">
              <input type="hidden" form="ship_add" name="delivery" value="<?=60;?>">
              <h4 class="font-baloo font-size-20 text-black-50"><?=money(60);?></h4>
            </div>
          </div>
          <div class="d-flex py-2">
            <div class="col-6">
              <h4 class="font-baloo font-size-20 text-black-50">Discount</h4>
            </div>
            <div class="col-6">
              <input type="hidden" form="ship_add" name="discount" value="<?=60;?>">
              <h4 class="font-baloo font-size-20 text-black-50"><?=money(60);?></h4>
            </div>
          </div>
          <div class="d-flex border-top py-3">
            <div class="col-6">
              <h4 class="font-baloo font-size-20 text-black-50">TOTAL</h4>
            </div>
            <div class="col-6">
              <input type="hidden" form="ship_add" name="total" value="<?=(isset($subTotal))?$subTotal:0;?>">
              <h4 class="font-baloo font-size-20" id="ship_adr_total"><?=(isset($subTotal))?money($subTotal):money(0);?></h4>
            </div>
          </div>

          <h4 class="font-baloo py-3 ml-2 font-size-20"> Payment Method</h4>
          <div class="form-radio form-radio-inline ml-3">
            <label for="payment_method" class="form-radio-label font-ubuntu text-black-50">Cash On Delivery</label>
          </div>
          <!--
          <div class="submit-btn text-center py-5">
            <form action="#" method="POST">
              <button type="submit" name="Track_an_order" id="Track_an_order" class="btn btn-warning rounded-pill text-dark px-5">Track Your Order</button>
            </form>
          </div>
         -->
          </div>
       </div>
       <!-- !subtotal -->

       </div><!-- end of orders items -->
       <?php
       endforeach; // !foreach for transaction table
       ?>
  </div><!-- !end of container -->
</section>
