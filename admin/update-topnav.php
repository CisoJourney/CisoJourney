<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/csrf.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if      ($_SESSION['privs'] < 3) { softRedirect('/profile.php'); }
else if (!isset($_POST['id']))   { softRedirect('/admin/topnav.php'); }
else if (!isset($_POST['title']) or !isset($_POST['url'])) {
  softRedirect('/admin/edit-topnav.php?error=missing');
}
else if ($_POST['title'] == "" or $_POST['url'] == "") {
  softRedirect('/admin/edit-topnav.php?error=blank');
}

execPrepare($mysqli, "UPDATE topnav SET title = ?, url = ? WHERE id = ?;", array("sss", $_POST['title'], $_POST['url'], $_POST['id']));
softRedirect('Location: /admin/edit-topnav.php?updated=true');
?>
