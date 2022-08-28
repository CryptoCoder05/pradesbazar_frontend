<?php

// require MySQL Connection class...
require '../functions.php';

// get product details...
if (isset($_POST['itemid'])) {
  $result = $product->getProduct($_POST['itemid']);
  echo json_encode($result);
}

// update cart qty...
if (isset($_POST['prod_id'])) {
  $prod_id = (isset($_POST['prod_id']))?$_POST['prod_id']:'';
  $qty = (isset($_POST['qty']))?$_POST['qty']:'';
  $con->query("UPDATE `cart` SET `qty`='$qty' WHERE items = '$prod_id' AND user_id = '$customer_id'");

// Fetch data from cart...
  $sql = "SELECT * FROM cart WHERE user_id = '$customer_id'";
  $query = $con->query($sql);
  $sub_total = 0;
  while ($result = mysqli_fetch_assoc($query)) {
    $product_id = $result['items'];
    $prod_sql = "SELECT * FROM product WHERE id = '$product_id'";
    $prod_res = $con->query($prod_sql);
    $prod_value = mysqli_fetch_assoc($prod_res);
    $prod_price = $prod_value['selll_price'];
    $item_qty = $result['qty'];
    $total = $prod_price * $item_qty;
    $sub_total += $total;
  }
  echo $sub_total;
}
?>
