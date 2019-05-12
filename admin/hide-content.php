<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if ($_SESSION['privs'] < 3) {
  softRedirect('/profile.php');
}
else if (!isset($_GET['content']) or !isset($_GET['hidden'])) {
  softRedirect('/admin/content.php?error=missing');
}
else if ($_GET['content'] == "" or $_GET['hidden'] == "") {
  softRedirect('/admin/content.php?error=blank');
}

// TODO: Split this line
execPrepare($mysqli, "UPDATE areas SET hidden = ? WHERE id = ?;", array("ii", $_GET['hidden'], $_GET['content']));
softRedirect('/admin/content.php?hidden=true&id=' . $_GET['content']);
?>
