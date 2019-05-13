<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if      ($_SESSION['privs'] < 3) { softRedirect('/profile.php'); }
else if (!isset($_POST['id']))   { softRedirect('/admin/new-article.php'); }
else if (!isset($_POST['area']) or !isset($_POST['title']) or !isset($_POST['description']) or !isset($_POST['content']) or !isset($_POST['premium']) or !isset($_POST['category'])) {
  softRedirect('/admin/edit-article.php?error=missing&nav=' . $_POST['id']);
}
else if ($_POST['title'] == "" or $_POST['title'] == "" or $_POST['description'] == "" or $_POST['content'] == "" or $_POST['premium'] == "" or $_POST['category'] == "") {
  softRedirect('/admin/edit-article.php?error=blank&nav=' . $_POST['id']);
}

// Check that the category ID isn't taken
// This works by looking up the ID in the database and throwing an error if a row is found

if (numPrepare($mysqli, "SELECT id FROM articles WHERE id = ?;", array("i", $_GET['id'])) > 0) {
  softRedirect('/new-article.php?error=taken');
}

// Add the new category to the database
$result = execPrepare($mysqli, "INSERT INTO articles (area, id, title, description, content, premium, category) VALUES (?, ?, ?, ?, ?, ?, ?);", array("iisssii", intval($_POST['area']), intval($_POST['id']), $_POST['title'], $_POST['description'], $_POST['content'], intval($_POST['premium']), intval($_POST['category'])));
softRedirect('/admin/edit-articles.php?added=true&article=' . $_POST['id']);
?>
