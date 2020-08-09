/* Source - https://techoverflow.net/2018/03/30/copying-strings-to-the-clipboard-using-pure-javascript/ */
    function copyStringToClipboard(rawStr, ID) {
       // Create new element
       var code = document.createElement('textarea');

       code.value = rawStr;
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
	   
	   
	   console.log(rawStr);
	   // Landen's addition below
	   document.getElementById(ID).innerHTML="<i class='fas fa-clipboard-check'></i>";
       var inst = setInterval(changeBtnTxt, 3000);
       function changeBtnTxt() {
        document.getElementById(ID).innerHTML="<i class='far fa-clipboard'></i>";
        clearInterval(inst);
       }
    }
	
	$(".changeCursor a").click(function(e) { e.preventDefault(); });