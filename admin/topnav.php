<?php
session_start();

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
      <h3 class="uppercase-text black-text">Edit Top Nav</h3>
      <p>Modifing the top nav menu</p>
    </div>
    <div class="content-full">
      <p><a href="/admin/index.php">Admin</a> &gt;&gt; Top Nav</p>
    </div>
    <div class="content-wrapper">
      <div class="content-full">
        <div class="content-block">
          <div class="block-icon"><i class="fas fa-search"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Top Nav</h5>
<p><a href="/admin/new-topnav.php"><input type="submit" value="New Nav"></a></p>
<table>
<tr><th class="admin-table">ID</th><th>Area</th><th class="admin-table">Title</th><th class="admin-table">URL</th><th></th></tr>
<?php
$result = $mysqli->query("SELECT id,area,title,url FROM topnav;");
while($row = $result->fetch_assoc()) {
$id = clean($row['id']);
$id = clean($row['area']);
$id = clean($row['title']);
$id = clean($row['url']);

  print '<tr>';
  print '<td class="admin-table">' . $id . '</td>';
  print '<td class="admin-table">' . $area . '</td>';
  print '<td class="admin-table">' . $title . '</td>';
  print '<td class="admin-table">' . $url . '</td>';
  print '<td class="admin-table">';
  print '<a href="/admin/edit-topnav.php?nav=' . $id . '"><input type="submit" value="edit"></a>';
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
