<?php
// TODO: comment and refactor

include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';

if ($_SESSION['privs'] >= 0) {
  header('Location: /profile.php');
  exit();
}

include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';
$securimage = new Securimage();

if ($securimage->check($_POST['captcha_code']) == false) {
  header('Location: /register.php?error=captcha');
  exit();
}
else if (!isset($_POST['email']) or !isset($_POST['password']) or !isset($_POST['confirm'])) {
  header('Location: /register.php?error=missing');
  exit();
}
else if ($_POST['email'] == "" or $_POST['password'] == "" or $_POST['confirm'] == "") {
  header('Location: /register.php?error=blank');
  exit();
}
else if ($_POST['password'] != $_POST['confirm']) {
  header('Location: /register.php?error=match');
  exit();
}
else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  header('Location: /register.php?error=email');
  exit();
}

$email = $_POST['email'];
$password = $_POST['password'];
$salt = openssl_random_pseudo_bytes(64);
$iterations = 10000;
$hash = hash_pbkdf2('sha3-512', $password, $salt , $iterations);
$privs = 0;

if (numPrepare($mysqli, "SELECT email FROM users WHERE email = ?;", array("s", $email))) {
  header('Location: https://cisojourney.com/register.php?error=taken');
  exit();
}
else {
  // TODO: Split this for readability
  $result = execPrepare($mysqli, "INSERT INTO users (email, salt, iterations, hash, privs) VALUES (?, ?, ?, ?, ?);", array("ssisi", $email, $salt, $iterations, $hash, $privs));
  $_SESSION['email'] = $email;
  $_SESSION['privs'] = $privs;
  header('Location: /profile.php');
  exit();
}
?>
