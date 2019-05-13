<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if ($_SESSION['privs'] < 3) { softRedirect('/profile.php'); }
else if (!isset($_GET['category']) or !isset($_GET['hidden'])) {
  softRedirect('/admin/categories.php?error=missing');
}
else if ($_GET['category'] == "" or $_GET['hidden'] == "") {
  softRedirect('/admin/categories.php?error=blank');
}

execPrepare($mysqli, "UPDATE categories SET hidden = ? WHERE id = ?;", array("ii", $_GET['hidden'], $_GET['category']));
softRedirect('/admin/categories.php?hidden=true&id=' . $_GET['category']);
?>
