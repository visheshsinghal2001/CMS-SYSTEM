<?php
  session_start();
    if(!isset($_SESSION['user_id']))  // user check
    {
      header("location:../Logout.php");    
    }

    require '../init.php';
    $uid=$_SESSION['user_id'];
    $proj_id=$_REQUEST['proj_id'];
    $func = new operation();
    $r=$func->select_with_condition("*","user_project","user_id=$uid and project_id=$proj_id");
    if($r==false){
      header("location:unauth.php"); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Description</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="project-style.css?v=<?php echo time(); ?>">
    

</head>
<body>
<?php include_once 'nav.php';?>
  <div class="con">
    <div class="tasklist">
      <br>
    <?php
    
    $r=$func->select_with_condition("*","project","project_id=$proj_id");
    $row=mysqli_fetch_array($r);
    $fin=$row['FinishID'];
    ?>

    <h2 ><?php echo $row['project_name'] ?></h2>
    
    <?php  $rz=$func->select_with_condition("*","user","user_id=$fin");
    $rowz=mysqli_fetch_array($rz);
    ?>

    <span class="created lead1"><?php echo($rowz['user_fname']." ".$rowz['user_lname']); ?></span>
    <span class="created lead2"><?php echo $rowz['position']; ?></span><br>
    <span class="created lead2"><?php echo $row['CreationTime'];?></span>
    
    
    <?php
    if($uid==$row["FinishID"]){
    ?>
     <div class="confirm">
 <form id=end method=post action="complete.php">
  <input type=text name="proj_id" value=<?php echo $proj_id?> hidden>
<input type=submit class="butt" value=Complete name=complete>
<input type=submit class="butt" value=Delete name=delete>
   </form>
</div>
<br>

     <?php
    }
    ?>
    <p><?php echo $row['project_description'];?><p>
      <?php
     $zvalis=$row["authZval"];
     $r=$func->select_with_join_condition("*","task","inner join","user","task_receiver=user_id","task_project=$proj_id and task_display=1 order by dead_line");
     $r2=$func->select_with_join_condition("*","task","inner join","user","task_receiver=user_id","task_project=$proj_id and task_display=0 order by task_complete desc");
     $tot=mysqli_num_rows($r);
     $comp=mysqli_num_rows($r2);
     ?>

<br><br>
     <hr>
<div class="remaining">
  <br>
  <span class="lead1">Active Task</span>
  <br>
  <table>
 <?php
     while($row2=mysqli_fetch_array($r)){
?>
       <tr>
         <td><image src=" <?php echo $row2["user_image"]; ?>"alt ="sender pic" width="50" height="50" style="vertical-align:middle;border-radius:50%"></td>
         
         <td><?php echo $row2["user_fname"]." ".$row2["user_lname"];?></td>
         <td><?php echo $row2["task_name"] ?></td>
         <td><?php echo $row2["dead_line"]?></td>
         <td><a href="UserTaskDetails.php?task_id=<?php echo $row2["task_id"]?>&proj_id=<?php echo $proj_id?>" class="button" id="alink">More details</a></td>
     </tr>

     <?php
     } 
     ?>
    </table>
</div>
<div class="completed">
  <br>
  <span class="lead1">Completed Task</span>
  <br>
  <table> 
 <?php
     while($row2=mysqli_fetch_array($r2)){
?>
       <tr>
       
         <td><image src="<?php echo $row2["user_image"]; ?>"alt ="sender pic" width="50" height="50" style="vertical-align:middle;border-radius:50%"></td>
         <td><?php echo $row2["user_fname"]." ".$row2["user_lname"];?></td>
         <td><?php echo $row2["task_name"] ?></td>
         <td><?php echo $row2["task_complete"]?></td>
         <td><a href="UserTaskDetails.php?task_id=<?php echo $row2["task_id"]?>&proj_id=<?php echo $proj_id?>" id="alink">More details</a></td>
     </tr>

     <?php
     } 
     ?>
     </table>
</div>


   
    </div>
    <div class="sidecon">
      <?php if($tot+$comp>0){
?>
      <br>
    <label for="file" class="lead1">Project Progress:</label>
  <progress id="file" value=<?php echo $comp;?> max=<?php echo ($tot+$comp);?>> <?php $comp*100/($tot+$comp);?></progress>
  <?php }?>
  <?php
     if($_SESSION["zval"]<=$row["authZval"] & $row["project_status"]!=0){
       
       ?>
       
       <a class="butt" style="width: 100%;" href="taskassign.php?proj_id=<?php echo $proj_id?>" >Assign Task</a>
<?php
     }
      ?>
    
    </div>
  </div>
     
      

    
    
</body>
</html>