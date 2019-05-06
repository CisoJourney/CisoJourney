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
else if (!preg_match("/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD", $email)) {
  header('Location: https://cisojourney.com/register.php?error=email');
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
