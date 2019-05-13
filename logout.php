<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

session_start();
$_SESSION = array();
session_destroy();
softRedirect('/index.php');
?>
