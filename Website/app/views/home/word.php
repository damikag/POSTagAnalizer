<?php
$results = $this->searchResults ;
// dnd($results);
$total_pages=$this->total_pages;
?>
<?php $this->start('head'); ?>
<script type="text/javascript" src="<?=PROOT?>js/loadTags.js"></script>
<?php $this->end(); ?>

<?php $this->start('body'); ?>


<div class="container bg-dark text-white" >

    <br>
    <h1 class="text-center"> <a class="text-white" href="word">Unique Words with more than one tag in the Corpus</a></h1>
    <br>

    <form action="<?=PROOT?>home/word" id="form" method="post" enctype="multipart/form-data">
        <input type="text" name="search_key">
        <button type="submit" class="btn btn-primary"  name="search-submit"    id = "search-submit">Search</button>
    </form>

    <div class="row " style="padding-left: 2%;padding-right: 2%">


            <div class="col">

            <?php if(count($results) and $total_pages>=1):?>
                <h4>Select a page</h4>

                <div style="height:70px; overflow-x:auto;" class=" table-wrapper-scroll-y my-custom-scrollbar">


                    <?php for ($i=1; $i<=$total_pages; $i++) {?>
                        <a href='word?page=<?=$i?>'><?=$i?>  </a>
                    <?php };?>
                </div>
            <?php endif; ?>


            </div>

    </div>

    <div class="row">


        <div class="col-sm" style="margin: 10px; padding-top: 10px;padding-bottom: 10px;">







                        <?php if(count($results)):?>
                            <h4>Select a word</h4>

                            <div style="height:400px; overflow-x:auto;" class="table-wrapper-scroll-y my-custom-scrollbar">

                            <table class="table table-dark"  >
                            <tr>

                                <th>ID</th>
                                <th>Word</th>


                            </tr>
                            <?php foreach($results as $result):
                                $loadWord=$result->Word;?>
                                <?php if($result->Word=='\'\''):
                                    $loadWord="\'\'";
                                    elseif ($result->Word=='\''):
                                        $loadWord="\'";
                                    elseif ($result->Word=="\""):
                                        $loadWord='&quot';

                                    ?>

                                <?php endif; ?>
                                <tr>
                                    <td><?=$result->ID?></td>
                                    <td><a href='#' class="text-white" onclick="loadTags(<?="'".$loadWord."'"?>);return false;"><?=$result->Word?>  </a></td>
                                </tr>



                            <?php endforeach;?>
                            </table>
                </div>
                        <?php else: ?>
                            <div>
                                <h5>Sorry! Word not found</h5>
                            </div>
                        <?php endif; ?>


                    <br>





        </div>

        <div class="col-sm" >
            <div id="display_tags">

            </div>
<!--                <div id="display_tags" style="height:300px; overflow-x:auto;" class="table-wrapper-scroll-y my-custom-scrollbar">-->
<!---->
<!--                </div>-->


        </div>

        <div class="col-sm">
            <div id="display_tagIDs">

            </div>
<!--            <div id="display_tagIDs" style="height:300px; overflow-x:auto;" class="table-wrapper-scroll-y my-custom-scrollbar">-->
<!---->
<!--            </div>-->
        </div>

    </div>



</div>
<?php $this->end(); ?>
