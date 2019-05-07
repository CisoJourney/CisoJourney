<?php
$result = $mysqli->query("SELECT id,title,description,icon FROM areas;");
while($row = $result->fetch_assoc()) {
?>
      <div class="content-trio">
        <div class="content-block center-text"><a href="/categories.php?area=<?php print(htmlspecialchars($row['id']))?>">
          <div class="block-icon"><i class="<?php print(htmlspecialchars($row['icon']))?>"></i></div>
          <h5 class="uppercase-text spacing-text"><?php print(htmlspecialchars($row['title']))?></h5>
          <p><?php print(htmlspecialchars($row['description']))?></p>
        <?php
// TODO: HACK this is a hack to show that labs is 
if ($row['title'] == 'Labs') { print 'Coming Soon!';} 
?>
        </div></a>
      </div>
<?php
}
?>
