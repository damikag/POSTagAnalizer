<?php
$results = $this->searchResults ;
// dnd($results);
?>
<?php $this->start('body'); ?>



<div class="container bg-dark text-white">


    <div>

        <div class="row">


            <div class="col-sm " style="margin: 10px; padding-top: 10px;padding-bottom: 10px;">

                <div class="col">
                     <div style="height:400px; overflow-x:auto;" class="table-wrapper-scroll-y my-custom-scrollbar">

                        <table class="table table-dark"  style="width:50%">
                            <tr>

                                <th>ID</th>
                                <th>Word</th>
                                <th>Tag</th>

                            </tr>

                            <?php if(count($results)):?>
                                <?php foreach($results as $result): ?>

                                    <tr>
                                        <td><?=$result->ID?></td>
                                        <td><?=$result->Word?></td>
                                        <td><?=$result->Tag?></td>
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

        </div>

    </div>



</div>
<?php $this->end(); ?>
