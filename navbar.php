<?php
$result = $mysqli->query("SELECT id,title,url FROM topnav;");
?>
<div class="nav-bar">
<ul>
<?php
while($row = $result->fetch_assoc()) {
?>
<li><a href="https://cisojourney.com<?php print(htmlspecialchars($row['url'])); ?>"><?php print(htmlspecialchars($row['title'])); ?></a></li>
<?php
}
?>
</ul>
</div>
