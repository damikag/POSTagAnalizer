function loadTags(word)
{
    $( '#display_tags' ).empty();
    $( '#display_tagIDs' ).empty();
    $( '#display_tags' ).append("<p>Tags for for word "+word+"</p>");
    if(word)
    {
        $.ajax({
            type: 'post',
            url: 'loadtags',
            data: {
                word:word,
            },
            success: function (response) {
                $( '#display_tags' ).append(response);
            }
        });
    }

}

function loadTagIDs(word,tag)
{
    $( '#display_tagIDs' ).empty();
    $( '#display_tagIDs' ).append("<p>Locations for Word: "+word+" and Tag: "+tag+"</p>");
    if(word)
    {
        $.ajax({
            type: 'post',
            url: 'loadtagIDs',
            data: {
                word:word,
                tag:tag,
            },
            success: function (response) {
                $( '#display_tagIDs' ).append(response);
            }
        });
    }

}

