<?php
$result = $mysqli->query("SELECT title,description,icon FROM areas;");
while($row = $result->fetch_assoc()) {
?>
      <div class="content-trio">
        <div class="content-block center-text"><a href="/categories.php?id=<?php print(htmlspecialchars($row['id']))?>">
          <div class="block-icon"><i class="<?php print(htmlspecialchars($row['icon']))?>"></i></div>
          <h5 class="uppercase-text spacing-text"><?php print(htmlspecialchars($row['title']))?></h5>
          <p><?php print(htmlspecialchars($row['description']))?></p>
        </div></a>
      </div>
<?php
}
?>
