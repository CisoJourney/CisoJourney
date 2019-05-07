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
else if (!isset($_GET['article'])) {
  header('Location: /admin/articles.php');
  exit();
}
?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <h3 class="uppercase-text black-text">Administer Article</h3>
      <p>Modifying an article...</p>
    </div>
    <div class="content-full">
      <p><a href="/admin/index.php">Admin</a> &gt;&gt; <a href="/admin/articles.php">Edit Articles</a> &gt;&gt; Edit Item</p>
    </div>    <div class="content-wrapper">
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
$stmt = $mysqli->prepare("SELECT area,id,title,description,content,premium,category FROM articles WHERE id = ?;");
$stmt->bind_param("s", $_GET['article']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?></p>
<form method="POST" action="/admin/update-article.php">
<select class="login-input" name="area">
  <option <?php if($row['area'] == 1) { print "selected"; } ?> value="1">Strategy</option>
  <option <?php if($row['area'] == 2) { print "selected"; } ?> value="2">Training</option>
  <option <?php if($row['area'] == 3) { print "selected"; } ?> value="3">Labs</option>
</select>
<input class="login-input" name="id" type="hidden" value="<?php print htmlspecialchars($row['id']); ?>">
<input class="login-input" name="title" type="text" value="<?php print htmlspecialchars($row['title']); ?>">
<textarea class="login-input" name="description"><?php print htmlspecialchars($row['description']); ?></textarea>
<textarea class="login-input" name="content"><?php print htmlspecialchars($row['content']); ?></textarea>
<select class="login-input" name="premium">
  <option <?php if($row['area'] == 0) { print "selected"; } ?> value="1">Not Premium</option>
  <option <?php if($row['area'] == 1) { print "selected"; } ?> value="2">Premium</option>
</select>
<input class="login-input" name="category" type="text" value="<?php print htmlspecialchars($row['category']); ?>">
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

