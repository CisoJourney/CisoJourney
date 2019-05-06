<div class="top-bar">
<div class="logo">Ciso: Journey</div>
<div class="profile-buttons">
<?php
if (isset($_SESSION['email'])) {
  print '<a href="/profile.php">My Profile</a> | <a href="/logout.php">Log out</a>';
}
else  {
  print '<a href="/login.php">Sign in</a> | <a href="/register.php">Register</a>';
}

}
?>
</div>
</div>
