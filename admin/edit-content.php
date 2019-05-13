<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if ($_SESSION['privs'] < 3)        { softRedirect('/profile.php'); }
else if (!isset($_GET['content'])) { softRedirect('/admin/contents.php'); }

include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <h3 class="uppercase-text black-text">Administer Content</h3>
      <p>Modifying index content...</p>
    </div>
    <div class="content-full">
      <p><a href="/admin/index.php">Admin</a> &gt;&gt; <a href="/admin/content.php">Edit Content</a> &gt;&gt; Edit Item</p>
    </div>    <div class="content-wrapper">
      <div class="content-full">
        <div class="content-block">
          <div class="block-icon"><i class="fas fa-align-justify"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Content</h5>
<?php
if (isset($_GET['error'])) {
  if ($_GET['error'] == 'missing' or $_GET['error'] == 'blank') {
    print('<p class="red-text">Oops, all fields are required!</p>');
  }
}
if (isset($_GET['updated'])) {
  if ($_GET['updated'] == 'true') {
    print('<p class="black-text">Updated!</p>');
  }
}

$result = execPrepare($mysqli, "SELECT id,title,slug,description,icon FROM areas WHERE id = ?;", array("s", $_GET['content']));
$row = $result->fetch_assoc();

$id    = clean($row['id']);
$title = clean($row['title']);
$desc  = clean($row['description']);
$icon  = clean($row['icon']);
$slug  = clean($row['slug']);
?>
<form method="POST" action="/admin/update-content.php">
<input class="login-input dim-input" name="id" value="<?php print $id; ?>" readonly>
<input class="login-input" name="title" value="<?php print $title; ?>">
<input class="login-input" name="slug" value="<?php print $slug; ?>">
<input class="login-input" name="description" value="<?php print $desc; ?>">
<input class="login-input" name="icon" value="<?php print $icon; ?>">
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
