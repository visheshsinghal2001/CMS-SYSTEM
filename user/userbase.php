<?php
    session_start();
    include_once '../init.php';
$func = new operation();
    $outgoing_id = $_SESSION['user_id'];
    $query=$func->select_with_condition("*","user","user_id=$outgoing_id ORDER BY user_id DESC");
    // $sql = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id} ORDER BY user_id DESC";
    // $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>