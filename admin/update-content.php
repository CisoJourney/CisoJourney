<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';

if ($_SESSION['privs'] < 3) {
  softRedirect('/profile.php');
}
else if (!isset($_POST['id'])) {
  header('Location: /admin/content.php');
  exit();
}
else if (!isset($_POST['title']) or !isset($_POST['description']) or !isset($_POST['icon'])) {
  header('Location: /admin/edit-content.php?error=missing&content=' . htmlspecialchars($_POST['id']));
  exit();
}
else if ($_POST['title'] == "" or $_POST['description'] == "" or $_POST['icon'] == "") {
  header('Location: /admin/edit-content.php?error=blank&content=' . htmlspecialchars($_POST['id']));
  exit();
}

$stmt = $mysqli->prepare("UPDATE areas SET title = ?, description = ?, icon = ? WHERE id = ?;");
$stmt->bind_param("sssi", $_POST['title'], $_POST['description'], $_POST['icon'], intval($_POST['id']));
$stmt->execute();
header('Location: /admin/edit-content.php?updated=true&content=' . htmlspecialchars($_POST['id']));
exit();
?>
