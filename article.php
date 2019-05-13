<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

function drawArticle($mysqli, $area) {
  // TODO: ID is caps here but not in other tables
  $result = execPrepare($mysqli, "SELECT title,description,content FROM articles WHERE ID = ? AND hidden = 0;", array("i", $_GET['id']));
  while($row = $result->fetch_assoc()) {
    $title   = clean($row['title']);
    $desc    = clean($row['description']);
    $content = clean($row['content']);

    print '<div class="content-full center-text">';
    print '<h1 class="black-text nopad-text">' . $title . '</h1>';
    print '<p class="nopad-text">' . $desc . '</p>';
    print '</div>';
    print '<div class="content-full">';
    print '<div class="content-block">';
    print '<p class="nopad-text">' . $content . '</p>';
    print '</div>';
    print '</div>';
  }
}
?>
<div class="page-wrapper">
  <div class="content">
    <?php drawArticle($mysqli, $area); ?>
  </div>
</div>
</body>
</html>
