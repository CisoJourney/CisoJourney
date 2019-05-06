<?php
include ('/var/www/CISOJourney.com/auth.php');

if (!isset($_POST['email']) or !isset($_POST['password']) or !isset($_POST['confirm'])) {
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

$email = $_POST['email'];
$salt = openssl_random_pseudo_bytes(64);
$iterations = 10000;
$hash = hash_pbkdf2('sha3-512', $_GET['password'], $salt , $iterations);
$privs = 0;

if ($stmt = $mysqli->prepare("INSERT INTO users (email, salt, iterations, hash, privs) VALUES (?, ?, ?, ?, ?);")) {
    $stmt->bind_param("ssisi", $email, $salt, $iterations, $hash, $privs);
    $stmt->execute();
}

header('Location: https://cisojourney.com/profile.php');
?>
