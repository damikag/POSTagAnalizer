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


    <h1 class="text-center"> Unique Words in the Corpus</h1>

    <div class="row">
        <div class="col-sm" style="margin: 10px; padding-top: 10px;padding-bottom: 10px;">

            <div class="row">
                <h4>Select a page</h4>
                <div style="height:100px; overflow-x:auto;" class="table-wrapper-scroll-y my-custom-scrollbar">



                        <?php if(count($results)):?>


                            <?php for ($i=1; $i<=$total_pages; $i++) {?>
                                <a href='word?page=<?=$i?>'><?=$i?>  </a>
                            <?php };?>
                        <?php else: ?>
                            <div>
                                <h1>NO results</h1>
                            </div>
                        <?php endif; ?>


                </div>
            </div>

            <br>

            <div class="row">

                <div style="height:800px; overflow-x:auto;" class="table-wrapper-scroll-y my-custom-scrollbar">
                    <h4>Select a word</h4>
                    <br>
                    <table class="table table-dark"  >
                        <tr>

                            <th>ID</th>
                            <th>Word</th>


                        </tr>

                        <?php if(count($results)):?>
                            <?php foreach($results as $result): ?>

                                <tr>
                                    <td><?=$result->ID?></td>
                                    <td><a href='#' class="text-white" onclick="loadTags(<?="'".$result->Word."'"?>);return false;"><?=$result->Word?>  </a></td>
                                </tr>



                            <?php endforeach;?>

                        <?php else: ?>
                            <div>
                                <h1>NO results</h1>
                            </div>
                        <?php endif; ?>
                    </table>

                    <br>

                </div>
            </div>


        </div>

        <div class="col-sm" >
            <div >
                <br>
                <br>
                <div id="display_tags" style="height:300px; overflow-x:auto;" class="table-wrapper-scroll-y my-custom-scrollbar">

                </div>

                <div id="display_tagIDs" style="height:400px; overflow-x:auto;" class="table-wrapper-scroll-y my-custom-scrollbar">

                </div>

            </div>


        </div>

    </div>



</div>
<?php $this->end(); ?>
