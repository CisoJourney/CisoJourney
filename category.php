<?php
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

// Area variable from navbar.php
function drawCategoryDesc($mysqli, $area) {
  $stmt = $mysqli->prepare("SELECT title,description FROM area WHERE area = ?;");
  $stmt->bind_param("i", $area);
  $stmt->execute();
  $result = $stmt->get_result();

  while($row = $result->fetch_assoc()) {
    $title = htmlspecialchars($row['title']);
    $desc  = htmlspecialchars($row['description']);

    print '<h3 class="uppercase-text black-text">' . $title . '</h3>
    print '<p>' . $desc . '</p>';
  }
}

function drawCategory($mysqli) {
  $stmt = $mysqli->prepare("SELECT area,title,description FROM articles WHERE area = 1 and category = ?;");
  $stmt->bind_param("i", intval($_GET['id']));
  $stmt->execute();
  $result = $stmt->get_result();

  while($row = $result->fetch_assoc()) {
    $title = htmlspecialchars($row['title']);
    $desc  = htmlspecialchars($row['description']);

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
      <?php drawCategoryDesc($mysqli, $area); ?>
    </div>
    <div class="content-full">
      <?php drawCategory($mysqli); ?>
    </div>
  </div>
</div>
</body>
</html>
