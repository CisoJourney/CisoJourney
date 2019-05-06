<?php
include('/var/www/CISOJourney.com/head.php');
include('/var/www/CISOJourney.com/topbar.php');
include('/var/www/CISOJourney.com/navbar.php')
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
          <input class="login-input" type="text">
          <input class="login-input" type="password">
          <img id="captcha" src="/securimage/securimage_show.php" alt="CAPTCHA Image" />
          <input class="login-input" type="text" name="captcha_code" size="10" maxlength="6" placeholder="Captcha code (case insensitive)" />
          <input class="login-button" type="submit">
        </div>
      </div>
  </div>
</div>
</body>
</html>
