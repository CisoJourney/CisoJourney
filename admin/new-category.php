<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if ($_SESSION['privs'] < 3) { softRedirect('/profile.php'); }

include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <h3 class="uppercase-text black-text">Administer Category</h3>
      <p>Creating a category...</p>
    </div>
    <div class="content-full">
      <p><a href="/admin/index.php">Admin</a> &gt;&gt; <a href="/admin/categories.php">Edit Categories</a> &gt;&gt; New Item</p>
    </div>
    <div class="content-wrapper">
      <div class="content-full">
        <div class="content-block">
          <div class="block-icon"><i class="fas fa-layer-group"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Categories</h5>
<?php
if (isset($_GET['error'])) {
  if ($_GET['error'] == 'missing' or $_GET['error'] == 'blank') {
    print('<p class="red-text">Oops, all fields are required!</p>');
  }
}

$result = $mysqli->query("SELECT MAX(id) AS highestID FROM categories;");
$row = $result->fetch_assoc();
$id = intval(clean($row['highestID'])) + 1;

//TODO: this list should be dynamic
?></p>
<form method="POST" action="/admin/insert-category.php">
<select class="login-input" name="area">
  <option value="1">Strategy</option>
  <option value="2">Technical</option>
  <option value="3">Labs</option>
</select>
<input class="login-input dim-input" name="id" value="<?php print $id; ?>" readonly>
<input class="login-input" name="title" type="text" placeholder="Title" value="">
<textarea class="login-input" name="description" placeholder="Description"></textarea>
<input class="login-input" name="icon" type="text" placeholder="icon" value="">
<select class="login-input" name="hidden">
  <option value="0">Visible</option>
  <option value="1">Hidden</option>
</select>
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
