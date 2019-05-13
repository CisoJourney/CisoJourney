<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if ($_SESSION['privs'] < 3) {
  softRedirect('/profile.php');
}
else if (!isset($_GET['article']) or !isset($_GET['hidden'])) {
  softRedirect('/admin/articles.php?error=missing');
}
else if ($_GET['category'] == "" or $_GET['hidden'] == "") {
  softRedirect('/admin/articles.php?error=blank');
}

// TODO: ID here is caps but not elsewhere
execPrepare($mysqli, "UPDATE articles SET hidden = ? WHERE ID = ?;", array("ii", $_GET['hidden'], $_GET['category']));
softRedirect('/admin/articles.php?hidden=true&id=' . $_GET['category']);
?>
