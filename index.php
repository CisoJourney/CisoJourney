<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

function drawFrontPage($mysqli) {
  $result = $mysqli->query("SELECT id,title,description,icon FROM areas;");
  while($row = $result->fetch_assoc()) {
    $id    = clean($row['id']);
    $title = clean($row['title']);
    $desc  = clean($row['description']);
    $icon  = clean($row['icon']);

    // TODO: What a mess
    print '<div class="content-trio">';
    print '<div class="content-block center-text">';
    print '<a href="/categories.php?area=' . $id . '">';
    if ($title == 'Labs') { print '<div class="labs-comingsoon">Coming Soon!</div>'; }
    print '<div class="block-icon"><i class="' . $icon . '"></i></div>';
    print '<h5 class="uppercase-text spacing-text">' . $title . '</h5>';
    print '<p>' . $desc . '</p>';
    print '</a>';
    print '</div>';
    print '</div>';
  }
}
?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <h3 class="uppercase-text black-text">CISO: Journey Group</h3>
      <p>A collection of resources for CISOs, Security Managers, Security Engineers, and Penetration Testers. Offering real-world security information, presented neatly, in bite-size pieces.</p>
    </div>
    <div class="content-wrapper">
      <?php drawFrontPage($mysqli); ?>
    </div>
    <p>&nbsp</p>
    <div class="content-full">
      <h3 class="uppercase-text center-text black-text">Random Posts</h3>
    </div>
    <div class="content-full">
<?php
  $result = $mysqli->query("SELECT title,description,slug FROM articles ORDER BY RAND() LIMIT 3;");
  while($row = $result->fetch_assoc()) {
    $title = clean($row['title']);
    $desc  = clean($row['description']);
    $slug  = clean($row['slug']);

    print '<div class="content-block">';
    print '<a href="/article/' . $slug . '/">';
    print '<h3 class="black-text nopad-text">' . $title .'</h3>';
    print '<p class="nopad-text">' . $desc .'</p>';
    print '</a></div>';
}
?>
      </div>
    </div>
  </div>
</div>
</body>
</html>
