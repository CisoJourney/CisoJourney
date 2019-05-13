<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if ($_SESSION['privs'] < 3) { softRedirect('/profile.php'); }

include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <h3 class="uppercase-text black-text">Administer Site</h3>
      <p>Jus' don't screw it up.</p>
    </div>
    <div class="content-wrapper">
      <div class="content-quatro"><a href="/admin/users.php">
        <div class="content-block">
          <div class="block-icon"><i class="fas fa-users"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Users</h5>
          <p></p></a>
        </div>
      </div>
      <div class="content-quatro">
        <div class="content-block"><a href="/admin/categories.php">
          <div class="block-icon"><i class="fas fa-layer-group"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Categories</h5>
          <p></p></a>
        </div>
      </div>
      <div class="content-quatro">
        <div class="content-block"><a href="/admin/articles.php">
          <div class="block-icon"><i class="fas fa-book"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Articles</h5>
          <p></p></a>
        </div>
      </div>
      <div class="content-quatro">
        <div class="content-block"><a href="/admin/content.php">
          <div class="block-icon"><i class="fas fa-align-justify"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Content</h5>
          <p></p></a>
        </div>
      </div>
      <div class="content-quatro">
        <div class="content-block"><a href="/admin/labs.php">
          <div class="block-icon"><i class="fas fa-flask"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Labs</h5>
          <p></p></a>
        </div>
      </div>
      <div class="content-quatro">
        <div class="content-block"><a href="/admin/topnav.php">
          <div class="block-icon"><i class="fas fa-search"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Top Nav</h5>
          <p></p></a>
        </div>
      </div>
      </a>
    </div>
  </div>
</div>
</body>
</html>
