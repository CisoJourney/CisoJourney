<?php
include_once $_SERVER['DOCUMENT_ROOT'] .  '/csrf.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/session.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/auth.php';
include_once $_SERVER['DOCUMENT_ROOT'] .  '/functions.php';

if ($_SESSION['privs'] < 3) { softRedirect('/profile.php'); }

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
    softRedirect('/admin/reorder-categories.php?error=dupe');
  }
}

foreach ($_POST as $catNum => $catNewPosition) {
  execPrepare($mysqli, "UPDATE categories SET colOrder = ? WHERE id = ?;", array("ii", intval($catNewPosition), intval($catNum));
}
softRedirect('/admin/reorder-categories.php?reordered=true');

?>
