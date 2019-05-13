<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if ($_SESSION['privs'] < 3) { softRedirect('/profile.php'); }
else if (!isset($_GET['nav']) or !isset($_GET['hidden'])) {
  softRedirect('/admin/topnav.php?error=missing');
}
else if ($_GET['nav'] == "" or $_GET['hidden'] == "") {
  softRedirect('/admin/topnav.php?error=blank');
}

execPrepare($mysqli, "UPDATE topnav SET hidden = ? WHERE id = ?;", array("ii", $_GET['hidden'], $_GET['nav']));
softRedirect('/admin/topnav.php?hidden=true&id=' . $_GET['nav']);
?>
