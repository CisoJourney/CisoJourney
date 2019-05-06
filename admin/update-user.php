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
else if (!isset($_POST['email'])) {
  header('Location: /admin/users.php');
  exit();
}
else if (!isset($_POST['privs']) or !isset($_POST['email'])) {
  header('Location: /admin/edit-user.php?error=missing&user=' . htmlspecialchars($_POST['email']));
  exit();
}
else if ($_POST['privs'] == "" or $_POST['email'] == "") {
  header('Location: /admin/edit-user.php?error=blank&user=' . htmlspecialchars($_POST['email']));
  exit();
}

$stmt = $mysqli->prepare("UPDATE users SET privs = ? WHERE email = ?;");
$stmt->bind_param("is", intval($_POST['privs']), $_POST['email']);
$stmt->execute();
header('Location: /admin/edit-user.php?updated=true&user=' . htmlspecialchars($_POST['email']));
exit();
?>
