<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';
?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <h3 class="uppercase-text black-text">Cybersecurity Strategy</h3>
      <p>A site full of security strategy hints, tips, and discussion.</p>
    </div>
    <div class="content-wrapper">
<?php
$result = $mysqli->query("SELECT id,title,description,icon FROM areas;");
while($row = $result->fetch_assoc()) {
?>
      <div class="content-trio">
        <div class="content-block center-text"><a href="/categories.php?area=<?php print(htmlspecialchars($row['id']))?>">
        <?php
// TODO: HACK this is a hack to show that labs is
if ($row['title'] == 'Labs') { print '<div class="labs-comingsoon">Coming Soon!</div>'; }
?>
          <div class="block-icon"><i class="<?php print(htmlspecialchars($row['icon']))?>"></i></div>
          <h5 class="uppercase-text spacing-text"><?php print(htmlspecialchars($row['title']))?></h5>
          <p><?php print(htmlspecialchars($row['description']))?></p>
        </div></a>
      </div>
<?php
}
?>

    </div>
  </div>
</div>
</body>
</html>
