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
      <h3 class="uppercase-text black-text">Administer Categories</h3>
      <p>Modify the categories titles or descriptions!</p>
    </div>
    <div class="content-full">
      <p><a href="/admin/index.php">Admin</a> &gt;&gt; <a href="/admin/categories.php">Edit Categories</a> &gt;&gt; Reorder Categories</p>
    </div>
    <div class="content-wrapper">
      <div class="content-full">
        <div class="content-block">
          <div class="block-icon"><i class="fas fa-layer-group"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Categories</h5>
<?php
if (isset($_GET['reordered']) && $_GET['reordered'] == 'true') {
  print '<p class="red-text">Categories reordered!</p>';
}
?>
<table>
<tr><th class="admin-table">Area</th><th class="admin-table">ID</th><th class="admin-table">Title</th><th></th></tr>
<form method="POST" action="process-reorder-categories.php">
<?php
// TODO: this being a fetch_assoc() is silly, but I'm tired today
$result = $mysqli->query("SELECT MAX(id) as maxID FROM categories;");
$maxRow = $result->fetch_assoc();

$result = $mysqli->query("SELECT * FROM categories ORDER BY colOrder;");
while($row = $result->fetch_assoc()) {
  $id       = clean($row['id']);
  $title    = clean($row['title']);
  $colOrder = clean($row['colOrder']);

  print '<tr>';
  print '<td class="admin-table">';
  if ($row['area'] == 1) { print '<i class="fas fa-flag"></i>'; }
  else if ($row['area'] == 2) { print '<i class="fas fa-dumbbell"></i>'; }
  else if ($row['area'] == 3) { print '<i class="fas fa-flask"></i>'; }
  print '</td>';
  print '<td class="admin-table">' . $id . '</td>';
  print '<td class="admin-table">' . $title . '</td>';
  print '<td class="admin-table">';
  print '<select name="' . $id . '">';
  foreach (range(1, $maxRow['maxID']) as $orderValue) {
    print '<option ';
    if ($orderValue == $colOrder) { print 'selected'; }
    print ' value="' . $orderValue . '">'  . $orderValue . '</option>';
  }
  print '</select>';
  print '</td>';
  print '</tr>';
}
?>
</table>
<p><input type="submit" value="Reorder Categories"></a></p>
</form>
        </div>
      </div>
      </a>
    </div>
  </div>
</div>
</body>
</html>
