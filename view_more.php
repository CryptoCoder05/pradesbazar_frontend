<?php
ob_start();
// header...
include_once 'include/header.php';
?>

<!-- main body -->
<?php
/* view more */
include_once "template/_view_more.php";
/* !view more*/

/* new-phone */
include_once "template/_new-product.php";
/* !new-phone */

/* blogs */
//include_once "template/_categories.php";
/* !blogs */
?>
<!-- !main body -->

<?php
// footer...
include_once 'include/footer.php';
?>
