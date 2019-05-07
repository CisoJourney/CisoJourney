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
  header('Location: /admin/new-topnav.php');
  exit();
}
else if (!isset($_POST['area']) or !isset($_POST['title']) or !isset($_POST['url'])) {
  header('Location: /admin/edit-topnav.php?error=missing&nav=' . htmlspecialchars($_POST['id']));
  exit();
}
else if ($_POST['area'] == "" or $_POST['title'] == "" or $_POST['url'] == "") {
  header('Location: /admin/edit-topnav.php?error=blank&nav=' . htmlspecialchars($_POST['id']));
  exit();
}

// Check that the category ID isn't taken
// This works by looking up the ID in the database and throwing an error if a row is found
if ($stmt = $mysqli->prepare("SELECT id FROM topnav WHERE id = ?;")) {
  $stmt->bind_param("s", $_POST['id']);
  $stmt->execute();
  $stmt->store_result();
  if ($stmt->num_rows > 0) {
    header('Location: https://cisojourney.com/new-topnav.php?error=taken');
    exit();
  }
}

// Add the new category to the database
$stmt = $mysqli->prepare("INSERT INTO tponav (id, area, title, url) VALUES (?, ?, ?, ?);");
$stmt->bind_param("iisss", intval($_POST['id']), intval($_POST['area']), $_POST['title'], $_POST['url']);
$stmt->execute();
header('Location: /admin/edit-topnav.php?added=true&id=' . htmlspecialchars($_POST['id']));
exit();
?>
