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
else if (!isset($_POST['nav'])) {
  header('Location: /admin/topnav.php');
  exit();
}
else if (!isset($_POST['title']) or !isset($_POST['url'])) {
  header('Location: /admin/edit-topnav.php?error=missing&nav=' . htmlspecialchars($_POST['nav']));
  exit();
}
else if ($_POST['title'] == "" or $_POST['url'] == "") {
  header('Location: /admin/edit-topnav.php?error=blank&nav=' . htmlspecialchars($_POST['nav']));
  exit();
}

$stmt = $mysqli->prepare("UPDATE topnav SET title = ?, url = ? WHERE id = ?;");
$stmt->bind_param("sss", $_POST['title'], $_POST['url'], $_POST['nav']);
$stmt->execute();
header('Location: /admin/edit-topnav.php?nav=' . htmlspecialchars($_POST['nav']));
exit();
?>
