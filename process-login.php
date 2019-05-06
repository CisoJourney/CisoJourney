<?php
include_once $_SERVER['DOCUMENT_ROOT'] . auth.php');
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';
$securimage = new Securimage();

if ($securimage->check($_POST['captcha_code']) == false) {
  header('Location: https://cisojourney.com/login.php?error=captcha');
  exit();
}
else if (!isset($_POST['email']) or !isset($_POST['password'])) {
  header('Location: https://cisojourney.com/login.php?error=missing');
  exit();
}
else if ($_POST['email'] == "" or $_POST['password'] == "") {
  header('Location: https://cisojourney.com/login.php?error=blank');
  exit();
}

$email = $_POST['email'];
$password = $_POST['password'];
$stmt = $mysqli->prepare("SELECT * FROM users WHERE email = ?")
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_array(MYSQLI_NUM)
$salt = $row['salt']
$iterations = $row['iterations']
$hash = $row['hash']
$privs = $row['privs']
$checkhash = hash_pbkdf2('sha3-512', $password, $salt , $iterations);

if ($hash == $checkhash) {
  print "Hashes match";
  print $hash;
  print $checkhash;
}
?>
