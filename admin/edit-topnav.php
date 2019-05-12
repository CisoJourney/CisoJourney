<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if      ($_SESSION['privs'] < 3) { softRedirect('/profile.php'); }
else if (!isset($_GET['nav']))   { softRedirect('/admin/topnav.php'); }

include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <h3 class="uppercase-text black-text">Administer Menu</h3>
      <p>Modifying a menu item...</p>
    </div>
    <div class="content-full">
      <p><a href="/admin/index.php">Admin</a> &gt;&gt; <a href="/admin/edit-topnav.php">Top Nav</a> &gt;&gt; Edit Item</p>
    </div>
    <div class="content-wrapper">
      <div class="content-full">
        <div class="content-block">
          <div class="block-icon"><i class="fas fa-search"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Edit Menu</h5>
<?php
if (isset($_GET['error'])) {
  if ($_GET['error'] == 'missing' or $_GET['error'] == 'blank') {
    print('<p class="red-text">Oops, all fields are required!</p>');
  }
}

if (isset($_GET['updated'])) {
  if ($_GET['updated'] == 'true') {
    print('<p class="black-text">Nav Updated!</p>');
  }
}
else if (isset($_GET['added'])) {
  if ($_GET['added'] == 'true') {
    print('<p class="black-text">Nav Added!</p>');
  }
}

$stmt = $mysqli->prepare("SELECT id,area,title,url FROM topnav WHERE id = ?;");
$stmt->bind_param("s", $_GET['nav']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$id    = clean($row['id']);
$area  = clean($row['area']);
$title = clean($row['title']);
$url   = clean($row['url']);

?>
<form method="POST" action="/admin/update-topnav.php">
<input class="login-input" name="id" type="hidden" value="<?php print $id; ?>">
<input class="login-input" name="area" type="text" value="<?php print $area; ?>">
<input class="login-input" name="title" type="text" value="<?php print $title; ?>">
<input class="login-input" name="url" type="text" value="<?php print $url; ?>">
<input class="login-button" value="Update" type="submit">
</form>

        </div>
      </div>
      </a>
    </div>
  </div>
</div>
</body>
</html>
