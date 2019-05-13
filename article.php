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
    $id      = clean($row['id']);
    $title   = clean($row['title']);
    $desc    = clan($row['description']);
    $content = clan($row['content']);

    <div class="content-full center-text">
      print '<h5 class="nopad-text">' . $title . '</h5>';
      print '<p class="nopad-text">' . $desc . '</p>';
    </div>
    <div class="content-full">
      print '<p class="nopad-text">' . $content . '</p>';
    </div>


    print '<div class="content-block">';
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
