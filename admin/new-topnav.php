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
      <h3 class="uppercase-text black-text">Administer Nav</h3>
      <p>Creating a new nav entry...</p>
    </div>
    <div class="content-full">
      <p><a href="/admin/index.php">Admin</a> &gt;&gt; <a href="/admin/topnav.php">Edit Nav</a> &gt;&gt; New Item</p>
    </div>
    <div class="content-wrapper">
      <div class="content-full">
        <div class="content-block">
          <div class="block-icon"><i class="fas fa-search"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Top Nav</h5>
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
<?php
$result = $mysqli->query("SELECT MAX(id) AS highestID FROM topnav;");
$row = $result->fetch_assoc();
$id = $row['highestID'] + 1;
?></p>
<form method="POST" action="/admin/insert-topnav.php">
<input class="login-input" name="id" value="<?php print htmlspecialchars($id); ?>" readonly>
<input class="login-input" name="area" type="text" value="" placeholder="area">
<input class="login-input" name="title" type="text" value="" placeholder="title">
<input class="login-input" name="url" type="text" value="" placeholder="url">
<input class="login-button" value="Create" type="submit">
</form>


        </div>
      </div>
      </a>
    </div>
  </div>
</div>
</body>
</html>
