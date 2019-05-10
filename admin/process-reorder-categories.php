<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';

// Check each array item for duplictions, by iterating through the supplied
// variables and counting each occurance. If total occurences is ever > 1
// we have a duplicate so throw.
foreach ($_POST as $post) {
  $count = 0;
  foreach ($_POST as $current) {
    if ($current == $post) {
      $count++;
    }
  }
  if ($count > 1) {
    header('Location: /admin/reorder-categories.php?error=dupe');
    exit();
  }
}

foreach ($_POST as $catNum => $catNewPosition) {
  // Optimise out the database query for categories that aren't moving
  if ($catNum != $catNewPosition) {
    $stmt = $mysqli->prepare("UPDATE categories SET colOrder = ? WHERE id = ?;");
    $stmt->bind_param("ii", intval($catNewPosition), intval($catNum));
    $stmt->execute();
    print 'Moving ' . $catNewPosition  ' to ' . $catNum;
  }
}
header('Location: /admin/reorder-categories.php?reordered=true');
exit();

?>
