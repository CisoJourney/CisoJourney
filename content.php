<?php
$result = $mysqli->query("SELECT title,description,icon FROM areas;");
while($row = $result->fetch_assoc()) {
?>
      <div class="content-trio">
        <div class="content-block center-text">
          <div class="block-icon"><i class="<?php print(htmlspecialchars($row['icon']))?>"></i></div>
            <h5 class="uppercase-text spacing-text">Strategy</h5>
            <p>Foobar</p>
          </div>
        </div>
      </div>
<?php
}
?>
