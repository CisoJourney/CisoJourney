<?php
session_start();

if (!isset($_SESSION['email'])) {
  $_SESSION['privs'] = -1;		// Remember that the user is not logged in
}
?>
