<?php
foreach ($_POST as $post) {
  $count = 0;
  foreach ($_POST as $current) {
    if ($current == $post) {
      $count++;
    }
  }
  print $post . ' ' . $count . '<br />';
}


?>
