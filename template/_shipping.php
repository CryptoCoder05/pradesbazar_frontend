<section id="shipping" class="py-3 mb-0">
  <div class="container">
    <h4 class="font-baloo font-size-20">Checkout</h4><hr>
    <div class="pb-2">
      <small id="errors" class="text-danger font-ubuntu"></small>
    </div>
    <div class="row m-0">
          <!-- !Billing details -->
          <div class="col-md-6">
            <h4 class="text-center font-baloo font-size-20">Shipping address</h4><hr>
            <div class="" id="reg-form">
              <div class="form-row">
                <div class="col">
                  <input type="text" form="ship_add" name="firstName" id="firstName" class="form-control" placeholder="First Name" value="<?=(isset($_POST['firstName']))?$_POST['firstName']:'';?>" >
                </div>
                <div class="col">
                  <input type="text" form="ship_add" name="LastName" id="lastName" class="form-control" placeholder="Last Name" value="<?=(isset($_POST['LastName']))?$_POST['LastName']:'';?>" >
                </div>
              </div>
              <div class="form-row my-4">
                <div class="col">
                  <input type="text" form="ship_add" name="country" id="country" class="form-control" placeholder="Country" value="<?=(isset($_POST['country']))?$_POST['country']:'';?>" >
                </div>
                <div class="col">
                  <input type="text" form="ship_add" name="district" id="district" class="form-control" placeholder="District" value="<?=(isset($_POST['state']))?$_POST['state']:'';?>" >
                </div>
              </div>
              <div class="form-row my-4">
                <div class="col">
                  <input type="text" form="ship_add" name="city" id="city" class="form-control" placeholder="Town/City" value="<?=(isset($_POST['city']))?$_POST['city']:'';?>" >
                </div>
              </div>

              <div class="form-row my-4">
                <div class="col">
                  <input type="text" form="ship_add" name="village" id="village" class="form-control" placeholder="Street/Village/Ward no." value="<?=(isset($_POST['village']))?$_POST['village']:'';?>" >
                </div>
              </div>

              <div class="form-row my-4">
                <div class="col">
                  <input type="text" form="ship_add" name="phone" id="phone" class="form-control" placeholder="Phone*" value="<?=(isset($_POST['phone']))?$_POST['phone']:'';?>" >
                </div>
              </div>
            </div>
          </div>
         <!-- !Billing details -->
         <!-- payment details -->
          <div class="col-md-6">
           <h4 class="text-center font-baloo font-size-20">Payment Details</h4>
            <div class="mt-2 border px-3">
            <h4 class="font-baloo py-3 ml-2 font-size-20"> Cart Total</h4>
            <div class="d-flex pb-2">
              <div class="col-6">
                <h4 class="font-baloo font-size-20 text-black-50">Subtotal</h4>
              </div>
              <div class="col-6">
                <input type="hidden" form="ship_add" name="subtotal" value="<?= isset($subTotal)? $subTotal:0?>">
                <h4 class="font-baloo font-size-20 text-black-50" id="deal-price_ship_adr"><?= isset($subTotal)?money($subTotal):money(0)?></h4>
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
              <input type="radio" form="ship_add" name="pay_mode" class="form-radio-input" value="COD" required>
              <label for="payment_method" class="form-radio-label font-ubuntu text-black-50">Cash On Delivery</label>
            </div>
            <div class="form-check form-check-inline ml-3 mt-3">
              <input type="checkbox" form="ship_add" name="aggreement" class="form-check-input" required>
              <label for="aggreement" class="form-check-label font-ubuntu text-black-50">I agree <a href="#">term,conditions,and policy</a>(*)</label>
            </div>
            <div class="submit-btn text-center py-5">
              <form id="ship_add" action="cart.php" method="POST">
                <button type="submit" name="place_an_order" id="place_an_order" class="btn btn-warning rounded-pill text-dark px-5">Place an Order</button>
              </form>
            </div>
            </div>
          </div>
          <!-- !payment details -->
    </div><!-- !row -->
  </div>
</section>
