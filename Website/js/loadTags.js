function loadTags(word)
{
    $( '#display_tags' ).empty();
    $( '#display_tagIDs' ).empty();
    $( '#display_tags' ).append("<h6>Tags for word "+word+"</h6>");
    if(word)
    {
        $.ajax({
            type: 'post',
            url: 'loadtags',
            data: {
                word:word,
            },
            success: function (response) {
                $( '#display_tags' ).empty();
                $( '#display_tagIDs' ).empty();
                $( '#display_tags' ).append("<h6>Tags for word "+word+"</h6>");
                $( '#display_tags' ).append(response);
            }
        });
    }

}

function loadTagIDs(word,tag,pgNum)
{
    $( '#display_tagIDs' ).empty();
    $( '#display_tagIDs' ).append("<h6>Locations for Word: "+word+" and Tag: "+tag+"</h6>");
    if(word)
    {
        $.ajax({
            type: 'post',
            url: 'loadtagIDs',
            data: {
                word:word,
                tag:tag,
                pgNumber:pgNum,
            },
            success: function (response) {
                $( '#display_tagIDs' ).empty();
                $( '#display_tagIDs' ).append("<h6>Locations for Word: "+word+" and Tag: "+tag+"</h6>");

                $( '#display_tagIDs' ).append(response);
            }
        });
    }

}

function loadTagWordsFull(tag,pgNum)
{
    $( '#display_tagWords' ).empty();
    $( '#display_tagIDs' ).empty();
    $( '#display_tagWords' ).append("<h6>Processing... Wait for the Tag: "+tag+"</h6>");
    if(tag)
    {
        $.ajax({
            type: 'post',
            url: 'loadtagWordsFull',
            data: {
                tag:tag,
                pgNumber: pgNum,
            },
            success: function (response) {
                $( '#display_tagWords' ).empty();
                $( '#display_tagWords' ).append("<h6>Words tagged with: "+tag+"</h6>");
                $( '#display_tagWords' ).append(response);
            }
        });
    }

}

