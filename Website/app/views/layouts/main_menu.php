<?php
  $menu_file = 'menu_acl';
  $notifications = [];
  $userType = "Guest";

  $menu = Router::getMenu($menu_file);
  $currentPage = currentPage();
?>


<div class="container bg-secondary text-white mainmenu-area" id="mainmenu-area">
  <div class="mainmenu-area-bg"></div>
  <nav class="navbar">
    <div class="container">
      <div class="navbar-header">
        <a href="<?=PROOT?>home/index" class="navbar-brand text-white">Home</a>

        <a href="<?=PROOT?>home/word" class="navbar-brand text-white">Unique Words</a>

        <a href="<?=PROOT?>home/allwords" class="navbar-brand text-white">Full corpus</a>

        <a href="<?=PROOT?>home/tagtoword" class="navbar-brand text-white">Tags</a>
      </div>
    </div>
  </nav>
</div>

