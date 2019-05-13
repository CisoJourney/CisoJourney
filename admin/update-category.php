<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if ($_SESSION['privs'] < 3) {
  softRedirect('/profile.php');
}
else if (!isset($_POST['id'])) {
  softRedirect('/admin/categories.php');
}
else if (!isset($_POST['title']) or !isset($_POST['slug']) or !isset($_POST['description']) or !isset($_POST['icon']) or !isset($_POST['area'])) {
  softRedirect('/admin/edit-category.php?error=missing&nav=' . $_POST['id']);
}
else if ($_POST['title'] == "" or $_POST['slug'] == "" or$_POST['description'] == "" or $_POST['icon'] == "" or $_POST['area'] == "") {
  softRedirect('/admin/edit-category.php?error=blank&nav=' . $_POST['id']);
}

// TODO: check ID and SLUG aren't duplicated

// TODO: Split this line
execPrepare($mysqli, "UPDATE categories SET area = ?, title = ?, slug = ?, description = ?, icon = ? WHERE id = ?;", array("issssi", intval($_POST['area']), $_POST['title'], $_POST['slug'], $_POST['description'], $_POST['icon'], intval($_POST['id'])));
softRedirect('/admin/edit-category.php?updated=true&nav=' . $_POST['id']);
?>
