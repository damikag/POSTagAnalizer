

<!-- Here $this means View class -->
<?php $this->setSiteTitle('POS Tag'); ?>
<?php
$results = $this->searchResults ;

?>
<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>



    <div class="container bg-dark text-white"  style="height: 100%;">

        <br>
        <h1 class="text-center"> POS Tag Analiser</h1>
        <br>
        <br>
        <a href="word" class="text-center text-white"><h3>Unique Word List</h3></a>
        <br>
        <a href="allwords" class="text-center text-white"><h3>Full Corpus</h3></a>
        <br>
        <a href="tag" class="text-center text-white"><h3>Unique Tag List</h3></a>
        <br>
        <a href="tagtoword" class="text-center text-white"><h3>Tag to Word List</h3></a>



    </div>

<?php $this->end(); ?>



