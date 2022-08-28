<?php
// require function file...
require 'functions.php';

// require helper file...
require 'helper.php';
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php require 'include/google_analytics.php'; ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Anirudh singh">
    <meta name="keywords" content="pradeshbazar,prades bazar,pardesh bazar,online shopping in nepal,e-commerce in nepal,online shopping in province no 1,online shopping in province no 2,online shopping in province no 3,online shopping in province no 4,online shopping in province no 5,online shopping in province no 6,online shopping in province no 7,online shopping with fast delivery,Trusted online shopping site in nepal,pardeshbazar,pradeshbazaar,best online shopping site in nepal,Best ecommerce in nepal,pradeshbazzar">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Pradeshbazar is Nepal's premier online shopping marketplace with active presence in all Provinces of Nepal. Pardesh Bazar, graciously, offers an excellent  customer experience, ease-of-purchase, dedicated customer care and hassle-free shopping and returns experience."/>
    <title>Pradeshbazar | Pradesh bazar | Online Shopping in Nepal | Best Online shopping in nepal</title>

    <link rel="icon" href="assets/fev.ico">
    <!--Bootstrap CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!--Owl carousel-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

    <!--Font Awesome CDN-->
    <script src="https://kit.fontawesome.com/594354d0d4.js" crossorigin="anonymous"></script>

    <!--sass stylesheet-->
    <link rel="stylesheet" href="style.css">

    <!--slick slider-->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <!--Custom stylesheet-->
    <link rel="stylesheet" href="./css/style.css">

    <!--Custom registration stylesheet-->
    <link rel="stylesheet" href="./css/reg-style.css">

    <!--jQuery lib-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <!-- Fotorama from CDNJS, 19 KB -->
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>


  </head>
  <body>
    <!-- header -->
    <header>

      <div class="container-fluid bg-info">
        <div class="row">
          <div class="col-md-2 text-center my-auto">
            <a href="index.php" class="navbar-brand">
                <img src="./assets/logo/Semi_Logo_Final.png" alt="pradesbazar"  class="img-fluid">
            </a>
          </div>
          <div class="col-md-10">
            <!--nav bar-->
              <nav class="navbar navbar-expand-sm navbar-light bg-info px-0 m-0">
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
               </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                  <ul class="navbar-nav m-auto font-rubik">
                    <li class="nav-item active">
                      <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="category.php" id="catlist_remove">Category <i class="fas fa-chevron-down"></i></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="order.php">Orders</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="about.php">About us</a>
                    </li>
                    <?php
                     if (isset($_SESSION['login'])){
                      $user = get_users_info($con,$_SESSION['login']);
                    ?>
                    <li class="nav-item">
                      <a href="#" class="nav-link">Hello <?=$user['full_name'];?></a>
                    </li>
                    <li class="nav-item">
                      <a href="register/logout.php" class="nav-link">Logout</a>
                    </li>
                    <?php
                     }else {
                    ?>
                    <li class="nav-item">
                      <a href="login.php" class="nav-link">login</a>
                    </li>
                    <li class="nav-item">
                      <a href="register.php" class="nav-link">Sign Up</a>
                    </li>
                    <?php
                     }
                    ?>
                  </ul>
                </div>
                <form class="font-size-14 font-rale px-2 py-2" method="post" style="margin-bottom:10px;">
                  <a href="cart.php" class="py-2 rounded-pill color-primary-bg">
                    <span class="font-size-16 px-2 text-white"><i class="fas fa-shopping-cart"></i></span>
                    <span class="px-3 py-2 rounded-pill text-dark bg-light"><?=(isset($_SESSION['login']))?count($Cart->getItem('cart','user_id',$user_id)):'0';?></span>
                  </a>
                </form>
              </nav>
            <!--!nav bar-->
            <!--search box-->
            <div class="strip d-flex justify-content-between pt-1 mb-1 bg-info">
                <div class="font-rale m-auto">
                  <form class="d-flex" action="search.php" method="POST">
                    <div>
                      <input class="form-control search-txt" type="text" size="200" name="search_value" placeholder="Search" aria-label="Search" required>
                    </div>
                    <div>
                      <button class="btn my-sm-0 search-btn" type="submit" name="search"><i class="fas fa-search"></i></button>
                    </div>
                  </form>
                </div>
            </div>
            <!--search box-->
          </div><!--!col-md-10-->
        </div><!--!row-->
      </div><!--!container-->

    </header>
   <!-- !header -->

   <!-- start main site -->
   <main id="main-site">
