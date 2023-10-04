<?php



function checkID($target, $arr) {
  $i = 0;
  $result = false;
  for($i = 0; $i < count($arr); $i++) {
    if($target == $arr[$i]) {
      $result = true;
    } else {
      continue;
    }
  }
  return $result;
}
