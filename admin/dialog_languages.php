<?php
	require_once("./includes/auth.php");
	require_once("./includes/common.php");
	require_once("./includes/db_init.php");

	require_once(FASTTEMPLATES_PATH."template.php");

	$tpl = new FastTemplate(TEMPLATES_PATH);
	
	$tpl->define(array(
			"page" => "page.tpl",
			"content" => "dialog_languages.tpl",
			"row" => "row_lang.tpl",
			"main_menu" => "main_menu.tpl",
			"lang_select" => "lang_select.tpl"
		));

	$valueName = '';
	$valueEncoding = 'utf-8';
	$valuePack = '';
	$valueMain = '';
	$valueBlocked = '';
	
	$add_only_type = '';

	require_once("./control_menu.php");

	# FUNCTIONS #################################################################################

	// Копируем структуру и содержимое ветки
	function copyStruc($id, $parent_id, $src_lang, $dist_lang, $add_content) {
		$old_parent_id = $parent_id;
		$result = db_query("SELECT * FROM pages WHERE parent_id = ".$id." AND lang_id = ".$src_lang);
		while ($row = db_fetch_array($result)) {
			db_query("INSERT INTO pages VALUES (
	 									''
	 									, '".$parent_id."'
	 									, '".$dist_lang."'
	 									, '".$row['type']."'
	 									, '0'
	 									, '".addslashes($row['mod_rewrite'])."'
	 									, '".addslashes($row['title'])."'
	 									, '".addslashes($row['description'])."'
	 									, ''
	 									, '".addslashes($row['content'])."'
	 									, '".$row['template']."'
	 									, '".$row['icon']."'
	 									, '".$row['external_link']."'
	 									, '".$row['sortfield']."'
	 									, '".$row['visible']."'
	 									, '".$row['deleted']."'
	 									, '".$row['startpage']."'
	 									, '".$row['sort_by']."'
	 									, '".$row['sort_order']."'
	 									, '".$row['auth']."'
	 									)");
										
			$parent_id = db_insert_id();
			
			// Определение типа страницы и копирование связанных строк данных
			if ($add_content) {
				if (db_table_exists("module_".$row['type'])) {
					$result2 = db_query("SELECT * FROM module_".$row['type']." WHERE page_id = ".$row['id']);
					if (db_num_rows($result2) > 0) {
						$fields = db_num_fields($result2);
						while ($row2 = db_fetch_array($result2)) {
							for ($i = 0; $i < $fields; $i++) {
								if ($i == 0) {
									$sql = "INSERT INTO module_".$row['type']." SET ";
									$show_sql = $sql;
								}
								$field_name = db_field_name($result2, $i);
								
								switch ($field_name) {
									case 'id':
										//$sql.= "''";
										//$show_sql .= $field_name."=''";
										break;
									case 'page_id':
 										$sql.= "'".$parent_id."'";
										$show_sql .= $field_name."='".$parent_id."'";
										break;
									case 'lang_id':
										$sql .= "'".$dist_lang."'";
										$show_sql .= $field_name."='".$dist_lang."'";
										break;
									default:
										$sql .= "'".addslashes($row2[$i])."'";
										$show_sql .= $field_name."='".addslashes($row2[$i])."'";
								}
								
								if ($i < ($fields - 1) && $i != 0) $show_sql .= ", ";
							}
							
							if ($GLOBALS['add_only_type'] == '' || $GLOBALS['add_only_type'] == $row['type']) {
								db_query($show_sql);
								// echo "<small>SQL Query: ".$show_sql."</small><br><br>";
							}
						}
					}
				}
			}
			
			copyStruc($row['id'], $parent_id, $src_lang, $dist_lang, $add_content);
			$parent_id = $old_parent_id;
		}
	}

	# POST ######################################################################################

	if (isset($_GET['action'])) {
		switch ($_GET['action']) {
			case 'edit':
				$result = db_query("SELECT * FROM languages WHERE id = ".$_GET['id']);
				if (db_num_rows($result) > 0) {
					$row = db_fetch_object($result);
					$valueName = $row->name;
					$valueEncoding = $row->encoding;
					$valuePack = $row->file;
					
					if ($row->main)	$valueMain = 'checked';	else $valueMain = '';
					if ($row->blocked)	$valueBlocked = 'checked';	else $valueBlocked = '';
				}
				break;

			case 'delete':
				db_query("DELETE FROM languages WHERE id = ".$_GET['id']." LIMIT 1");
				header('Location: dialog_languages.php');
				exit;
				break;

			case 'update':
				if (isset($_POST['main'])) {
					db_query("UPDATE languages SET main = 0");
					db_query("UPDATE languages SET main = 1 WHERE id = ".$_GET['id']." LIMIT 1");
				}
				
				$blocked = (integer)isset($_POST['blocked']);
				
				db_query("UPDATE languages SET 
	 						name = '".$_POST['name']."',
	 						file = '".$_POST['file']."',
	 						encoding = '".$_POST['encoding']."',
	 						blocked = ".$blocked."
	 						WHERE id = ".$_GET['id']." LIMIT 1"
	 					 );
				
	 			header("Location: dialog_languages.php?action=edit&id=".$_GET['id']);
	 			break;

			case 'add':
				if (!empty($_POST['name']) && !empty($_POST['encoding'])) {
					if (isset($_POST['main'])) {
						db_query("UPDATE languages SET main = 0");
						$main = 1;
					} else {
						$main = 0;
					}
					
					$blocked = (integer)isset($_POST['blocked']);
					
					$last_id = db_get_data("SELECT COUNT(*) AS num FROM languages", "num");
					$last_id = $last_id + 1;
					
					db_query("INSERT INTO languages SET	id = ".$last_id.",
													    name = '".$_POST['name']."',
														file = 'russian_utf-8.php',
														encoding = '".$_POST['encoding']."',
														main = ".$main.",
														blocked = ".$blocked."
							");
					
					$new_lang = db_insert_id();
					
					// Копируем структуру из другой ветки
					if ($_POST['from_lang'] > 0 && $new_lang > 0) {
						$add_content = (integer)isset($_POST['add_content']);
						copyStruc(0, 0, $_POST['from_lang'], $new_lang, $add_content);
					}
					
					header("Location: dialog_languages.php?action=edit&id=".$new_lang);
				}
				break;
		}
	}

	# MAIN #####################################################################################

	if (isset($_GET['id'])) $id = $_GET['id']; else $id = 0;
	if ($id > 0) $save_disabled = ''; else $save_disabled = 'disabled';

	$languages = '';
	$result = db_query("SELECT * FROM languages ORDER BY id");
	while ($row = db_fetch_object($result)) {
		if ($row->main == 1) $name = "<b>".$row->name."</b>"; else $name = $row->name;
		if ($row->id == $id) $sel_bg = '#C1D2EE'; else $sel_bg = '#FFFFFF';
		
		$languages.= '<option value="'.$row->id.'">'.$row->name.'</option>';
		
		if ($row->blocked == 1) $blocked = '<img src="images/lock.gif" width="12" height="15" border="0" hspace="2" alt="Заблокиварон">'; else $blocked = '&nbsp;';
		
		$tpl->assign(array(
				"SELECTED" => $row->id,
				"SELECTED_BG" => $sel_bg,
				"NAME" => $name,
				"ENCODING" => $row->encoding,
				"BLOCKED" => $blocked,
				"PACK" => $row->file,
				"ID" => $row->id,
			));
		
		$tpl->parse("LANGUAGES", ".row");
	}

	$tpl->assign(array(
			"DEST_LANG" => $languages,
			"VALUE_NAME" => $valueName,
			"VALUE_ENCODING" => $valueEncoding,
			"VALUE_MAIN" => $valueMain,
			"VALUE_BLOCKED" => $valueBlocked,
			"SAVE_DISABLED" => $save_disabled,
			"ID" => $id
		));
	
	$tpl->parse("PAGE_CONTENT", "content");
	
	$tpl->parse("FINAL", "page");
	$tpl->FastPrint();
?>