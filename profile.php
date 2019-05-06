<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/auth.php';
session_start();

if (isset($_SESSION['email'])) {
  print "Logged in";
}
?>
