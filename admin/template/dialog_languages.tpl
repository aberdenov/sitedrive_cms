<script language="JavaScript">
	var hoverLangID = 0;
	var activeLangID = 0;

	function doAction2(vid, vaction) {
		with (document.forms['hid']) {			
			elements['id'].value = vid;
			elements['action'].value = vaction;
			submit();
		}
	}

	function beforeSubmit(frm, action, url) {
		frm.action = 'dialog_languages.php?action=' + action + url;
		if (url != '') frm.action = frm.action + url;
		frm.submit();
	}

	function langDelete(id) {
		if (confirm('Вы действительно хотите удалить язык?')) {
			if (id > 0) activeLangID = id;
			
			doAction2(activeLangID, 'delete');
		}
	}

	function langEdit(id) {
		doAction2(id, 'edit');
	}
</script>

<div class="sd_pageTitle">{PAGE_TITLE}</div>
<div id="main">
<table cellpadding="2" cellspacing="0" border="0" width="450" align="center" style="border-bottom: 1px solid #808080; border-left: 1px solid #808080; border-top: 1px solid #808080;">
<tr style="height: 20px;">
	<td class="sd_outset" width="10" align="center">#</td>
	<td class="sd_outset"><b>Язык</b></td>
	<td class="sd_outset"><b>Кодировка</b></td>
	<td class="sd_outset" width="16" align="center">&nbsp;</td>
	<td class="sd_outset" width="16" align="center">&nbsp;</td>
</tr>
{LANGUAGES}
</table>
<br>

<form method="post" name="form">
<table cellpadding="5" cellspacing="0" border="0" width="450" align="center">
<tr>
<td class="sd_formLabel">Язык: </td>
<td class="sd_formInput"><input type="text" class="sd_textbox" name="name" value="{VALUE_NAME}"></td>
</tr>
<tr>
<td class="sd_formLabel">Кодировка: </td>
<td class="sd_formInput"><input type="text" class="sd_textbox" name="encoding"  value="{VALUE_ENCODING}"></td>
</tr>
<tr>
<td class="sd_formLabel">Основной:</td>
<td class="sd_formInput"><input type="checkbox" name="main" {VALUE_MAIN}></td>
</tr>
<tr>
<td class="sd_formLabel">Заблокированный: </td>
<td class="sd_formInput"><input type="checkbox" name="blocked" {VALUE_BLOCKED}></td>
</tr>
<tr>
<td class="sd_formLabel">Копировать: </td>
<td class="sd_formInput">
	<select class="sd_textbox" name="from_lang" style="width="100px;"">
		<option value="0"></option>
		{DEST_LANG}
	</select>
	<input type="checkbox" name="add_content"><label>Копировать контент</label>
</td>
</tr>

<tr>
<td colspan="2" class="sd_formButton"><input type="button" name="save" class="sd_button" value="Сохранить" onClick="beforeSubmit(this.form, 'update', '&id={ID}');"' {SAVE_DISABLED}></td>
</tr>
<tr>
<td colspan="2" class="sd_formButton"><input type="button" name="create" class="sd_button" value="Создать" onClick="beforeSubmit(this.form, 'add', '');"'></td>
</tr>
</table>
</form>
</div>

<form name="hid" method="get">
<input type="hidden" name="id">
<input type="hidden" name="action">
</form> 
<br>
