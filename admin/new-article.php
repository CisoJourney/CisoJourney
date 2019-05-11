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
      <p>Creating an article...</p>
    </div>
    <div class="content-full">
      <p><a href="/admin/index.php">Admin</a> &gt;&gt; <a href="/admin/articles.php">Edit Articles</a> &gt;&gt; New Item</p>
    </div>
    <div class="content-wrapper">
      <div class="content-full">
        <div class="content-block">
          <div class="block-icon"><i class="fas fa-book"></i></div>
          <h5 class="uppercase-text center-text spacing-text">Articles</h5>
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
$result = $mysqli->query("SELECT MAX(id) AS highestID FROM articles;");
$row = $result->fetch_assoc();
$id = $row['highestID'] + 1;
?></p>
<form method="POST" action="/admin/insert-article.php">
<?php //TODO: this list should be dynamic ?>
<select class="login-input" name="area">
  <option value="1">Strategy</option>
  <option value="2">Testing</option>
  <option value="3">Labs</option>
</select>
<textarea class="login-input" name="category" placeholder="Category"></textarea>
<input class="login-input" name="id" value="<?php print htmlspecialchars($id); ?>" readonly>
<textarea class="login-input" name="description" placeholder="Description"></textarea>
<textarea class="login-input" name="content" placeholder="Content"></textarea>
<select class="login-input" name="premium">
  <option value="0">Not Premium</option>
  <option value="1">Member</option>
  <option value="2">Labs</option>
</select>
<select class="login-input" name="display">
  <option value="0">Hidden</option>
  <option value="1">Published</option>
</select>
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
