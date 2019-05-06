<?php
include('/var/www/CISOJourney.com/head.php');
include('/var/www/CISOJourney.com/topbar.php');
include('/var/www/CISOJourney.com/navbar.php')
?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <h3 class="uppercase-text black-text">Register</h3>
      <p>Sign-in or register to access member only functions!</p>
    </div>
    <div class="content-wrapper">
        <div class="login-block center-text">
          <h5 class="uppercase-text spacing-text">Register</h5>
          <form method="POST" action="process-registration.php">
            <input class="login-input" type="text" placeholder="e-mail">
            <input class="login-input" type="password" placeholder="password">
            <input class="login-input" type="password" placeholder="confirm password">
            <input class="login-button" type="submit">
          </form>
        </div>
      </div>
  </div>
</div>
</body>
</html>
