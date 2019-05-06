<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

if (!isset($_SESSION['privs']) {
  header('Location: /login.php');
  exit();
}
else if ($_SESSION['privs'] == 3) {
  header('Location: /login.php');
  exit();
}
else {
  header('Location: /profile.php');
  exit();
}
?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <h3 class="uppercase-text black-text">Cybersecurity Strategy</h3>
      <p>A site full of security strategy hints, tips, and discussion.</p>
    </div>
    <div class="content-wrapper">
      <div class="content-quatro">
        <div class="content-block">
          <div class="block-icon"><i class="fas fa-users"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Users</h5>
          <p></p>
        </div>
      </div>
      <div class="content-quatro">
        <div class="content-block">
          <div class="block-icon"><i class="fas fa-layer-group"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Categories</h5>
          <p></p>
        </div>
      </div>
      <div class="content-quatro">
        <div class="content-block">
          <div class="block-icon"><i class="fas fa-book"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Articles</h5>
          <p></p>
        </div>
      </div>
      <div class="content-quatro">
        <div class="content-block">
          <div class="block-icon"><i class="fas fa-align-justify"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Content</h5>
          <p></p>
        </div>
      </div>
      <div class="content-quatro">
        <div class="content-block">
          <div class="block-icon"><i class="fas fa-flask"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Labs</h5>
          <p></p>
        </div>
      </div>
      </a>
    </div>
  </div>
</div>
</body>
</html>
