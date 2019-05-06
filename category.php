<?php
session_start();

include_once $_SERVER['DOCUMENT_ROOT'] .  '/headers.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/head.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/topbar.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/navbar.php';


$stmt = $mysqli->prepare("SELECT area,title,description FROM articles WHERE area = 1 and category = ?;");
$stmt->bind_param("i", intval($_GET['id']));
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

?>
<div class="page-wrapper">
  <div class="content">
    <div class="content-full center-text">
      <h3 class="uppercase-text black-text">Cybersecurity Strategy</h3>
      <p>A site full of security strategy hints, tips, and discussion.</p>
    </div>
    <div class="content-full">
<?php
while($row = $result->fetch_assoc()) {
  print '<div class="content-block nopad-text">';
  print '<p>' . htmlspecialchars($row['title']) . '</p>';
  print '<p>' . htmlspecialchars($row['description']) . '</p>';
  print '</div>';
}
?>
    </div>
  </div>
</div>
</body>
</html>
