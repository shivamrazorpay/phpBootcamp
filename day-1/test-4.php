<?php
    $json = "{\"players\":[{\"name\":\"Ganguly\",\"age\":45,\"address\":{\"city\":\"Hyderabad\"}},{\"name\":\"Dravid\",\"age\":45,\"address\":{\"city\":\"Hyderabad\"}},{\"name\":\"Dhoni\",\"Age\":37,\"address\":{\"city\":\"Hyderabad\"}},{\"name\":\"Virat\",\"age\":35,\"address\":{\"city\":\"Hyderabad\"}},{\"name\":\"Jadeja\",\"age\":35,\"address\":{\"city\":\"Hyderabad\"}},{\"name\":\"Jadeja\",\"age\":35,\"address\":{\"city\":\"Hyderabad\"}}]}";
    $obj = json_decode($json);
    // print_r($obj->{'players'}[1]->name);
    // print_r($obj);

    // array of names
    $names = array();
    for($i=0 ; $i<count($obj->{'players'});$i++){
        array_push($names,$obj->{'players'}[$i]->name);
    }
    print_r($names);

    // array of ages
    $ages = array();
    for($i=0 ; $i<count($obj->{'players'});$i++){
        array_push($ages,$obj->{'players'}[$i]->age);
    }
    print_r($ages);

    // array of cities
    $cities = array();
    for($i=0 ; $i<count($obj->{'players'});$i++){
        array_push($cities,$obj->{'players'}[$i]->address->city);
    }
    print_r($cities);

    // print only unique names
    $unique_names = array_unique($names);
    print_r($unique_names);

    //array of names with maximum age
    $max_age = 0;
    $max_age_name = array();
    for($i=0 ; $i<count($obj->{'players'});$i++){
        $max_age = max($max_age,$obj->{'players'}[$i]->age);
    }
    for($i=0 ; $i<count($obj->{'players'});$i++){
        if($obj->{'players'}[$i]->age == $max_age)
        array_push($max_age_name,$obj->{'players'}[$i]->name);
    }
    print_r($max_age_name);
?>
