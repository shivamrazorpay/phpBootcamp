<?php

function masked_number($phone_number){
    $masked_num="";
        for($i=0;$i<strlen($phone_number);$i++){
        if($i>="2" && $i<="7"){
            $masked_num.="*";
        }
        else{
            $masked_num.=$phone_number[$i];
        }
    }
    return $masked_num;
}

$phone_number = "1234567890";
echo masked_number($phone_number);
?>
