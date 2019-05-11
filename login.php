<?php
session_start();

if (isset($_SESSION['email'])) {
  header('Location: /profile.php');
  exit();
}

include_once $_SERVER['DOCUMENT_ROOT'] .  '/header.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <h3 class="uppercase-text black-text">Sign-in</h3>
      <p>Sign-in or register to access member only functions!</p>
    </div>
    <div class="content-wrapper">
        <div class="login-block center-text">
          <h5 class="uppercase-text spacing-text">Sign-in</h5>
<p class="red-text"><?php
if (isset($_GET['error'])) {
  if ($_GET['error'] == 'captcha') {
   print('Oops, captcha code was incorrect!');
  }
  else if ($_GET['error'] == 'missing') {
   print('Oops, all fields are required!');
  }
  else if ($_GET['error'] == 'blank') {
   print('Oops, all fields are required!');
  }
  else if ($_GET['error'] == 'user') {
   print('Oops, invalid credentials!');
  }
}
?><p>
          <form method="POST" action="process-login.php">
            <input class="login-input" name="email" type="text" placeholder="e-mail" />
            <input class="login-input" name="password" type="password" placeholder="password" autcomplete="off" />
            <img id="captcha" src="/securimage/securimage_show.php" alt="CAPTCHA Image" />
            <input class="login-input" type="text" name="captcha_code" size="10" maxlength="6" placeholder="captcha code (case insensitive)" autocomplete="off" />
            <input class="login-button" value="Login" type="submit" />
          </form>
        </div>
      </div>
  </div>
</div>
</body>
</html>
