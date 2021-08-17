<?php

function array_flatten($array) { 
    if (!is_array($array)) { 
      return false; 
    } 
    $result = array(); 
    foreach ($array as $key => $value) { 
      if (is_array($value)) { 
        $result = array_merge($result, array_flatten($value)); 
      } else { 
        $result = array_merge($result, array($key => $value));
      } 
    } 
    return $result; 
  }

$arr = [2, 3, [4,5], [6,7], 8];
print_r(array_flatten($arr));
?>
