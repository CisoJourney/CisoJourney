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
else if (!isset($_POST['nav']) or !isset($_POST['title']) or !isset($_POST['url'])) {
  header('Location: /admin/edit-topnav.php?error=missing');
  exit();
}
else if ($_POST['nav'] == "" or $_POST['title'] == "" or $_POST['url'] == "") {
  header('Location: /admin/edit-topnav.php?error=blank');
  exit();
}

$stmt = $mysqli->prepare("UPDATE topnav SET title = ?, url = ? WHERE id = ?;");
$stmt->bind_param("ss", $_POST['title'], $_POST['url']);
$stmt->execute();
header('Location: /admin/edit-topnav.php');
exit();
?>
