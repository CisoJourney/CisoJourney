<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/csrf.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if      ($_SESSION['privs'] < 3)  { softRedirect('/profile.php'); }
else if (!isset($_POST['email'])) { softRedirect('/admin/users.php'); }
else if (!isset($_POST['privs']) or !isset($_POST['email'])) {
  softRedirect('/admin/edit-user.php?error=missing');
}
else if ($_POST['privs'] == "" or $_POST['email'] == "") {
  softRedirect('/admin/edit-user.php?error=blank');
}

execPrepare($mysqli, "UPDATE users SET privs = ? WHERE email = ?;", array("is", intval($_POST['privs']), $_POST['email']));
softRedirect('/admin/edit-user.php?updated=true&user=' . $_POST['email']);
?>
