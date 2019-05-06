<div class="top-bar">
  <div class="logo"><a href="https://cisojourney.com/">Ciso: Journey</a></div>
  <div class="profile-buttons">
<?php
if (isset($_SESSION['email'])) {
  if ($_SESSION['privs'] == 3) {
    print '<a href="/admin/index.php">Admin</a> | ';
  }
  print '<a href="/profile.php">My Profile</a> | <a href="/logout.php">Log out</a>';
}
else  {
  print '<a href="/login.php">Sign in</a> | <a href="/register.php">Register</a>';
}
?>
  </div>
</div>
