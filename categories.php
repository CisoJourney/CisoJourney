<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

function drawCategories($mysqli, $area) {
  $result = execPrepare($mysqli, "SELECT id,title,description,icon FROM categories WHERE area =  ?;", array("i");
  while($row = $result->fetch_assoc()) {
    $id    = htmlspecialchars($row['id']);
    $area  = htmlspecialchars($_GET['area']);
    $icon  = htmlspecialchars($row['icon']);
    $title = htmlspecialchars($row['title']);
    $desc  = htmlspecialchars($row['description']);

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
      <h3 class="uppercase-text black-text">Cybersecurity Strategy</h3>
      <p>A chat full of security strategy hints, tips, and discussion.</p>
    </div>
    <div class="content-wrapper">
      <?php drawCategories($mysqli, $area); ?>
    </div>
  </div>
</div>
</body>
</html>
