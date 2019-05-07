<div class="title-bar">
  <div class="title">
<?php
if (isset($_GET['area'])) {
  if ($_GET['area'] == 1) { print '<span class="ciso-title">CISO</span>: Journey'; }
  else if ($_GET['area'] == 2) { print '<span class="training-title">InfoSec</span>: Journey'; }
  else if ($_GET['area'] == 3) { print '<span class="labs-title">IJ</span>: Labs'; }
} else {
  print '<span class="ciso-title">CISO</span>: Journey';
}
?>
  </div>
</div>
<div class="
<?php
if (isset($_GET['area'])) {
  if ($_GET['area'] == 1) { print 'ciso-area '; }
  else if ($_GET['area'] == 2) { print 'pentest-area '; }
  else if ($_GET['area'] == 3) { print 'labs-area '; }
}
?>
nav-bar">
  <ul>
<?php
if (isset($_GET['area'])) {
  $stmt = $mysqli->prepare("SELECT id,title,url,area FROM topnav WHERE area = ?");
  $stmt->bind_param("i", intval($_GET['area']));
  $stmt->execute();
  $result = $stmt->get_result();
} else {
  $result = $mysqli->query("SELECT id,title,url FROM topnav WHERE area = 1;");
}
while($row = $result->fetch_assoc()) {
  print '  <li>';
  print '<a href="https://cisojourney.com' . htmlspecialchars($row['url']) . '">';
  print htmlspecialchars($row['title']);
  print '</a>';
  print '</li>';
}
?>
  </ul>
</div>
