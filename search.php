<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';
?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <h3 class="uppercase-text black-text">Cybersecurity Strategy</h3>
      <p>A site full of security strategy hints, tips, and discussion.</p>
    </div>
    <div class="content-full">
      <div class="content-block center-text">
        <input type="text" class="login-input center-text" placeholder="Search for..." />
        <a href="/searched.php"><input class="login-button" type="submit" value="Search" /></a>
      </div>
    </div>
  </div>
</div>
</body>
</html>
