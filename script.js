// JavaScript
var insta_count = 0;
var insta_mob_count = 0;

// Set default homepage
function setDefaultPage (a) { 
	if ((navigator.appVersion.indexOf('MSIE 5.') != -1) || (navigator.appVersion.indexOf('MSIE 6.') != -1)) { 
		a.style.behavior = 'url(#default#homepage)';
		a.setHomePage(location.protocol + '//www.' + location.host);
	} else { 
		location.href = '';
	}
}

// Show pop-up image window
function showPhoto(url, width, height, title) {
  var top, left;
	
  top = Math.floor((screen.height - height) / 2-14);
  left = Math.floor((screen.width - width) / 2);
  imgparam = "left="+left+",top="+top+",height="+height+",width="+width+",location=0,scrollbars=no,toolbar=no,directories=no,menubar=no,status=no,resizable=no";
  
  wnd = window.open("", "", imgparam);
  wnd.document.writeln("<html><head><title>"+title+"</title>");
  wnd.document.writeln("<script language='JavaScript'> function myClose() { window.close(); } </script>");
  wnd.document.writeln("</head><body bgcolor='#F1F2F4' leftmargin='0' topmargin='0' rightmargin='0' bottommargin='0' marginheight='0' marginwidth='0'>");
  wnd.document.write("<table width=100% height=100% cellpadding=0 cellspacing=0 border=0><tr><td align=center valign=middle>");
  wnd.document.write("<a href='javascript: myClose();'><img src='");
  wnd.document.write(url);
  wnd.document.writeln("' border='0' alt='Close' onLoad='window.resizeTo(this.width+10, this.height+35)'></a></td></tr></table>");
  wnd.document.writeln("</body></HTML>");
}

// Show pop-up flash window
function showFlash(url, width, height, title, fullscreen) {
  var top, left;
	
  top = Math.floor((screen.height - height) / 2-14);
  left = Math.floor((screen.width - width) / 2);
  if (fullscreen == true) imgparam = "left=0,top=0,height="+(screen.availHeight)+",width="+(screen.availWidth)+",location=0,scrollbars=yes,toolbar=no,directories=no,menubar=no,status=no,resizable=yes";
      else imgparam = "left="+left+",top="+top+",height="+height+",width="+width+",location=0,scrollbars=no,toolbar=no,directories=no,menubar=no,status=no,resizable=no";
  
  wnd = window.open("", "", imgparam);
  wnd.document.writeln("<html><head><title>"+title+"</title>");
  wnd.document.writeln("<script language='JavaScript'> function myClose() { window.close(); } </script>");
  wnd.document.writeln("</head><body bgcolor='#F1F2F4' leftmargin='0' topmargin='0' rightmargin='0' bottommargin='0' marginheight='0' marginwidth='0'>");
  wnd.document.write("<table width=100% height=100% cellpadding=0 cellspacing=0 border=0><tr><td align=center valign=middle>");
  wnd.document.write('<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="'+width+'" height="'+height+'">');
  wnd.document.write('<param name=bgcolor VALUE=#FFFFFF>');
  wnd.document.write('<param name="movie" value="'+url+'">');
  wnd.document.write('<param name="quality" value="high">');
  wnd.document.write('<embed src="'+url+'" quality="high" BGCOLOR=#FFFFFF pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="'+width+'" height="'+height+'"></embed>');
  wnd.document.write('</object>');
  wnd.document.writeln("</td></tr></table>");
  wnd.document.writeln("</body></HTML>");
}

// Check required fileds
function checkFields(user_form, msg, color) {
	if (!color || color == '') color = '#FFF9DF';
	
	for (var i = 0; i < user_form.length; i++) {
		if (user_form[i].type == "text") user_form[i].style.background = '#FFFFFF';
	}
	
	for (var i = 0; i < user_form.length; i++) {
		if (user_form[i].type == "text" || user_form[i].type == "textarea" || user_form[i].type == "password") {
			if ((user_form[i].required == 1 || user_form[i].required == "yes") && user_form[i].value == '') {
				if (msg != '') alert(msg);
				user_form[i].style.background = color;
				user_form[i].focus();
				return false;
			}
		}
	}
	
	return true;
}

// Is checkboxes selected
function validateCheckboxes(user_form, msg) {
	for (var i = 0; i < user_form.length; i++) {
		if (user_form[i].type == "checkbox") {
			if (user_form[i].checked == 1) return true;
		}
	}
	
	if (msg != '') alert(msg);
	return false;
}

// Check field
function validateField(field, error_message) {	
	if (field.value == '') {
		if (error_message != '') alert (error_message);
		field.focus();
		return false; 
	}
	
	return true; 
}

function validateEmail(field, msg) {
	if (field.value != '') {
		var reg_exp = /^[a-z_\-\][\w\.]*@[\w\.-]+\.[a-z]{2,3}/i
        if (!reg_exp.test(field.value)) {
	        if (msg) alert(msg);
			field.focus();
			return false;
    	}
	}
	
	return true;
}

// Check only digits input
function onlyDigits() {
	with (window.event) {
		if (shiftKey)
			return false;
		if (
			(keyCode >= 48 && keyCode <= 57) ||
			(keyCode >= 96 && keyCode <= 105) ||
			keyCode == 9 ||
			keyCode == 116 ||
			keyCode == 8 ||
			keyCode == 13 ||
			keyCode == 39 ||
			keyCode == 37 ||
			keyCode == 190 ||
			keyCode == 191 ||
			keyCode == 46
			)
			return true;
		else
			return false;
	}
}

// Show DIV
function openDiv(layerID) {
	if (document.getElementById(layerID).style.display == 'none') {
		document.getElementById(layerID).style.display = '';
	} else {
		document.getElementById(layerID).style.display = 'none';
	}
	
	return false;
}

// Show document in new window
function showDoc(filePath, width, height, title) {
	var top, left;
	top = Math.floor((screen.height - height) - (height / 2));
	left = Math.floor((screen.width - width) / 2);
	
	$fileType = filePath.substr(filePath.length - 3, 3);
	$fileType = $fileType.toLowerCase();
	
	if (!title) title = '';
	
 	switch($fileType) {
		case "swf" : 
			showFlash(filePath, width, height, title, true); 
			break
		case "gif" : 
			showPhoto(filePath, width, height, title);
			break
		case "jpg" : 
			showPhoto(filePath, width, height, title);
			break
		default:
			wparam = "left="+left+",top="+top+",height="+height+",width="+width+",location=0,scrollbars=yes,toolbar=no,directories=no,menubar=no,status=yes,resizable=yes";
			window.open(filePath, '', wparam);			
			break
	}
}

function validateRadio(user_form) {
	for (var i = 0; i < user_form.length; i++) {
		if (user_form[i].type == "radio") {
			if (user_form[i].checked == true) return true;
		}
	}
	
	return false;
}

function textCounter(field, counter, name) {
	var charcnt = field.value.length;        
	document.getElementById(counter).innerHTML = name+": "+charcnt;
}
