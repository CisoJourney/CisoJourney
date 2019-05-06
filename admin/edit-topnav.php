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
else if (!isset($_GET['nav'])) {
  header('Location: /admin/topnav.php');
  exit();
}

?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <h3 class="uppercase-text black-text">Administer Menu</h3>
      <p>Modifying a menu item...</p>
    </div>
    <div class="content-full">
      <p><a href="/admin/index.php">Admin</a> &gt;&gt; <a href="/admin/edit-topnav.php">Top Nav</a> &gt;&gt; Edit Item</p>
    </div>
    <div class="content-wrapper">
      <div class="content-full">
        <div class="content-block">
          <div class="block-icon"><i class="fas fa-search"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Edit Menu</h5>
<p class="red-text">
<?php
if (isset($_GET['error'])) {
  if ($_GET['error'] == 'missing') {
    print('Oops, all fields are required!');
  }
  else if ($_GET['error'] == 'blank') {
    print('Oops, all fields are required!');
  }
}
?>
</p>
<p class="black-text">
<?php
if (isset($_GET['updated'])) {
  if ($_GET['updated'] == 'true') {
    print('Updated!');
  }
}
?>
</p>
<?php
$stmt = $mysqli->prepare("SELECT id,title,url FROM topnav WHERE id = ?;");
$stmt->bind_param("s", $_GET['nav']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>
<form method="POST" action="/admin/update-topnav.php">
<input class="login-input" name="id" type="hidden" value="<?php print htmlspecialchars($row['id']); ?>">
<input class="login-input" name="title" type="text" value="<?php print htmlspecialchars($row['title']); ?>">
<input class="login-input" name="url" type="text" value="<?php print htmlspecialchars($row['url']); ?>">
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
