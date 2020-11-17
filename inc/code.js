
	$(document).ready(function() {
		$('#add').click(function() {
			$('.form-group').append('<br>');
			$('.form-group').append('<textarea class="form-control ln col-1" rows="1"></textarea> \
			<textarea class="form-control sc col-10 ml-3" rows="1"></textarea>');
		});

		$('#del').click(function() {
			$('.form-group').children().last().remove();
			$('.form-group').children().last().remove();
			$('.form-group').children().last().remove();
		});

        function sanitize(input) {
            input = input.replace(/&/g, '&amp;')
						 .replace(/</g, '&lt;')
						 .replace(/>/g, '&gt;')
						 .replace(/'/g, '&apos;')
						 .replace(/"/g, '&quot;');
            return input;
        }

        /*
           Source for clipboard -
           https://techoverflow.net/2018/03/30/copying-strings-to-the-clipboard-using-pure-javascript/
        */
        function clipboard()
        {
            // Create new element
		    var code = document.createElement('textarea');
			code.value = $('#result').prop('outerHTML');
			// Set non-editable to avoid focus and move outside of view
			code.setAttribute('readonly', '');
			code.style = {position: 'absolute', left: '-9999px'};
			document.body.appendChild(code);
			// Select text inside element
			code.select();
			// Copy text to clipboard
			document.execCommand('copy');
			// Remove temporary element
			document.body.removeChild(code);
        }

		$('#update').click(function() {
			var lineNums = "";
			var source   = "";
			var output   = $("#out")[0].value;

			$(".ln").each(function(){lineNums += this.value + '\n';});
			$(".sc").each(function(){source += this.value + '\n';});

			lineNums = $.trim(lineNums);

			/* Sanitize user input */
            lineNums = sanitize(lineNums);
			source = sanitize(source);
            output = sanitize(output);

			/* Actual HTML to be displayed */
			source = source.replace(/``C/gi, '<span class="co-c">')
                           .replace(/``G/gi, '<span class="co-g">')
			               .replace(/``M/gi, '<span class="co-m">')
                           .replace(/``O/gi, '<span class="co-o">')
						   .replace(/``R/gi, '<span class="co-r">')
						   .replace(/``T/gi, '<span class="co-t">')
						   .replace(/``W/gi, '<span class="co-w">')
						   .replace(/``Y/gi, '<span class="co-y">')
						   .replace(/`\~/gi, '</span>');

            /* Output multiples lines */
            output = output.replace(/``N/gi, '<br>');

			$("#lineNum").empty();
			$("#sourceCode").empty();
			$("#output").empty();

			$("#lineNum").html(lineNums);
			$("#sourceCode").html(source);
			$("#output").html(output);

            clipboard();
		});
	});
