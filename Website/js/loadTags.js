function loadTags(word)
{
    $( '#display_tags' ).append("<p>Please Enter Some Words</p>");
    if(word)
    {
        $.ajax({
            type: 'post',
            url: 'loadtags',
            data: {
                word:word,
            },
            success: function (response) {
                // We get the element having id of display_info and put the response inside it
                $( '#display_tags' ).append(response);
            }
        });
    }

    else
    {
        $( '#display_tags' ).append("<p>Please Enter Some Words</p>");
    }
}
