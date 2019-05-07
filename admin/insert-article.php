<?php
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';

if (!isset($_SESSION['privs'])) {
  header('Location: /login.php');
  exit();
}
else if ($_SESSION['privs'] < 3) {
  header('Location: /profile.php');
  exit();
}
else if (!isset($_POST['id'])) {
  header('Location: /admin/new-article.php');
  exit();
}
else if (!isset($_POST['area']) or !isset($_POST['title']) or !isset($_POST['description']) or !isset($_POST['content']) or !isset($_POST['premium']) or !isset($_POST['category'])) {
  header('Location: /admin/edit-article.php?error=missing&nav=' . htmlspecialchars($_POST['id']));
  exit();
}
else if ($_POST['title'] == "" or $_POST['title'] == "" or $_POST['description'] == "" or $_POST['content'] == "" or $_POST['premium'] == "" or $_POST['category'] == "") {
  header('Location: /admin/edit-article.php?error=blank&nav=' . htmlspecialchars($_POST['id']));
  exit();
}

// Check that the category ID isn't taken
// This works by looking up the ID in the database and throwing an error if a row is found
if ($stmt = $mysqli->prepare("SELECT id FROM articles WHERE id = ?;")) {
  $stmt->bind_param("s", $_POST['id']);
  $stmt->execute();
  $stmt->store_result();
  if ($stmt->num_rows > 0) {
    header('Location: https://cisojourney.com/new-article.php?error=taken');
    exit();
  }
}

// Add the new category to the database
$stmt = $mysqli->prepare("INSERT INTO articles (area, id, title, description, content, premium, category) VALUES (?, ?, ?, ?, ?, ?, ?);");
$stmt->bind_param("iisssii", intval($_POST['area']), intval($_POST['id']), $_POST['title'], $_POST['description'], $_POST['content'], intval($_POST['premium']), intval($_POST['category']));
$stmt->execute();
header('Location: /admin/edit-articles.php?added=true&article=' . htmlspecialchars($_POST['id']));
exit();
?>
