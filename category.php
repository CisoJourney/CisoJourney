<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

function drawCategoryDesc($mysqli) {
  $result = execPrepare($mysqli, "SELECT title,description FROM categories WHERE id = ? AND hidden = 0;", array("i", $_GET['id']));
  while($row = $result->fetch_assoc()) {
    $title = htmlspecialchars($row['title']);
    $desc  = htmlspecialchars($row['description']);

    print '<h3 class="uppercase-text black-text">' . $title . '</h3>';
    print '<p>' . $desc . '</p>';
  }
}

function drawCategory($mysqli, $area) {
  $result = execPrepare($mysqli, "SELECT id,area,title,description FROM articles WHERE area = ? AND category = ? AND hidden = 0;", array("ii", $area, $_GET['id']));
  while($row = $result->fetch_assoc()) {
    $id    = clean($row['id']);
    $title = clean($row['title']);
    $desc  = clean($row['description']);

    print '<div class="content-block">';
    print '<a href="/article.php?id=' . $id . '">';
    print '<h5 class="nopad-text">' . $title . '</h5>';
    print '<p class="nopad-text">' . $desc . '</p>';
    print '</a></div>';
  }
}
?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <?php drawCategoryDesc($mysqli); ?>
    </div>
    <div class="content-full">
      <?php drawCategory($mysqli, $area); ?>
    </div>
  </div>
</div>
</body>
</html>
