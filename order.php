<?php
ob_start();
// header...
include 'include/header.php';
?>

<!-- main body -->
<?php
 /* shoping cart */
 count($Cart->getItemAnd('transactions','customer_id',$customer_id))? include "template/_order.php" :  include "template/notfound/_order_notfound.php";
/* !shoping cart */

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
