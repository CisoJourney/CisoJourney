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
      <h3 class="uppercase-text black-text">Administer Content</h3>
      <p>Updating the front page!</p>
    </div>
    <div class="content-full">
      <p><a href="/admin/index.php">Admin</a> &gt;&gt; Edit Content</p>
    </div>
    <div class="content-wrapper">
      <div class="content-full">
        <div class="content-block">
          <div class="block-icon"><i class="fas fa-align-justify"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Content</h5>
<table>
<tr><th class="admin-table">ID</th><th class="admin-table">Title</th><th>icon</th><th></th></tr>
<?php
$result = $mysqli->query("SELECT id,title,icon FROM areas;");
while($row = $result->fetch_assoc()) {
  $id    = clean($row['id']);
  $title = clean($row['title']);
  $icon  = clean($row['icon']);

  print '<tr>';
  print '<td class="admin-table">' . $id . '</td>';
  print '<td class="admin-table">' . $title . '</td>';
  print '<td class="admin-table">' . $icon . '</td>';
  print '<td class="admin-table">';
  print '<a href="/admin/edit-content.php?content=' . $id . '"><input type="submit" value="edit"></a>';
  print '</td>';
  print '</tr>';
}
?>
        </div>
      </div>
      </a>
    </div>
  </div>
</div>
</body>
</html>
