<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>{SITE_WINDOW_TITLE} :: {WINDOW_PAGE_TITLE}</title>
<meta http-equiv="Content-Type" content="text/html; charset={PAGE_ENCODING}">
<meta content="Выпадающее окно с фотографией|Photogallery popup photo|Выпадающее окно с фотографией" name="template">
<link rel=stylesheet href="styles.css" type="text/css">
<script language="javascript">
	var win_width = 644;
	var win_height = 530;
	
 	function resize_win(img_width, img_height) {
		var dy = 70;
		var dx = 18;
		
		// Fit window
		fit_width = img_width - win_width;
		fit_height = img_height - win_height;

		if (fit_width > 0) {
			self.resizeTo(img_width + dx, win_height);
			win_width = img_width + dx;
		}
		
		if (fit_height > 0) {
			self.resizeTo(win_width, img_height + dy);
			win_height = img_height + dy;
		}
		
		// Center window
		x = (screen.width / 2) - (win_width / 2);
		y = (screen.height / 2) - (win_height / 2);
		self.moveTo(x, y);
	}
</script>
</head>
<body topmargin="2" bottommargin="2" marginheight="2" marginwidth="2" leftmargin="2" bgcolor="#5B7A99">
{CONTENT}
</body>
</html>
