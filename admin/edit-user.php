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
else if (!isset($_GET['user'])) {
  header('Location: /admin/users.php');
  exit();
}
?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <h3 class="uppercase-text black-text">Administer User</h3>
      <p>Modifying a user...</p>
    </div>
    <div class="content-full">
      <p><a href="/admin/index.php">Admin</a> &gt;&gt; <a href="/admin/users.php">Edit Users</a> &gt;&gt; Edit Item</p>
    </div>    <div class="content-wrapper">
      <div class="content-full">
        <div class="content-block">
          <div class="block-icon"><i class="fas fa-users"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Users</h5>
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
$stmt = $mysqli->prepare("SELECT email,privs FROM users WHERE email = ?;");
$stmt->bind_param("s", $_GET['user']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>
<form method="POST" action="/admin/update-user.php">
<input class="login-input dim-input" name="email" value="<?php print htmlspecialchars($row['email']); ?>" readonly>
<select class="login-input" name="privs">
  <option <?php if($row['privs'] == 0) { print "selected"; } ?> value="0">Bambi</option>
  <option <?php if($row['privs'] == 1) { print "selected"; } ?> value="1">Member</option>
  <option <?php if($row['privs'] == 2) { print "selected"; } ?> value="2">Member+Labs</option>
  <option <?php if($row['privs'] == 3) { print "selected"; } ?> value="3">Admin</option>
</select>
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
