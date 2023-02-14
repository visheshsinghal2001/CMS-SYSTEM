<?php
  session_start();
    if(!isset($_SESSION['user_id']))  // user check
    {
      header("location:../Logout.php");    
    }

    require '../init.php';
    $func = new operation();
    $user_id=$_REQUEST['userid'];
    $r=$func->select_with_condition("*","user","user_id=$user_id");
    if($r==false){
      echo "error in loading page please try again later";
    }
  else{
    $row=mysqli_fetch_array($r);
    $name= $row["user_fname"]." ".$row["user_lname"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $name ?></title>
  <link rel="stylesheet" href="userinfo-style.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">



</head>
<body>
<?php include_once 'nav.php';?>
  <?php
  
  
  $r=$func->select_with_condition("*","user_skill","user_id=$user_id order by rating desc");
  $r2=$func->select_with_join_condition("project.project_id,LastUpdationTime,project.project_name","user_project","inner join","project","user_project.project_id=project.project_id ","visibility=1 and user_id=$user_id");
  
  ?>
  <div class="con1">
  <div class="profile">
  <img src="<?php  echo $row['user_image']; ?> " width="250" height="250" style="vertical-align:middle;border-radius:50%">
  <span class="lead"><?php echo $name; ?> </span>
  <span><?php echo $row["position"] ?> </span>
  <a href="chat.php?user_id=<?php echo $user_id ?>" class="butt">Message</a>
  <div class="skills">
    <?php
    if($r==false){
      echo "No Listed Skills";
    }
    else{
      while($row3=mysqli_fetch_array($r)){
        ?>
        <span class="skill lead"><?php echo $row3["skill_name"]." ".$row3["rating"];?> &#9734</span>
        <?php
      }
    }
    ?>

  </div>
</div>
    <!-- Project section listing projects...clicking takes to project -->
<div class="project">
  <div class="conn">
  <span class="lead">No of Projects : <?php echo (($r2)?(mysqli_num_rows($r2)):0); ?></span>
  <!-- <div class="proj-con"> -->
    
  
  <!-- <div class="projectDetail"> -->

    <?php
  if($r2==false){
    echo "No Projects!";
  }
  else{
    while($row3=mysqli_fetch_array($r2)){
      $pr=$row3["project_id"];
      ?>
       <div class="proj-con">
       <div class="projectDetail">
      <a href="project.php?proj_id=<?php echo $pr; ?>">
        <span class="lead"><?php echo $row3["project_name"] ; ?></span>
        <span class="time">Last Updated: <?php echo  $row3["LastUpdationTime"];?></span>
      </div></div></a>
  <?php  }
  }
  ?>
  </div>
  

  </div>
  </div>
  
  
 
</div>
  </div>






<?php } ?>
  </body>
  </html>