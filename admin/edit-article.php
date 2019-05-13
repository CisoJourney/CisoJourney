<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if      ($_SESSION['privs'] < 3)   { softRedirect('/profile.php'); }
else if (!isset($_GET['article'])) { softRedirect('/admin/articles.php'); }

include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';

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
<?php
if (isset($_GET['error'])) {
  if ($_GET['error'] == 'missing' or $_GET['error'] == 'blank') {
    print('<p class="red-text">Oops, all fields are required!</p>');
  }
}

if (isset($_GET['updated'])) {
  if ($_GET['updated'] == 'true') {
    print('<p class="black-text">Updated!</p>');
  }
}

$result = execPrepare($mysqli, "SELECT id,area,slug,title,description,content,premium,category,display FROM articles WHERE id = ?;", array("i", $_GET['article']));
$row = $result->fetch_assoc();

$id       = clean($row['id']);
$title    = clean($row['title']);
$slug     = clean($row['slug']);
$desc     = clean($row['description']);
$content  = clean($row['content']);
$premium  = clean($row['premium']);
$display  = clean($row['display']);
$category = clean($row['category']);

?>
<form method="POST" action="/admin/update-article.php">
<select class="login-input" name="area">
  <option <?php if($row['area'] == 1) { print "selected"; } ?> value="1">Strategy</option>
  <option <?php if($row['area'] == 2) { print "selected"; } ?> value="2">Testing</option>
  <option <?php if($row['area'] == 3) { print "selected"; } ?> value="3">Labs</option>
</select>
<input class="login-input" name="id" type="hidden" value="<?php print $id; ?>">
<input class="login-input" name="title" type="text" value="<?php print $title; ?>">
<input class="login-input" name="slug" type="text" value="<?php print $slug; ?>">
<textarea class="login-input" name="description"><?php print $desc; ?></textarea>
<textarea class="login-input" name="content"><?php print $content; ?></textarea>
<select class="login-input" name="premium">
  <option <?php if($premium == 0) { print "selected"; } ?> value="0">Not Premium</option>
  <option <?php if($premium == 1) { print "selected"; } ?> value="1">Member</option>
  <option <?php if($premium == 2) { print "selected"; } ?> value="2">Labs</option>
</select>
<select class="login-input" name="display">
  <option <?php if($display == 0) { print "selected"; } ?> value="0">Hidden</option>
  <option <?php if($display == 1) { print "selected"; } ?> value="1">Published</option>
</select>
<input class="login-input" name="category" type="text" value="<?php print $category; ?>">
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

