<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

if      ($_SESSION['privs'] < 3)    { softRedirect('/profile.php'); }
else if (!isset($_GET['category'])) { softRedirect('/admin/categories.php'); }
?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <h3 class="uppercase-text black-text">Delete Category</h3>
      <p>Deleting a Category!</p>
    </div>
    <div class="content-full">
      <p><a href="/admin/index.php">Admin</a> &gt;&gt; <a href="/admin/categories.php">Edit Categories</a> &gt;&gt; Delete Category</p>
    </div>    <div class="content-wrapper">
      <div class="content-full">
        <div class="content-block">
          <div class="block-icon"><i class="fas fa-layer-group"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Category</h5>
<p class="red-text">
<?php
if (isset($_GET['error'])) {
  if ($_GET['error'] == 'blank') {
    print('Oops, all fields are required!');
  }
}
?>
</p>
<?php
// TODO: Check the supplied user exists
$result = execPrepare($mysqli, "SELECT id,title FROM categories WHERE id = ?;", array("s", $_GET['category']));
$row = $result->fetch_assoc();
$id    = clean($row['id']);
$title = clean($row['title']);
?>
<form method="POST" action="/admin/confirmdelete-category.php">
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
