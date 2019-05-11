<?php
// TODO: Comment and refactor
include_once $_SERVER['DOCUMENT_ROOT'] . '/session.php';

session_regenerate_id(true);

include_once $_SERVER['DOCUMENT_ROOT'] . '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';

$securimage = new Securimage();

if ($securimage->check($_POST['captcha_code']) == false) {
  softRedirect('/login.php?error=captcha');
}
else if (!isset($_POST['email']) or !isset($_POST['password'])) {
  softRedirect('/login.php?error=missing');
}
else if ($_POST['email'] == "" or $_POST['password'] == "") {
  softRedirect('/login.php?error=blank');
}

$email = $_POST['email'];
$result = execPrepare($mysqli, "SELECT * FROM users WHERE email = ?;", array("s", $email));
$row = $result->fetch_assoc();

if ($row['email'] != $email) {
  header('Location: https://cisojourney.com/login.php?error=user');
  exit();
}
else {
  $salt      = $row['salt'];
  $iter      = $row['iterations'];
  $hash      = $row['hash'];
  $privs     = $row['privs'];
  // TODO: It's kinda weird that the algo is the only thing hardcoded
  $checkhash = hash_pbkdf2('sha3-512', $_POST['password'], $salt , $iter);

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
