<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if ($_SESSION['privs'] < 3) {
  softRedirect('/profile.php');
}
else if (!isset($_POST['id']) or !isset($_POST['hidden'])) {
  softRedirect('/admin/categories.php');
}
else if ($_POST['id'] == "" or $_POST['hidden'] == "") {
  softRedirect('/admin/categories.php');
}

// TODO: Split this line
execPrepare($mysqli, "UPDATE categories SET hidden = ? WHERE id = ?;", array("ii", $_POST['hidden']), $_POST['id']);
softRedirect('/admin/edit-category.php?updated=true&nav=' . $_POST['id']);
?>
