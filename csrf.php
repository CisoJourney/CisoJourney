<?php
$refData = parse_url($_SERVER['HTTP_REFERER'];);
if($refData['host'] !== 'cisojourney.com') {
  die("Anti-CSRF Violation.");
}
?>
