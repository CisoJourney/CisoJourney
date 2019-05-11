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
    print '</a>';
    print '</div>';
    print '</div>';
  }
}
?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <h3 class="uppercase-text black-text">Error 404</h3>
      <p>Sorry, the requested file could not be found :(</p>
    </div>
    <div class="content-wrapper">
      <?php drawFrontPage($mysqli); ?>
    </div>
    <!-- Simulate some content to play with styles -->
    <div class="content-wrapper">
      <div class="content-duo">
        <h3 class="uppercase-text center-text black-text">Most Popular Posts</h3>
        <div class="content-block">
          <h3 class="black-text nopad-text">Article title here</h3>
          <p class="nopad-text">Article content goes here</p>
        </div>
        <div class="content-block">
          <h3 class="black-text nopad-text">Article title here</h3>
          <p class="nopad-text">Article content goes here</p>
        </div>
        <div class="content-block">
          <h3 class="black-text nopad-text">Article title here</h3>
          <p class="nopad-text">Article content goes here</p>
        </div>
      </div>
      <div class="content-duo">
        <h3 class="uppercase-text center-text black-text">Most Popular Posts</h3>
        <div class="content-block">
          <h3 class="black-text nopad-text">Article title here</h3>
          <p class="nopad-text">Article content goes here</p>
        </div>
        <div class="content-block">
          <h3 class="black-text nopad-text">Article title here</h3>
          <p class="nopad-text">Article content goes here</p>
        </div>
        <div class="content-block">
          <h3 class="black-text nopad-text">Article title here</h3>
          <p class="nopad-text">Article content goes here</p>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
