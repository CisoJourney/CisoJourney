<?php
// A function to execute a prepared query against an array of vars
function execPrepare($mysqli, $query, $param) {
  $stmt = $mysqli->prepare($query);
  call_user_func_array(array($stmt, 'bind_param'), $param);
  $stmt->execute();
  $result = $stmt->get_result();
  return $result;
}

function numPrepare($mysqli, $query, $param) {
  $stmt = $mysqli->prepare($query);
  call_user_func_array(array($stmt, 'bind_param'), $param);
  $stmt->execute();
  $stmt->store_result();
  $result = $stmt->get_result();
  return $stmt->num_rows;
}

function clean($input) {
  $input = htmlspecialchars($input);	// Abstracted to make custom filtration possible later
  return $input;
}

function softRedirect($target) {	// "Soft" because 302, non-permanent
  $target = htmlspecialchars($target); 	// 2010:A10 would be bad yo
  header('Location: ' + $target);
  exit;
}
?>
