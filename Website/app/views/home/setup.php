<?php
$results = $this->searchResults ;
// dnd($results);
$total_pages=$this->total_pages;
$msg=$this->msg;
?>
<?php $this->start('head'); ?>
<script type="text/javascript" src="<?=PROOT?>js/loadTags.js"></script>
<?php $this->end(); ?>

<?php $this->start('body'); ?>


<div class="container bg-dark text-white" >


    <h1 class="text-center"> <a class="text-white" href="word">Setup</a></h1>


    <form action="<?=PROOT?>home/setup" id="form" method="post" enctype="multipart/form-data">
        <input type="file" name="filePath" id="filePath">
        <button type="submit" class="btn btn-primary"  name="load-submit"    id = "load-submit">Load</button>
    </form>

    <div class="row">
        <?php if($msg):?>
            <?php foreach ($msg as $message):?>
                <h4><?=$message?>  </h4><br>
            <?php endforeach;?>
        <?php else:?>
            <h4>No message </h4>
        <?php endif;?>

    </div>

</div>
<?php $this->end(); ?>
