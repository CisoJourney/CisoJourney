<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

function drawFrontPage($mysqli) {
  $result = $mysqli->query("SELECT id,title,description,icon FROM areas;");
  while($row = $result->fetch_assoc()) {
    $id    = htmlspecialchars($row['id']);	// TODO: INT in the DB, filtering is excessive
    $title = htmlspecialchars($row['title']);
    $desc  = htmlspecialchars($row['description']);
    $icon  = htmlspecialchars($row['icon']);

    // TODO: What a mess
    print '<div class="content-trio">';
    print '<div class="content-block center-text">';
    print '<a href="/categories.php?area=' . $id . '">';
    if ($title == 'Labs') { print '<div class="labs-comingsoon">Coming Soon!</div>'; }
    print '<div class="block-icon"><i class="' . $icon . '"></i></div>';
    print '<h5 class="uppercase-text spacing-text">' . $title . '</h5>';
    print '<p>' . $desc . '</p>';
    print '</div>';
    print '</a>';
    print '</div>';
  }
}
?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <h3 class="uppercase-text black-text">Cybersecurity Strategy</h3>
      <p>A site full of security strategy hints, tips, and discussion.</p>
    </div>
    <div class="content-wrapper">
      <?php drawFrontPage($mysqli); ?>
    </div>
  </div>
</div>
</body>
</html>
