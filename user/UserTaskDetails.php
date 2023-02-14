<?php
  session_start();
    if(!isset($_SESSION['user_id']))  
    // user check
    {
      header("location:../Logout.php");    
    
}
$uid=$_SESSION['user_id'];
    require '../init.php';
    $func = new operation();
    date_default_timezone_set("Asia/Kolkata");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task Details</title>
  <link rel="stylesheet" href="style-task-details.css?v=<?php echo time(); ?>">
  <script src="javascript/FillDate.js"></script>
</head>
<body>
  

<div class="navbar">
                <div class="container1">
                    

                    <ul>
                      <li>
                      <h1>
                      <img src="../logo/logo.png" alt="logo" width=60px height=60px style="vertical-align:middle;" >
                        </h1>
                      </li>
                        <li class="home">
                            <a href="userhome.php?userid=<?php echo $_SESSION['user_id'];?> ">Home</a>
                        </li>
                        <?php
                if($_SESSION['zval']<11){
                    ?>
                    <li class="profile"><a href="newuser.php">Add User</a></li>
                <?php
                }
                ?>
                        <li class="profile"><a href="userinfo.php?userid=<?php echo $_SESSION['user_id']?> ">Profile</a></li>
                        
                        <li class="contact"><a href="confirm.php?> ">Update Profile</a></li>
                    </ul>
                    <a href="../logout.php">
                        Logout</a
                    >
                </div>
            </div>

  <div class="con">
  <div class="detailcontainer">



  <?php
   $task_id=$_REQUEST['task_id']; 
   $proj_id=$_REQUEST['proj_id'];
  
   $r=$func->select_with_condition("*","task","task_id=$task_id;");
   $row=mysqli_fetch_array($r);
  
    
   
  $sender=$row["task_sender"];



  $receiver=$row["task_receiver"];
  $rx=$func->select_with_condition("user_image,user_fname,user_lname","user","user_id=$receiver;");
  $rx=mysqli_fetch_array($rx);
?>

   <h2><?php echo($row['task_name']); ?></h2>
  <!-- Sender name and will redirect to user page -->
  <a href="userinfo.php?userid=<?php echo($sender); ?>">
  <div class="sender">
    
    <img class="icon" src=<?php echo $row["task_sender_image"]?> alt="Sender Image" width="50" height="50" style="vertical-align:middle;border-radius:50%">
    <span class="name"><?php echo $row["task_sender_name"]?></span>
  </div>
  </a>
  <!-- reciever ka info -->
  <a href="userinfo.php?userid=<?php echo($receiver); ?>">
  <div class="sender">
    
    <img class="icon" src=<?php echo $rx['user_image'] ?> width="50" height="50" style="vertical-align:middle;border-radius:50%" alt="reciever Image">
    <span class="name"><?php echo $rx["user_fname"]." ".$rx["user_lname"];?></span>
  </div>
  </a>

  <!-- Task description -->
  <div class="decription">
  <!-- <?php echo($row['task_details']); ?> -->
  </div>
  <div class="project"></div>


 <?php
  $r2=$func->select_with_condition("*","project","project_id=$proj_id;");   
  $row2=mysqli_fetch_array($r2);
 ?>
      <h6>Task Details: </h6>
      <?php echo $row["task_details"]; ?>

      <table>
    <tbody>
    <tr>
      <!-- Project name and redirect to project page on clicking name -->
      <a href="project.php?proj_id=<?php echo $proj_id ?>">
        <th>Project Name: </th>
          <td><?php echo($row2['project_name']); ?></td>
      </a>
      </tr>
    <tr>
  
 
  <th>Deadline: </th>
  <td> <?php 
    $dead=$row["dead_line"];
    // $dead.=":00";
    echo ($dead);
    ?>      </td>

</tr>
<tr>

<th>Remaining Time: </th>
<td><span id="countdown"></span></td>
<?php 
       if($row["task_display"]!=0){
      $dead=strtotime($row["dead_line"])-time();
      $dead*=1000;
      echo "<script>FillDate($dead)</script>";
      if($_SESSION['user_id']==$receiver){
      ?>
      </tr></tbody>
    
    </table>
    <center>
      <form method=post>
        <input type="submit" name="complete" value="Mark as Complete">
      </form>
      </center>
      <?php
      }
       }
      else {
        // create javascript function to fill task completed in deadline 
        //or go and have new feature pending or completed upto you.
       echo "<script>completed_task()</script>";
      }
      ?>
<!-- task complete button -->


<?php
if(isset($_POST["complete"])){
$r=  $func->update("task","task_display=0","task_id=$task_id");
if($r==false) echo "error"; 
else{

  echo "<script>completed_task()</script>";
}
}

?>
</body>
</html>