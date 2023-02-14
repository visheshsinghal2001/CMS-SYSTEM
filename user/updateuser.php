<?php
session_start();
if(!isset($_SESSION['user_id']))  // user check
    {
      header("location:../Logout.php");    
    }
    require '../init.php';
    $func = new operation();
    $uid=$_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Skils</title>
    <link rel="stylesheet" href="animation.css">
    <link rel="stylesheet" href="updateuser-style.css">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

</head>
<body>
<?php include_once 'nav.php';?>
<div id="wrapper">
    	<div id="box">
        	<div id="top_header">
          <?php 
if(isset($_POST["skill"])){
    $skill=$_POST["skills"];
    $points=$_POST["points"];
    // $uid=1;
    $con=$func->connect();
    $sql="insert into user_skill values($uid,'$skill',$points)";
    $r=mysqli_query($con,$sql);
    if($r!=false)  {echo "<h2 class='succ'>Successfully Added</h2>";
    include_once "animation-tick.php";} 
    else{
      echo "<h2 class='error'>Creation Failed2</h2>";
          include_once "animation-cross.php";
    }
}


    // else{
    //   echo"The two passwords are not the same";
    // }

?>
            <?php
            if(isset($_POST['changePass'])){
              // $uid=1;
              $pass=$_POST['newpsd'];
              $pass2 = $_POST['confpsd'];
              if(strcmp($pass,$pass2)==0){
                $password = password_hash($pass,PASSWORD_ARGON2ID);
                $func->update("user","user_password='$password'","user_id=$uid");

                echo "<h2 class='succ'>Successfully Created</h2>";
                include_once "animation-tick.php";} else{
                  echo "<h2 class='error'>Creation Failed2</h2>";
                      include_once "animation-cross.php";
                }
              }
             
              ?>
          		<h3>Update User</h3>
        	</div>
        
        <div id="inputs">
        	<form  method='post' accept-charset='UTF-8'>
				
				<div class='container'>
        <label>New Password</label>
        <input type="password" name="newpsd" placeholder="new password"><br/>
				</div>
				
                <div class='container'>
        <label>Confirm Password</label>
        <input type="password" name="confpsd" placeholder="confirm password"><br/>
				</div>
                
				<div class='container'>
          <input type="submit" name="changePass" value="Change Password">
				</div>
            </form>
            <form method=post>
				<div class='container'>
        <label>Skill Name</label>
        <input type="text" name="skills" placeholder="skill name" required/>
				</div>
                
        <div class='container'>
        <label>Points</label>
        <input type="number" name="points" placeholder="Points out of 10" required/>   
				</div>

        <div class='container'>
       <label >Add Skill</label> 
       <input type="submit" name="skill" value="Add Skills"> 
              <br> 
        </div>
</form>

    </div>
  </div>
</div>




</body>
</html>