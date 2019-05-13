<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if ($_SESSION['privs'] < 3) {
  softRedirect('/profile.php');
}
else if (!isset($_POST['id'])) {
  softRedirect('/admin/articles.php');
}
else if (!isset($_POST['title']) or !isset($_POST['slug']) or !isset($_POST['description']) or !isset($_POST['content']) or !isset($_POST['premium']) or !isset($_POST['category']) or !isset($_POST['hidden'])) {
  softRedirect('/admin/articles.php?error=missing');
}

else if ($_POST['title'] == "" or $_POST['slug'] == "" or $_POST['description'] == "" or $_POST['content'] == "" or $_POST['premium'] == "" or $_POST['category'] == "" or $_POST['hidden']) {
  softRedirect('/admin/articles.php?error=blank');
}

// TODO: Split this line
execPrepare($mysqli, "UPDATE articles SET title = ?, slug = ?, description = ?, content = ?, premium = ?, category = ? , hidden = ? WHERE id = ?;", array("ssssiiii", $_POST['title'], $_POST['slug'], $_POST['description'], $_POST['content'], intval($_POST['premium']), intval($_POST['category']), intval($_POST['hidden']), intval($_POST['id'])));
softRedirect('/admin/edit-article.php?updated=true&article=' . $_POST['id']);
?>
