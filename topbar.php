<?php
function drawTopBar() {
  // Inefficient to define var that might not be used, but the benefit is readability
  $adminLink    = '<a href="/admin/index.php">Admin</a>';
  $profileLink  = '<a href="/profile.php">My Profile</a>';
  $logoutLink   = '<a href="/logout.php">Log out</a>';
  $loginLink    = '<a href="/login.php">Sign in</a>';
  $registerLink = '<a href="/register.php">Register</a>';

  if      ($_SESSION['privs'] == 3) { print $adminLink   . ' | ' . $profileLink . ' | ' . $logoutLink; } // user is admin
  else if ($_SESSION['privs'] >= 0) { print $profileLink . ' | ' . $logoutLink; }			 // user is user
  else                              { print $loginLink   . ' | ' $registerLink; }			 // user is unauthed
}
?>
<div class="top-bar">
  <div class="logo"><a href="https://cisojourney.com/">Ciso: Journey</a></div>
  <div class="profile-buttons"><?php drawTopBar(); ?></div>
</div>
