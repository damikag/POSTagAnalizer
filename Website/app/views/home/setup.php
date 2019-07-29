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

    <br>
    <h1 class="text-center"> <a class="text-white" href="word">Setup</a></h1>
    <br>

    <div class="row">
        <div class="col">
            <h5>Select the corpus and click load</h5>

            <ul>
                <li>Each line of the corpus should be in the format [word][space][tag].<br>If not manually correct them before load </li>
            </ul>
        </div>

    </div>

    <br>
    <form action="<?=PROOT?>home/setup" id="form" method="post" enctype="multipart/form-data">
        <input type="file" name="filePath" id="fi<p>Select the courpus</p>lePath">
        <button type="submit" class="btn btn-primary"  name="load-submit"    id = "load-submit">Load</button>
    </form>

    <br>

    <div >
        <?php if($msg):?>
            <h4>Messages:</h4>
            <ul>
            <?php foreach ($msg as $message):?>
                <li><h6><?=$message?>  </h6><br></li>
            <?php endforeach;?>

            </ul>
        <?php else:?>
            <h6></h6>
        <?php endif;?>

    </div>

</div>
<?php $this->end(); ?>
