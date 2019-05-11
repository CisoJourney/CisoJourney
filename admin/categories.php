<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

// If you're not an admin, go away!
if ($_SESSION['privs'] < 3) { softRedirect('/profile.php'); }

?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <h3 class="uppercase-text black-text">Administer Categories</h3>
      <p>Modify the categories titles or descriptions!</p>
    </div>
    <div class="content-full">
      <p><a href="/admin/index.php">Admin</a> &gt;&gt; Edit Categories</p>
    </div>
    <div class="content-wrapper">
      <div class="content-full">
        <div class="content-block">
          <div class="block-icon"><i class="fas fa-layer-group"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Categories</h5>
<table>
<tr><th class="admin-table">Area</th><th class="admin-table">ID</th><th class="admin-table">Title</th><th></th><th></th><th></th></tr>
<?php
$result = $mysqli->query("SELECT * FROM categories ORDER BY colOrder;");
while($row = $result->fetch_assoc()) {
  print '<tr>';
  print '<td class="admin-table">';
  // TODO: dynamically load area icons
  if      ($row['area'] == 1) { print '<i class="fas fa-flag"></i>'; }
  else if ($row['area'] == 2) { print '<i class="fas fa-dumbbell"></i>'; }
  else if ($row['area'] == 3) { print '<i class="fas fa-flask"></i>'; }
  print '</td>';
  print '<td class="admin-table">';
  print htmlspecialchars($row['id']);
  print '</td>';
  print '<td class="admin-table">';
  print htmlspecialchars($row['title']);
  print '</td>';
  print '<td class="admin-table">';
  print '<a href="/admin/edit-category.php?category=' . htmlspecialchars($row['id']) . '"><input class="admin-button" type="submit" value="Edit"></a>';
  print '</td>';
  print '<td class="admin-table">';
  print '<a href="/admin/hide-category.php?category=' . htmlspecialchars($row['id']) . '"><input class="admin-button" type="submit" value="Hide"></a>';
  print '</td>';
  print '<td class="admin-table">';
  print '<a href="/admin/delete-category.php?category=' . htmlspecialchars($row['id']) . '"><input class="admin-button" type="submit" value="Delete"></a>';
  print '</td>';
  print '</tr>';
}
?>
</table>
<p><a href="/admin/new-category.php"><input class="admin-button" type="submit" value="New Category"></a>
<a href="/admin/reorder-categories.php"><input class="admin-button" type="submit" value="Reorder Categories"></a></p>
        </div>
      </div>
      </a>
    </div>
  </div>
</div>
</body>
</html>
