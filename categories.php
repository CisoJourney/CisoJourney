<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if (isset($_GET['slug'])) {
  $result = execPrepare($mysqli, "SELECT id FROM areas WHERE slug = ?;", array("s", $_GET['slug']));
  $row = $result->fetch_assoc();
  $area = $row['id'];
}
else {
  softRedirect('/error/404/');
}

include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

function drawCategoryDesc($mysqli, $area) {
  $result = execPrepare($mysqli, "SELECT title,description FROM areas WHERE slug = ?;", array("s", $_GET['slug']));
  while($row = $result->fetch_assoc()) {
    $title = clean($row['title']);
    $desc  = clean($row['description']);

    print '<h3 class="uppercase-text black-text">' . $title . '</h3>';
    print '<p>' . $desc . '</p>';
    if ($title == 'Labs') { print '<div class="labs-comingsoon">Coming Soon!</div>'; }
  }
}


function drawCategories($mysqli, $area) {
  $result = execPrepare($mysqli, "SELECT id,title,description,icon,slug FROM categories WHERE area = (SELECT id FROM areas WHERE slug = ?) AND hidden = 0;", array("s", $_GET['slug']));
  while($row = $result->fetch_assoc()) {
    $id    = clean($row['id']);
    $icon  = clean($row['icon']);
    $title = clean($row['title']);
    $desc  = clean($row['description']);
    $slug  = clean($row['slug']);

    print '<div class="content-duo">';
    print '<div class="content-block center-text">';
    print '<a href="/category/' . $slug . '/">';
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
