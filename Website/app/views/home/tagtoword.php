<?php
$results = $this->searchResults ;
// dnd($results);
$total_pages=$this->total_pages;
$tagList=$this->tagList;

?>
<?php $this->start('head'); ?>
<script type="text/javascript" src="<?=PROOT?>js/loadTags.js"></script>
<?php $this->end(); ?>

<?php $this->start('body'); ?>


<div class="container bg-dark text-white" >


    <h1 class="text-center"> <a class="text-white" href="tagtoword">Tag to Words in the Corpus</a></h1>


    <form action="<?=PROOT?>home/tagtoword" id="form" method="post" enctype="multipart/form-data">
        <input type="text" name="search_key">
        <button type="submit" class="btn btn-primary"  name="search-submit"    id = "search-submit">Search</button>
    </form>

    <div class="row">
        <div class="col-sm" style="width: 100%; margin: 10px; padding-top: 10px;padding-bottom: 10px;">

            <?php if(count($tagList)):?>
                <h4>Select a tag</h4>
                <br>
                <div style="height:300px; width: 80%; overflow-x:auto;" class="table-wrapper-scroll-y my-custom-scrollbar">

                    <ul>

                    <?php for ($i=0; $i<count($tagList); $i++) {?>
                        <li><a href='#' class="text-white" onclick="loadTagWordsFull(<?="'".$tagList[$i]."'"?>);return false;"><?=$tagList[$i]?>  </a></li>
                    <?php };?>

                    </ul>
                </div>
            <?php else: ?>
                <div>
                    <h5>Sorry! Tag not found</h5>
                </div>
            <?php endif; ?>

        </div>

        <div class="col-sm" >

            <div id="display_tagWords" style="height:500px; width: 100%; overflow-x:auto;" class="table-wrapper-scroll-y my-custom-scrollbar">

            </div>

        </div>

        <div class="col-sm" >

            <div id="display_tagIDs" style="height:500px; width: 100%; overflow-x:auto;" class="table-wrapper-scroll-y my-custom-scrollbar">

            </div>

        </div>

    </div>


    <div class="row">


    </div>



</div>
<?php $this->end(); ?>
