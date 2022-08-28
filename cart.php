<?php
ob_start();
?>

<!-- main body -->
<section id="refress">
  <?php
  require 'include/header.php';
   /* shoping cart */
   count($Cart->getItemAnd('cart','wishlist',0,'user_id',$user_id))? include "template/_cart.php" :  include "template/notfound/_cart_notfound.php";
  /* !shoping cart */

  /* shipping address */
  include  "template/_shipping.php";
  /* !shipping address */

  /* wishlist */
  (count($Cart->getItem('cart','wishlist',1)) > 0)? include "template/_wishlist.php" :  '';
  /* !wishlist */

  /* new-phone */
  //include  "template/_top-sale.php";
  /* !new-phone */
  ?>
  <!-- !main body -->
  <?php
  // footer...
  include 'include/footer.php';
  ?>
</section>
