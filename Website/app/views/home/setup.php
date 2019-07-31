<?php
$results = $this->searchResults ;
// dnd($results);
$total_pages=$this->total_pages;
$msg=$this->msg;
$success=$this->_success;
?>
<?php $this->start('head'); ?>
<script type="text/javascript" src="<?=PROOT?>js/loadTags.js"></script>
<?php $this->end(); ?>

<?php $this->start('body'); ?>


<div class="container bg-dark text-white" >

    <br>
    <h1 class="text-center"> Setup</h1>
    <br>
    <div class="row">
        <div class="col-10" style=" background-color: #5e5e5e; padding: 10px;" >
            <h5>Select the corpus and click load</h5>

            <ul>
                <li>Each line of the corpus should be in the format [word][space][tag].<br>If not manually correct them before load </li>
            </ul>
        </div>

    </div>

    <br>
    <div class="col-10" style=" background-color: #3c4a62; padding: 10px;">
        <form action="<?=PROOT?>home/setup" id="form" method="post" enctype="multipart/form-data">
            <input type="file" name="filePath[]" id="filePath" multiple=""/>
            <button type="submit" class="btn btn-primary"  name="load-submit"    id = "load-submit">Load</button>
        </form>
    </div>


    <br>

    <div >
        <?php if($msg):?>

<!--            <ul>-->
            <?php foreach ($msg as $message):?>
<!--                <li><h6>--><?//=$message?><!--  </h6><br></li>-->
                <?php if($success):?>
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?=$message?>
                    </div>
                <?php else:?>
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?=$message?>
                    </div>
                <?php endif;?>

            <?php endforeach;?>

<!--            </ul>-->
        <?php else:?>
            <h6></h6>
        <?php endif;?>

    </div>

</div>
<?php $this->end(); ?>
