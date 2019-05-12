<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if ($_SESSION['privs'] < 3) {
  softRedirect('/profile.php');
}

include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

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
          <div class="block-icon"><i class="fas fa-book"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Articles</h5>
<p><a href="/admin/new-article.php"><input class="admin-button" type="submit" value="New Article"></a></p>
<table>
<tr><th class="admin-table">Area</th><th class="admin-table">ID</th><th class="admin-table">Title</th><th>Premium</th><th></th><th></th></tr>
<?php
$result = $mysqli->query("SELECT area,ID,title,description,content,premium,category FROM articles;");
while($row = $result->fetch_assoc()) {
  $id      = clean($row['id']);
  $title   = clean($row['title']);
  $premium = clean($row['premium']);
  $display = clean($row['display']);

  print '<tr>';
  print '<td class="admin-table">';
  if ($row['area'] == 1) { print '<i class="fas fa-flag"></i>'; }
  else if ($row['area'] == 2) { print '<i class="fas fa-dumbbell"></i>'; }
  else if ($row['area'] == 3) { print '<i class="fas fa-flask"></i>'; }
  print '</td>';
  print '<td class="admin-table">' . $id . '</td>';
  print '<td class="admin-table">' . $title . '</td>';
  print '<td class="admin-table">';
  if ($premium == 1) { print '<i class="fas fa-crown"></i>'; }
  print '</td>';
  print '<td class="admin-table">' . $display . '</td>';
  print '<td class="admin-table">';
  print '<a href="/admin/edit-article.php?article=' . $id . '"><input class="admin-button" type="submit" value="Edit"></a>';
  print '</td>';
  print '<td class="admin-table">';
  print '<a href="/admin/delete-article.php?article=' . $id . '"><input class="admin-button" type="submit" value="Delete"></a>';
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
