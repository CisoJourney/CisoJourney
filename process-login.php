<?php
// TODO: Comment and refactor
session_start();
session_regenerate_id(true);

include_once $_SERVER['DOCUMENT_ROOT'] . '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';

$securimage = new Securimage();

if ($securimage->check($_POST['captcha_code']) == false) {
  header('Location: /login.php?error=captcha');
  exit();
}
else if (!isset($_POST['email']) or !isset($_POST['password'])) {
  header('Location: /login.php?error=missing');
  exit();
}
else if ($_POST['email'] == "" or $_POST['password'] == "") {
  header('Location: /login.php?error=blank');
  exit();
}

$email = $_POST['email'];
$result = execPrepare($mysqli, "SELECT * FROM users WHERE email = ?;", array("s", $email);
$row = $result->fetch_assoc();

if ($row['email'] != $email) {
  header('Location: https://cisojourney.com/login.php?error=user');
  exit();
}
else {
  $salt = $row['salt'];
  $iterations = $row['iterations'];
  $hash = $row['hash'];
  $privs = $row['privs'];
  $checkhash = hash_pbkdf2('sha3-512', $_POST['password'], $salt , $iterations);

  if ($hash == $checkhash) {
    header('Location: /login.php?error=user');
    $_SESSION['email'] = $email;
    $_SESSION['privs'] = $privs;
    exit();
  }
  else {
    header('Location: /login.php?error=user');
    exit();
  }
}
?>
