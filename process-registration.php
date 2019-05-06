<?php
if (!isset($_POST['email']) or !isset($_POST['password']) or !isset($_POST['confirm'])) {
  header('https://cisojourney.com/register.php?error=missing');
}
else if ($_POST['email'] == "" or $_POST['password'] == "" or $_POST['confirm'] == "") {
  header('https://cisojourney.com/register.php?error=blank');
}
else if ($_POST['password'] != $_POST['confirm']) {
  header('https://cisojourney.com/register.php?error=match');
}
?>
