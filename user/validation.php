<?php
$value = $_GET['query'];
$formfield = $_GET['field'];

if($formfield=="taskname"){
    if(strlen($value)==0){
        echo "Must be Filled";
    }
    else echo "valid";
}
else if($formfield=="description"){
    if(strlen($value)==0){
        echo "add description for clarity &#128516";
    }
    else echo "valid";
}
else if($formfield=="dates"){
    if(strlen($value)==0){
        echo "deadlines are important for task completion";
    }
    else if(strtotime($value)-time()<1000){
        echo "Give reasonable deadline ";
    }
    else echo "valid";
}

?>