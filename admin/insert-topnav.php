<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/csrf.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

else if ($_SESSION['privs'] < 3) { softRedirect('/profile.php'); }
else if (!isset($_POST['id']))   { softRedirect('/admin/new-topnav.php'); }
else if (!isset($_POST['area']) or !isset($_POST['title']) or !isset($_POST['url'])) {
  softRedirect('/admin/edit-topnav.php?error=missing');
}
else if ($_POST['area'] == "" or $_POST['title'] == "" or $_POST['url'] == "") {
  softRedirect('/admin/edit-topnav.php?error=blank');
}

// Check that the category ID isn't taken
// This works by looking up the ID in the database and throwing an error if a row is found
if (numPrepare($mysqli, "SELECT id FROM topnav WHERE id = ?;", array("s", $_GET['id'])) > 0) {
  softRedirect('/new-topnav.php?error=taken');
}

// Add the new category to the database
$result = execPrepare($mysqli, "INSERT INTO topnav (id, area, title, url) VALUES (?, ?, ?, ?);", array("iiss", intval($_POST['id']), intval($_POST['area']), $_POST['title'], $_POST['url']));
softRedirect('/admin/edit-topnav.php?added=true&id=' . $_POST['id']);
?>
