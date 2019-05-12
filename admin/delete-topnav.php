<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if      ($_SESSION['privs'] < 3)    { softRedirect('/profile.php'); }
else if (!isset($_GET['nav'])) { softRedirect('/admin/topnav.php'); }

include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <h3 class="uppercase-text black-text">Delete Category</h3>
      <p>Deleting a Category!</p>
    </div>
    <div class="content-full">
      <p><a href="/admin/index.php">Admin</a> &gt;&gt; <a href="/admin/topnv.php">Edit Nav</a> &gt;&gt; Delete Nav</p>
    </div>
      <div class="content-wrapper">
      <div class="content-full">
        <div class="content-block">
          <div class="block-icon"><i class="fas fa-search"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Top Nav</h5>
<?php
if (isset($_GET['error'])) {
  if ($_GET['error'] == 'blank' or $_GET['error'] == 'mising') {
    print('<p class="red-text">Oops, all fields are required!</p>');
  }
}

// TODO: Check the supplied user exists
$result = execPrepare($mysqli, "SELECT id,title FROM topnav WHERE id = ?;", array("s", $_GET['nav']));
$row = $result->fetch_assoc();
$id    = clean($row['id']);
$title = clean($row['title']);

?>
<form method="POST" action="/admin/confirmdelete-topnav.php">
<input class="login-input dim-input" name="id" value="<?php print $id; ?>" readonly />
<input class="login-input dim-input" name="title" value="<?php print $title; ?>" readonly />
<input class="admin-button red-button" value="Confirm Delete" type="submit">
</form>

        </div>
      </div>
      </a>
    </div>
  </div>
</div>
</body>
</html>
