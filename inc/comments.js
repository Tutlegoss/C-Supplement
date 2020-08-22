$(document).ready(function() {    
    $(document).on('input', 'textarea', function() {
        $(this).css('height', "45px");
        $(this).css('height', this.scrollHeight + "px");
    });
    
    $('.replyLink').on('click', function() {
        if($(this)[0].hasAttribute('disabled'))
            return;  
        else
        {
            $(this).attr('disabled','disabled');
            var parentID = $(this).parent().attr('id');
            var parentEntryNum = parentID.substr(5);
            var actionString = $('#actionString').attr('action');
            var formID = parentID + "form";

            $('#' + parentID).after('<form class="mt-2" id="' + formID + '" action="' + actionString + '" method="POST">');
            $('#' + formID).append('<textarea class="form-control col-12 col-md-8 col-lg-6 commentEntry comment" name="comment"  placeholder="Enter Comment... 4096 max chars" maxlength="4096"></textarea>');
            $('#' + formID).append('<input type="hidden" name="parentNum" value="' + parentEntryNum + '">');
            $('#' + formID).append('<button type="submit" class="btn btnBlue btn-block col-3 col-lg-1 mt-2 mb-2">Submit</button>');
            $('#' + formID).append('</form>');           
        }
    });
});