<?php
include ('/var/www/CISOJourney.com/auth.php');
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';
$securimage = new Securimage();

if ($securimage->check($_POST['captcha_code']) == false) {
  header('Location: https://cisojourney.com/register.php?error=captcha');
  exit();
}
else if (!isset($_POST['email']) or !isset($_POST['password']) or !isset($_POST['confirm'])) {
  header('Location: https://cisojourney.com/register.php?error=missing');
  exit();
}
else if ($_POST['email'] == "" or $_POST['password'] == "" or $_POST['confirm'] == "") {
  header('Location: https://cisojourney.com/register.php?error=blank');
  exit();
}
else if ($_POST['password'] != $_POST['confirm']) {
  header('Location: https://cisojourney.com/register.php?error=match');
  exit();
}
else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  header('Location: https://cisojourney.com/register.php?error=email');
  exit();
}

$email = $_POST['email'];
$password = $_POST['password'];
$salt = openssl_random_pseudo_bytes(64);
$iterations = 10000;
$hash = hash_pbkdf2('sha3-512', $password, $salt , $iterations);
$privs = 0;

if ($stmt = $mysqli->prepare("SELECT email FROM users WHERE email = ?;")) {
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->store_result();
  if ($stmt->num_rows) > 0 {
    header('Location: https://cisojourney.com/register.php?error=taken');
    exit();
  }
  else {
    $stmt = $mysqli->prepare("INSERT INTO users (email, salt, iterations, hash, privs) VALUES (?, ?, ?, ?, ?);");
    $stmt->bind_param("ssisi", $email, $salt, $iterations, $hash, $privs);
    $stmt->execute();
    $_SESSION['email'] = $email;
    $_SESSION['privs'] = $privs;
    header('Location: https://cisojourney.com/profile.php');
    exit();
  }
}

?>
