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
      <h3 class="uppercase-text black-text">Administer Users</h3>
      <p>Check up on the userbase!</p>
    </div>
    <div class="content-full">
      <p><a href="/admin/index.php">Admin</a> &gt;&gt; Edit Users</p>
    </div>
    <div class="content-wrapper">
      <div class="content-full">
        <div class="content-block">
          <div class="block-icon"><i class="fas fa-users"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Users</h5>
<?php
if (isset($_GET['deleted']) and $_GET['deleted'] == 'true') {
  print '<p class="red-text">User deleted!</p>';
}
else if (isset($_GET['delete']) and $_GET['delete'] == 'self') {
  print '<p class="red-text"> Oops, you can't delete yourself!</p>';
}
?>
<table>
<tr><th class="admin-table">Email</th><th class="admin-table">Privs</th><th></th><th></th></tr>
<?php
$result = $mysqli->query("SELECT * FROM users;");
while($row = $result->fetch_assoc()) {
  $email = clean($row['email']);

  print '<tr>';
  print '<td class="admin-table">' . $email . '</td>';
  print '<td class="admin-table">';
  if ($row['privs'] == 3) { print 'Admin'; }
  else if ($row['privs'] == 2) { print 'Member+Labs'; }
  else if ($row['privs'] == 1) { print 'Member'; }
  else if ($row['privs'] == 0) { print 'Bambi'; }
  print '</td>';
  print '<td class="admin-table">';
  print '<a href="/admin/edit-user.php?user=' . $email . '"><input type="submit" value="Edit"></a>';
  print '</td>';
  print '<td class="admin-table">';
  if ($email != $_SESSION['email']) {
    print '<a href="/admin/delete-user.php?user=' . $email . '"><input type="submit" value="Delete"></a>';
  }
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
