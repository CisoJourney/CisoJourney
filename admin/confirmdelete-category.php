<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/csrf.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';

if       ($_SESSION['privs'] < 3)    { softRedirect('/profile.php'); }
else if (!isset($_POST['id'])) { softRedirect('/admin/categories.php'); }
else if ($_POST['id'] == "")   { softRedirect('/admin/delete-category.php?error=blank'); }

// TODO: Check category exists before DELETE action
execPrepare($mysqli, "DELETE FROM categories WHERE id = ?;", array("s", $_POST['id']));
softRedirect('/admin/categories.php?deleted=true&category=' . $_POST['id']);
?>
