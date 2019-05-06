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
else if (!isset($_GET['content'])) {
  header('Location: /admin/contents.php');
  exit();
}
?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <h3 class="uppercase-text black-text">Administer Content</h3>
      <p>Modifying index content...</p>
    </div>
    <div class="content-full">
      <p><a href="/admin/index.php">Admin</a> &gt;&gt; <a href="/admin/content.php">Edit Content</a> &gt;&gt; Edit Item</p>
    </div>    <div class="content-wrapper">
      <div class="content-full">
        <div class="content-block">
          <div class="block-icon"><i class="fas fa-align-justify"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Content</h5>
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
$stmt = $mysqli->prepare("SELECT id,title,description,icon FROM areas WHERE id = ?;");
$stmt->bind_param("s", $_GET['content']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>
<form method="POST" action="/admin/update-content.php">
<input class="login-input dim-input" name="id" value="<?php print htmlspecialchars($row['id']); ?>" readonly>
<input class="login-input" name="title" value="<?php print htmlspecialchars($row['title']); ?>">
<input class="login-input" name="description" value="<?php print htmlspecialchars($row['description']); ?>">
<input class="login-input" name="icon" value="<?php print htmlspecialchars($row['icon']); ?>">
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