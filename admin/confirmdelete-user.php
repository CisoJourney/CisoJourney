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
else if ($_POST['email'] == "") {
  header('Location: /admin/delete-user.php?error=blank&user=' . htmlspecialchars($_POST['email']));
  exit();
}

$stmt = $mysqli->prepare("DELETE FROM users WHERE email = ?;");
$stmt->bind_param("s", $_POST['email']);
$stmt->execute();
header('Location: /admin/users.php?deleted=true&user=' . htmlspecialchars($_POST['email']));
exit();
?>
