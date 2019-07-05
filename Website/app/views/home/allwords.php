<?php
$results = $this->searchResults ;
// dnd($results);
$total_pages=$this->total_pages;
?>
<?php $this->start('body'); ?>


<div class="container bg-dark text-white" >


    <h1 class="text-center"> All Words in the Corpus</h1>

            <div class="col-sm " style="margin: 10px; padding-top: 10px;padding-bottom: 10px;">


                     <div style="height:800px; overflow-x:auto;" class="table-wrapper-scroll-y my-custom-scrollbar">

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

                                <?php for ($i=1; $i<=$total_pages; $i++) {?>
                                    <a href='allwords?page=<?=$i?>'><?=$i?>  </a>
                               <?php };?>
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
