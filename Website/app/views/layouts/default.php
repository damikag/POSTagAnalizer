<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
<!--      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">-->
    <link rel="shortcut icon" type="image/ico" href="<?=PROOT?>img/favicon.png" />
	
    <!--====== STYLESHEETS ======-->
	<link rel="stylesheet" href="<?=PROOT?>css/normalize.css">
  <!-- <link rel="stylesheet" href="<?=PROOT?>css/normalize.css"> -->
  <link rel="stylesheet" href="<?=PROOT?>css/animate.css">
  <link rel="stylesheet" href="<?=PROOT?>css/stellarnav.min.css">
  <link rel="stylesheet" href="<?=PROOT?>css/owl.carousel.css">
  <link rel="stylesheet" href="<?=PROOT?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=PROOT?>css/font-awesome.min.css">
  <link rel="stylesheet" href="<?=PROOT?>css/imagehover.min.css">
  <link rel="stylesheet" href="<?=PROOT?>app/lib/sweetalert-master/src/sweetalert.css">

    <!--====== MAIN STYLESHEETS ======-->

  <link rel="stylesheet" href="<?=PROOT?>css/style2.css"> 
  <link rel="stylesheet" href="<?=PROOT?>css/style/style.css">
  <link rel="stylesheet" href="<?=PROOT?>css/responsive.css">
	<link rel="stylesheet" href="<?=PROOT?>css/ihover.css">

  <script src="<?=PROOT?>js/vendor/jquery-1.12.4.min.js"></script>
  <script src="<?=PROOT?>js/vendor/bootstrap.min.js"></script>  
  <script src="<?=PROOT?>js/vendor/modernizr-2.8.3.min.js"></script>
<!--  <script src="--><?//=PROOT?><!--app/lib/sweetalert-master/docs/assets/sweetalert/sweetalert.min.js"></script>-->
<!--  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->

  <title><?= $this->siteTitle(); ?></title>
  <?= $this->content('head'); ?>

  </head>
  <body>

    <!--- PRELOADER -->
    <div class="preeloader">
        <div class="preloader-spinner"></div>
    </div>

    <!--SCROLL TO TOP-->
    <a href="#home" class="scrolltotop"><i class="fa fa-long-arrow-up"></i></a>
  
    <div class="top-area-bg" data-stellar-background-ratio="0.6"></div>
    <div class="header-top-area">
        <?php include 'main_menu.php'  ?>
    </div>
    <?= $this->content('body'); ?>  
    <div >
      <?php include 'footer.php' ?>
    </div>

  </body>
</html>