<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/csrf.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if      ($_SESSION['privs'] < 3) { softRedirect('/profile.php'); }
else if (!isset($_POST['nav']))  { softRedirect('/admin/users.php'); }
else if ($_POST['nav'] == "")    { softRedirect('/admin/delete-topnav.php?error=blank'); }

$result = execPrepare($mysqli, "DELETE FROM topnav WHERE id = ?;", array("i", $_GET['nav']));
softRedirect('/admin/topnav.php?deleted=true&nav=' . $_POST['nav']);
?>
