<?php
ob_start();

// maintanance page...
//include 'maintenance.php';

// header.....................
include_once 'include/header.php';
?>

<!-- main body -->
<?php
 /* Banner area */
 //include_once "template/_banner-area.php";
/* !Banner area */

/* top-sale */
include "template/_top-sale.php";
/* !top-sale */

/* Electronics item */
include "template/_electronics.php";
/* !Electronics item*/

/* Home kitchen */
include "template/_home_kitchen.php";
/* !Home kitchen */

/* Men fashion */
include "template/_men_fashion.php";
/* !Men fashion */

/* Women fashion */
include "template/_women_fashion.php";
/* !Women fashion */

/* Cosmetic item */
include "template/_cosmetic.php";
/* !Cosmetic item */

/* new-phone */
//include "template/_new-product.php";
/* !new-phone */

/* Special price using isotope */
//include_once "template/_special-price.php";
/* !Special price using isotope */

/* banner-ads */
//include_once "template/_banner-ads.php";
/* !banner-ads */



/* blogs */
//include_once "template/_categories.php";
/* !blogs */
?>
<!-- !main body -->

<?php
// footer.......................
include_once 'include/footer.php';
?>
