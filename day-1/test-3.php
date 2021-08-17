<?php

function CamelCase($arr){
    $ans=array();
    foreach($arr as $i){
        $curr = explode("_",$i);
        $newString ="";
        $newString.=$curr[0];
        for($j=1;$j<count($curr);$j++){
            $newString.=ucwords($curr[$j]);
        }
        array_push($ans,$newString);
    }
    return $ans;
}

$arr = ["snake_case", "camel_case"];
print_r(CamelCase($arr));
?>
