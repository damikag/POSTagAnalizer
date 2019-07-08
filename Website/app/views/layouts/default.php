<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
<!--      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">-->

  <script src="<?=PROOT?>js/vendor/jquery-1.12.4.min.js"></script>
  <script src="<?=PROOT?>js/vendor/bootstrap.min.js"></script>  
  <script src="<?=PROOT?>js/vendor/modernizr-2.8.3.min.js"></script>
<!--  <script src="--><?//=PROOT?><!--app/lib/sweetalert-master/docs/assets/sweetalert/sweetalert.min.js"></script>-->
<!--  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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