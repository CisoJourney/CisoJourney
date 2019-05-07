<div class="<?php if (isset($_GET['area'] and $_GET['area'] == 1)) { print ciso-area'; } ?>nav-bar">
  <ul>
<?php
$result = $mysqli->query("SELECT id,title,url FROM topnav;");
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
