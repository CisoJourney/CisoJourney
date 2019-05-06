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
  header('Location: /admin/categories.php');
  exit();
}
else if (!isset($_POST['title']) or !isset($_POST['description']) or !isset($_POST['icon']) or !isset($_POST['area'])) {
  header('Location: /admin/edit-category.php?error=missing&nav=' . htmlspecialchars($_POST['id']));
  exit();
}
else if ($_POST['title'] == "" or $_POST['description'] == "" or $_POST['icon'] == "" or $_POST['area'] == "") {
  header('Location: /admin/edit-category.php?error=blank&nav=' . htmlspecialchars($_POST['id']));
  exit();
}

$stmt = $mysqli->prepare("UPDATE categories SET area = ?, title = ?, description = ?, icon = ? WHERE id = ?;");
$stmt->bind_param("isssi", intval($_POST['area']), $_POST['title'], $_POST['description'], $_POST['icon'], intval($_POST['id']));
$stmt->execute();
header('Location: /admin/edit-category.php?updated=true&nav=' . htmlspecialchars($_POST['id']));
exit();
?>
