<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

function drawCategoryDesc($mysqli, $area) {
  if (isset($_GET['slug'])) {
    $result = execPrepare($mysqli, "SELECT title,description FROM areas WHERE slug = ? AND id = ?;", array("si", $_GET['slug'], $area));
  }
  else {
    $result = execPrepare($mysqli, "SELECT title,description FROM areas WHERE id = ?;", array("i", $area));
  }
  while($row = $result->fetch_assoc()) {
    $title = clean($row['title']);
    $desc  = clean($row['description']);

    print '<h3 class="uppercase-text black-text">' . $title . '</h3>';
    print '<p>' . $desc . '</p>';
    if ($title == 'Labs') { print '<div class="labs-comingsoon">Coming Soon!</div>'; }
  }
}


function drawCategories($mysqli, $area) {
  $result = execPrepare($mysqli, "SELECT id,title,description,icon FROM categories WHERE area = ? AND hidden = 0;", array("s", $area));
  while($row = $result->fetch_assoc()) {
    $id    = clean($row['id']);
    $icon  = clean($row['icon']);
    $title = clean($row['title']);
    $desc  = clean($row['description']);

    print '<div class="content-duo">';
    print '<div class="content-block center-text">';
    print '<a href="/category.php?id=' .  $id . '&area=' . $area . '">';
    print '<div class="block-icon ciso-color"><i class="' . $icon . '"></i></div>';
    print '<h5 class="uppercase-text spacing-text">' .  $title . '</h5>';
    print '<p>' . $desc . '</p>';
    print '</div></a>';
    print '</div>';
  }
}
?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <?php drawCategoryDesc($mysqli, $area); ?>
    </div>
    <div class="content-wrapper">
      <?php drawCategories($mysqli, $area); ?>
    </div>
  </div>
</div>
</body>
</html>
