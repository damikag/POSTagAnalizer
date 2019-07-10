<?php
$tagList = $this->searchResults ;
//dnd($tagList);
?>
<?php $this->start('body'); ?>


<div class="container bg-dark text-white" >


    <h1 class="text-center"> All Tags in the Corpus</h1>

    <div class="col-sm " style="margin: 10px; padding-top: 10px;padding-bottom: 10px;">


        <div style="height:800px; overflow-x:auto;" class="table-wrapper-scroll-y my-custom-scrollbar">

            <table class="table table-dark"  style="width:50%">
                <tr>
                    <th>Index</th>
                    <th>Tags</th>


                </tr>

                <?php if($tagList):?>
                    <?php for($i=0;$i<sizeof($tagList);$i++){ ?>

                        <tr>
                            <td><?=$i?></td>
                            <td><?=$tagList[$i]?></td>

                        </tr>



                    <?php }?>


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
<?php $this->end(); ?>
