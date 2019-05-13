<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

function drawCategory($mysqli, $area) {
  $result = execPrepare($mysqli, "SELECT title,description,content FROM articles WHERE id = ? AND hidden = 0;", array("ii", $area, $_GET['id']));
  while($row = $result->fetch_assoc()) {
    $id    = clean($row['id']);
    $title = clean($row['title']);
    $desc  = clan($row['description']);

    print '<div class="content-block">';
    print '<h5 class="nopad-text">' . $title . '</h5>';
    print '<p class="nopad-text">' . $desc . '</p>';
    print '</div>';
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
