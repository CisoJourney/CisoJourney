<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/csrf.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if      ($_SESSION['privs'] < 3) { softRedirect('/profile.php'); }
else if (!isset($_POST['id']))   { softRedirect('/admin/new-category.php'); }
else if (!isset($_POST['title']) or !isset($_POST['description']) or !isset($_POST['icon']) or !isset($_POST['area']) or !isset($_POST['hidden'])) {
  softRedirect('/admin/edit-category.php?error=missing');
}
else if ($_POST['title'] == "" or $_POST['description'] == "" or $_POST['icon'] == "" or $_POST['area'] == "" or $_POST['hidden'] == "") {
  softRedirect('/admin/edit-category.php?error=blank');
}

// Check that the category ID isn't taken
// This works by looking up the ID in the database and throwing an error if a row is found
if (numPrepare($mysqli, "SELECT id FROM categories WHERE id = ?;", array("s", $_POST['id'])); > 0) {
  softRedirect('/new-category.php?error=taken');
}

// Add the new category to the database
$result = execPrepare($mysqli, "INSERT INTO categories (id, area, title, description, icon, hidden) VALUES (?, ?, ?, ?, ?, ?);", array("iissss", intval($_POST['id']), intval($_POST['area']), $_POST['title'], $_POST['description'], $_POST['icon'], $_POST['hidden']));
softRedirect('/admin/edit-category.php?added=true&id=' . $_POST['id']);

?>
