<?php

function masked_number($phone_number,$symbol,$start,$end){
    $masked_num="";
        for($i=0;$i<strlen($phone_number);$i++){
        if($i>=$start && $i<=$end){
            $masked_num.=$symbol;
        }
        else{
            $masked_num.=$phone_number[$i];
        }
    }
    return $masked_num;
}

$phone_number = "1234567890";
echo masked_number($phone_number,'*',2,7);
?>
