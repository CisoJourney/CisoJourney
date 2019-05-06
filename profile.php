<?php
session_start();

if (!isset($_SESSION['email'])) {
  header('Location: /login.php');
  exit();
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/navbar.php'


?>

<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <h3 class="uppercase-text black-text">Profile</h3>
      <p>Update your settings or check your subscription status!</p>
    </div>
    <div class="content-wrapper">
      <div class="content-full"><a href="/categories.php">
        <div class="content-block center-text">
          <h5 class="uppercase-text spacing-text">Strategy</h5>
          <p>Articles covering the critical foundation topics of cybersecurity; such as how to plan, manage, and implement your security plans.</p>
        </div></a>
      </div>
      </a>
    </div>
  </div>
</div>
</body>
</html>
