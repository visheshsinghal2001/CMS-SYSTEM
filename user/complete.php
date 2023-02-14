<?php
require "../init.php";
$func=new operation();
if(isset($_POST['complete'])){
    $proj_id=$_POST["proj_id"];
    $func->update("project","project_status=0","project_id=$proj_id");
    $func->update("task","task_display=0","task_project=$proj_id");
  }
  if(isset($_POST['delete'])){
    $proj_id=$_POST["proj_id"];
    $func->delete("project","project_id=$proj_id");
    $func->delete("task","task_project=$proj_id");
    $func->delete("user_project","project_id=$proj_id");
  }
  header("location: userhome.php");
?>