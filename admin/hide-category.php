<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if ($_SESSION['privs'] < 3) {
  softRedirect('/profile.php');
}
else if (!isset($_POST['category']) or !isset($_POST['hidden'])) {
  softRedirect('/admin/categories.php?error=missing');
}
else if ($_POST['category'] == "" or $_POST['hidden'] == "") {
  softRedirect('/admin/categories.php?error=blank');
}

// TODO: Split this line
execPrepare($mysqli, "UPDATE categories SET hidden = ? WHERE id = ?;", array("ii", $_POST['hidden']), $_POST['category']);
softRedirect('/admin/edit-category.php?updated=true&nav=' . $_POST['category']);
?>
