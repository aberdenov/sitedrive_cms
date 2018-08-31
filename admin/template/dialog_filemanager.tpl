<script src="js/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/uploadify.css">

<div class="sd_pageTitle">Файловый менеджер</div>

<form action="" name="imgForm" method="post" enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="{MAX_FILE_SIZE}">

<table cellpadding="5" cellspacing="0" border="0" width="600" align="center">
<tr>
    <td class="sd_formLabel5">Файлы:</td>
    <td class="sd_formInput3">
        <input id="file_upload" name="file_upload" type="file" multiple="true" class="sd_textbox">
        <div id="queue"></div>
    </td>
</tr>
</table> 
</form>

<div class="dv1">
    {FILES}
</div>

<script type="text/javascript">
	$(function() {
		$('#file_upload').uploadify({
			'formData'     : {
				'timestamp' : '{TIMESTAMP}',
				'token'     : '{SALT}',
			},
			'swf'      : 'uploadify.swf',
			'uploader' : 'uploadify_file.php', 
			'onUploadSuccess' : function(file, data, response)  {
				//alert(data);
			},
			'onQueueComplete' : function(queueData) {
				location.reload();
			}
		});
	});
</script> 