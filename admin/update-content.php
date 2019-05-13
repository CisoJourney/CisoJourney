<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/csrf.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if      ($_SESSION['privs'] < 3) { softRedirect('/profile.php'); }
else if (!isset($_POST['id']))   { softRedirect('/admin/content.php'); }
else if (!isset($_POST['title']) or !isset($_POST['slug']) or !isset($_POST['description']) or !isset($_POST['icon'])) {
  softRedirect('/admin/edit-content.php?error=missing');
}
else if ($_POST['title'] == "" or $_POST['slug'] == "" or $_POST['description'] == "" or $_POST['icon'] == "") {
  softRedirect('/admin/edit-content.php?error=blank');
}

$result = execPrepare($mysqli, "UPDATE areas SET title = ?, slug = ?, description = ?, icon = ? WHERE id = ?;", array("ssssi", $_POST['title'], $_POST['slug'], $_POST['description'], $_POST['icon'], intval($_POST['id'])));
softRedirect('/admin/edit-content.php?updated=true&content=' . $_POST['id']);
?>
