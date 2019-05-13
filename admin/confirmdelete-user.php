<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/csrf.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if      (!isset($_SESSION['privs'])) { softRedirect('/login.php'); }
else if ($_SESSION['privs'] < 3)     { softRedirect('/profile.php'); }
else if (!isset($_POST['email']))    { softRedirect('/admin/users.php'); }
else if ($_POST['email'] == "")      { softRedirect('/admin/delete-user.php?error=blank'); }

execPrepare($mysqli, "DELETE FROM users WHERE email = ?;", array("s", $_POST['email']));
softRedirect('/admin/users.php?deleted=true&user=' . $_POST['email']);
?>
