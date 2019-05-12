<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if      ($_SESSION['privs'] < 3)    { softRedirect('/profile.php'); }
else if (!isset($_GET['category'])) { softRedirect('/admin/categories.php'); }

include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <h3 class="uppercase-text black-text">Administer Category</h3>
      <p>Modifying a category...</p>
    </div>
    <div class="content-full">
      <p><a href="/admin/index.php">Admin</a> &gt;&gt; <a href="/admin/categories.php">Edit Categories</a> &gt;&gt; Edit Item</p>
    </div>    <div class="content-wrapper">
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

if (isset($_GET['updated']) && $_GET['updated'] == 'true') {
  print('<p class="black-text">Updated!</p>');
}

$result = execPrepare($mysqli, "SELECT area,id,title,description,icon FROM categories WHERE id = ?;", array("s", $_GET['category']));
$row    = $result->fetch_assoc();
$id     = clean($row['id']);
$desc   = clean($row['description']);
$title  = clean($row['title']);
$icon   = clean($row['icon']);

$areaResult = $mysqli->query("id,title FROM areas;");

?></p>
<form method="POST" action="/admin/update-category.php">
<select class="login-input" name="area">
  <?php
while ($areaRow = $areaResult->fetch_assoc()) {
  $areaTitle = clean($areaRow['title']);
  $selected = ""; if ($row['area'] == $areaRow['id']) { $selected = "selected "; }
  print '<option ' . $selected . 'value="' . $areaRow['id'] . '">' . $areaTitle . '</option>';
}
?>
</select>
<input class="login-input" name="id" type="hidden" value="<?php print $id; ?>">
<input class="login-input" name="title" type="text" value="<?php print $title ?>">
<input class="login-input" name="description" type="text" value="<?php print $desc; ?>">
<input class="login-input" name="icon" type="text" value="<?php print $icon; ?>">
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
