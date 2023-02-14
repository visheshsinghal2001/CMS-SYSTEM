<?php
require "../init.php";
  $func = new operation();
  $req=0;
  if(isset($_POST['request'])){
      $req = $_POST['request'];
      $user=$_POST['user'];
      // $user=1;
    }
    $r=$func->select_with_condition("*","user","user_id=$user");
    $response=array();
    while($row=mysqli_fetch_array($r)){
      $response["name"]=$row['user_fname']." ".$row['user_lname'];
      $response["image"]=$row['user_image'];
      $response["position"]=$row['position'];
      $response["email"]=$row['user_email'];
    }
    
    echo json_encode($response);
    // echo(json_encode("cool"));
    exit;?>