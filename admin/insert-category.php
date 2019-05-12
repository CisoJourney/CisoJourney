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
  header('Location: /admin/new-category.php');
  exit();
}
else if (!isset($_POST['title']) or !isset($_POST['description']) or !isset($_POST['icon']) or !isset($_POST['area']) or !isset($_POST['hidden'])) {
  header('Location: /admin/edit-category.php?error=missing&nav=' . htmlspecialchars($_POST['id']));
  exit();
}
else if ($_POST['title'] == "" or $_POST['description'] == "" or $_POST['icon'] == "" or $_POST['area'] == "" or $_POST['hidden'] == "") {
  header('Location: /admin/edit-category.php?error=blank&nav=' . htmlspecialchars($_POST['id']));
  exit();
}

// Check that the category ID isn't taken
// This works by looking up the ID in the database and throwing an error if a row is found
if ($stmt = $mysqli->prepare("SELECT id FROM categories WHERE id = ?;")) {
  $stmt->bind_param("s", $_POST['id']);
  $stmt->execute();
  $stmt->store_result();
  if ($stmt->num_rows > 0) {
    header('Location: https://cisojourney.com/new-category.php?error=taken');
    exit();
  }
}

// Add the new category to the database
$stmt = $mysqli->prepare("INSERT INTO categories (id, area, title, description, icon, hidden) VALUES (?, ?, ?, ?, ?, ?);");
$stmt->bind_param("iissss", intval($_POST['id']), intval($_POST['area']), $_POST['title'], $_POST['description'], $_POST['icon'], $_POST['hidden']);
$stmt->execute();
header('Location: /admin/edit-category.php?added=true&id=' . htmlspecialchars($_POST['id']));
exit();
?>
