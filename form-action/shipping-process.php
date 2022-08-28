<?php
// error variable
$error = array();
$address = array();
$payment_detals = array();

// shipping address
$firstName = sanitize($_POST['firstName']);
if (empty($firstName)) {
  $error[] = "You forgot to enter your first Name!";
}

$lastName = sanitize($_POST['LastName']);
if (empty($lastName)) {
  $error[] = "You forgot to enter your last Name!";
}

$country = sanitize($_POST['country']);
if (empty($country)) {
  $error[] = "You forgot to enter your Country Name!";
}

$district = sanitize($_POST['district']);
if (empty($district)) {
  $error[] = "You forgot to enter your District Name!";
}

$city = sanitize($_POST['city']);
if (empty($city)) {
  $error[] = "You forgot to enter your Town/City Name!";
}

$village = sanitize($_POST['village']);
if (empty($village)) {
  $error[] = "You forgot to enter your Street/Village Name!";
}

$address = array(
  'first_name' => $firstName,
  'last_name'  => $lastName,
  'country'    => $country,
  'district'   => $district,
  'city'       => $city,
  'village'    => $village,
);


// prduct details
$cart_data = $Cart->getItemAnd('cart','user_id',$user_id,'wishlist','0');
foreach ($cart_data as $prod) {
  $prod_details[] = array(
    'prod_id'   => $prod['items'],
    'qty'       => $prod['qty'],
    'size'      => $prod['size'],
    'seller_id' => $prod['seller_id']
  );
}

// price details...
$subtotal = sanitize($_POST['subtotal']);
$delivery = sanitize($_POST['delivery']);
$discount = sanitize($_POST['discount']);
$total = sanitize($_POST['total']);

$payment_detals = array(
  'subtotal' => $subtotal,
  'delivery' => $delivery,
  'discount' => $discount,
  'total'    => $total,
);

// data have to insert in trasaction table...
$phone = sanitize($_POST['phone']);
if (empty($phone)) {
  $error[] = "You forgot to enter Phone no.!";
}

$prod_json = json_encode($prod_details);

$add_json = json_encode($address);

$pay_det_json = json_encode($payment_detals);

$pay_mode = (isset($_POST['pay_mode']))?$_POST['pay_mode']:'COD';

// check errors...
if (empty($error)) {
  $query = "INSERT INTO `transactions`(`customer_id`, `prod_details`, `address_details`, `phone_no`, `payment_details`, `payment_mode`)
                               VALUES ('$customer_id','$prod_json','$add_json','$phone','$pay_det_json','$pay_mode')";
  $run_query = $con->query($query);

  if ($run_query === true) {
    // update sizes in product...
    foreach ($cart_data as $prod_id) {
      // get prod_data from product table using cart-items...
      $prod_result = $Product->getProduct($prod_id['items']);
      // get product size from product table
      $prod_size = $Product->getProdSize($prod_result[0]['sizes']);
      $remaning_qty = $prod_size[1] - $prod_id['qty'];
      // update qty in product table
      $update_succ = $Product->updateSize($prod_result[0]['sizes'],$remaning_qty,$prod_id['items']);
      if ($update_succ === true) {
        $delete_succ = $Cart->deleteCart($prod_id['items'],'cart',$customer_id);
        if ($delete_succ === true) {
          redirect('order.php?success=1');
        }
      }
    }
  }else {
    echo display_msg('Erroe while Placing Order...!');
  }

}else {
  echo display_error($error);
}
 ?>
