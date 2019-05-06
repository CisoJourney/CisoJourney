<?php
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';

$result = $mysqli->query("SELECT id,title,description,icon FROM categories;");
?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <h3 class="uppercase-text black-text">Cybersecurity Strategy</h3>
      <p>A chat full of security strategy hints, tips, and discussion.</p>
    </div>

<?php
while($row = $result->fetch_assoc()) {
?>
    <div class="content-wrapper">
      <div class="content-duo">
        <div class="content-block center-text"><a href="/category.php?id=<?php print($row['id']); ?>">
          <div class="block-icon ciso-color"><i class="<?php print($row['icon']); ?>"></i></div>
          <h5 class="uppercase-text spacing-text">Prepare</h5>
          <p>Articles covering the critical foundation topics of cybersecurity; such as how to plan, manage, and implement your security plans.</p>
        </div></a>
      </div>
    </div>

<?php
}
?>
  </div>
</div>
</body>
</html>
