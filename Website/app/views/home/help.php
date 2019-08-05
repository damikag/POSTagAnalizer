<?php
$results = $this->searchResults ;
// dnd($results);
?>
<?php $this->start('head'); ?>
<script type="text/javascript" src="<?=PROOT?>js/loadTags.js"></script>
<?php $this->end(); ?>

<?php $this->start('body'); ?>


<div class="container bg-dark text-white" >

    <br>
    <h1 class="text-center"> Help</h1>
    <br>

    <div class="col-10" style=" background-color: #3c4a62; padding: 10px;">

        <ul>
            <li><h5><a class="text-white" href="#stp">Initial setup/ Re-load corpus</a></h5></li>
            <li><h5><a class="text-white" href="#wtt">Unique word to Tag mapping</a></h5></li>
            <li><h5><a class="text-white" href="#ttw">Tag to Word mapping</a></h5></li>
        </ul>
    </div>

    <br>

    <div class="col-10" id="stp" style=" background-color: #4e555b; padding: 10px; align-content: center">
        <h3>Initial setup/ Re-load corpus</h3>
        <br>
        <p>At the very first use of this system you need to load the corpus into the system.
            When you edit the corpus you can re-load as you wish.</p>

        <ul>
            <li>Go to <a class="text-white" href="<?=PROOT?>home/setup">setup.</a></li>
            <li>Browse the corpus file(s) and click Load. It will take about 30 sec - 1 min depending on
            your corpus size.
            </li>
            <li>Note: Each line of the corpus should be in the format [word][space][tag]</li>
            <li>Success or failure will be displayed. </li>
            <li>If load failed your have to manually open the corpus and check whether format and character
            encoding are correct.</li>
        </ul>
    </div>
    <br>

    <div class="col-10" id="wtt" style=" background-color: #5e5e5e; padding: 10px;">
        <h3>Unique word to Tag mapping</h3>
        <br>
        <p>To use this feature you need to have successfully loaded the corpus. Here only unique words with multiple
        tags are displayed.</p>

        <ul>
            <li>Go to <a class="text-white" href="<?=PROOT?>home/word">Words.</a></li>
            <li>On your left there is a list of unique words. The length of the list is limited to 50 lines.
            Full list is loaded as pages. So to see other pages click the page numbers under the search bar.</li>
            <li>Unique words are alphabetically sorted. So you can browse words, page by page. Instead you can also
            search for a word using the search bar.</li>
            <li>Click on a word to get the list of tags where the selected word is tagged. Then a list of tags will be displayed
            at the middle with count - no of time that word-tag couple appear along with percentages that a certain tag is
            used for the selected word.</li>

            <li>Click on a tag to get the list of line numbers where the selected word-tag couple appears
            in the corpus.</li>

        </ul>
    </div>
    <br>

    <div class="col-10" id="ttw" style=" background-color: #4e555b; padding: 10px;">
        <h3>Tag to Word mapping</h3>
        <br>
        <p>To use this feature you need to have successfully loaded the corpus. Here words tagged for a certain
        tag can be found.</p>

        <ul>
            <li>Go to <a class="text-white" href="<?=PROOT?>home/tagtoword">Tags.</a></li>
            <li>On your left there is a list of tags. Tags are alphabetically sorted.</li>
            <li>You can use the search bar to search for a tag.</li>
            <li>Click on a tag to get the list of words where the selected tag is used. Then a list of words will be displayed
                at the middle.</li>

            <li>Click on a word to get the list of line numbers where the selected word-tag couple appears
                in the corpus.</li>

        </ul>
    </div>

</div>
<?php $this->end(); ?>
