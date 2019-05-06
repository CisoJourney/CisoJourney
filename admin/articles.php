<?php
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

if (!isset($_SESSION['privs'])) {
  header('Location: /login.php');
  exit();
}
else if ($_SESSION['privs'] < 3) {
  header('Location: /profile.php');
  exit();
}
?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <h3 class="uppercase-text black-text">Administer Articles</h3>
      <p>Modify the articles titles, descriptions, or content!</p>
    </div>
    <div class="content-full">
      <p><a href="/admin/index.php">Admin</a> &gt;&gt; Edit Articles</p>
    </div>
    <div class="content-wrapper">
      <div class="content-full">
        <div class="content-block">
          <div class="block-icon"><i class="fas fa-layer-group"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Categories</h5>
<table>
<tr><th class="admin-table">Area</th><th class="admin-table">ID</th><th class="admin-table">Title</th><th></th></tr>
<?php
$result = $mysqli->query("SELECT * FROM articles;");
while($row = $result->fetch_assoc()) {
  print '<tr>';
  print '<td class="admin-table">';
  if ($row['area'] == 1) { print '<i class="fas fa-flag"></i>'; }
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
  print '<a href="/admin/edit-article.php?article=' . htmlspecialchars($row['id']) . '"><input type="submit" value="edit"></a>';
  print '</td>';
  print '<td class="admin-table">';
  print '<a href="/admin/delete-article.php?article=' . htmlspecialchars($row['id']) . '"><input type="submit" value="delete"></a>';
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
