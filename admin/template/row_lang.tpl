<tr 
	onMouseOver  ="style.background='#E4EEFD'; hoverLangID={ID}"
	onMouseOut   ="style.background='{SELECTED_BG}'; hoverLangID=0"
	onContextMenu="tp.menu_show(1, window); activeLangID=hoverLangID;"
	style = "background-color: {SELECTED_BG};";
>
<td align="center" style="border-bottom: 1px solid #EFEFEF;" onClick="langEdit(hoverLangID);">{ID}</td>
<td style="border-bottom: 1px solid #EFEFEF; cursor: hand;" onClick="langEdit(hoverLangID);">{NAME}</td>
<td style="border-bottom: 1px solid #EFEFEF; cursor: hand;" onClick="langEdit(hoverLangID);">{ENCODING}</td>
<td style="border-bottom: 1px solid #EFEFEF; cursor: hand;" align="center" onClick="langEdit(hoverLangID);">
{BLOCKED}
</td>
<td style="border-bottom: 1px solid #EFEFEF; border-right: 1px solid #808080;" align="center">
<img src="images/gallery/delete.gif" width="16" height="16" border="0" hspace="2" onclick="return langDelete({ID})" style="cursor: hand;" alt="Удалить">
</td>
</tr>