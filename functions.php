<?php
function execPrepare($query, $param)
  $stmt = $mysqli->prepare($query);
  call_user_func_array(array($stmt, 'bind_param'), $param);
  $stmt->execute();
  $result = $stmt->get_result();
  return $result;

$id = '1';
$format = "i";
$result = execPrepare("SELECT title FROM articles WHERE id = ?", array(&$format, &$id));
$row = $result->fetch_assoc()
print 'Output: ' . $row['title'];
>
