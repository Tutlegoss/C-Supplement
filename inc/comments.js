
/* In case of comment insertion error, restore state of comment */
function replaceText(comment, commentNum)
{
    if(commentNum !== 'null')
    {
        var clickReply = "#reply" + commentNum + " span.replyLink";
        var textBox = "#reply" + commentNum + "form textarea";

        var index = -1;
        $('.replyLink').each(function() {
            ++index;
            if($(this).parent().attr('id').substr(5) == commentNum)
                return false;
        });

        /* Found the proper reply button to click and repopulate the textarea */
        if(index != -1)
        {
            $('.replyLink')[index].click();
            $(textBox).val(comment);
        }
    }
    else
    {
        $('#actionString textArea').val(comment);
    }

    return;
}


/* Wait until page is fully done loading before executing any JS */
$(document).ready(function() {

    /* Dynamic textareas that move with amount of text */
    $(document).on('input', 'textarea', function() {
        $(this).css('height', "45px");
        $(this).css('height', this.scrollHeight + "px");
    });

    /*
        Practice with a closure. This creates a reply area and removes an existing
        reply area if another one is requested.
    */
    var update = (function(current, parentEntryNum) {

        /* Preserve previous reply area's details */
        var preReplyBtn = undefined;
        var parentNum = 0;

        /* Removal and Insertion */
        return function(current, parentEntryNum) {
            /* Execute when a different reply button has been clicked */
            if((preReplyBtn != undefined) && (parentNum != parentEntryNum))
            {
                /* Reinstate clickableness of old, remove old, disable clickableness of new */
                $(preReplyBtn).css('pointer-events', '');
                $('.removalReply').remove();
            }
            /* Update to new */
            current.eq(0).css('pointer-events', 'none');
            preReplyBtn = current.eq(0);
            parentNum = parentEntryNum;
        };

    })(); /* Self-invoking function */

    /* Corresponding event to above */
    $('.replyLink').on('click', function() {

        /* Setup for new reply form */
        var parentID = $(this).parent().attr('id');
        var parentEntryNum = parentID.substr(5);
        var actionString = $('#actionString').attr('action');
        var formID = parentID + "form";
        /* reply HTML and insert after the reply button */
        var html = '<form class="mt-2 removalReply" id="' + formID + '" action="' + actionString + '" method="POST">'
                   + '<textarea class="form-control col-12 col-md-8 col-lg-6 commentEntry comment" \
                       name="comment" placeholder="Enter Comment... 4096 max chars" maxlength="4096"></textarea>'
                   + '<input type="hidden" name="parentNum" value="' + parentEntryNum + '">'
                   + '<button type="submit" class="btn btnBlue btn-block col-3 col-lg-1 mt-2 mb-2">Submit</button>'
                + '</form>';

        /* Call closure function */
        update($(this), parentEntryNum);
        /* Display new reply area*/
        $('#' + parentID).after(html);

    });
});
