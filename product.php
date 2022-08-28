<?php
ob_start();
// header...
include_once 'include/header.php';
?>

<!-- main body -->
<?php
 /* product */
 include_once "template/_product.php";
/* !product */

/* top-sale */
include_once "template/_top-sale.php";
/* !top-sale */
?>
<!-- !main body -->

<?php
// footer...
include_once 'include/footer.php';
?>
