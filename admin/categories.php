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
      <h3 class="uppercase-text black-text">Administer Categories</h3>
      <p>Modify the categories titles or descriptions!</p>
    </div>
    <div class="content-wrapper">
      <div class="content-full">
        <div class="content-block">
          <div class="block-icon"><i class="fas fa-layer-group"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Categories</h5>
<table>
<tr><th class="admin-table">ID</th><th class="admin-table">Title</th></tr>
<?php
$result = $mysqli->query("SELECT * FROM categories;");
while($row = $result->fetch_assoc()) {
  print '<tr>';
  print '<td class="admin-table">';
  print '<a href="/admin/edit-category.php?category=' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['id']) . '</a>';
  print '</td>';
  print '<td class="admin-table">';
  print htmlspecialchars($row['title']);
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
