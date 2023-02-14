<?php
 session_start();
    if(!isset($_SESSION['user_id']))  // user check
    {
      header("location:../Logout.php");    
    }

    require '../init.php';
    $func = new operation();
    date_default_timezone_set("Asia/Kolkata");
    $zv=2;
    $r23=$func->select_with_condition("*","club_heir","zval>=$zv");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project</title>
    <link rel="stylesheet" href="createproject-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="animation.css">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
<?php include_once 'nav.php';?>
<div id="wrapper">
    	<div id="box">
        <?php 
if(isset($_POST['sub'])){

    $proj_name=$_POST['proj_name'];
    $proj_desc=$_POST['proj_desc'];
    $proj_visible=(isset($_POST['visibility']))?1:0;
    $proj_auth=$_POST['authval'];
    $proj_finish=$_SESSION['user_id'];
    // require "db.php";

    $con=$func->connect();
// echo"why";
    $columns=array("project_name,project_description,authZval,FinishID,visibility");
    $val=array("'$proj_name'","'$proj_desc'","$proj_auth","$proj_finish","$proj_visible");
    $con = $func->connect();
    if(is_array($columns))$columns=implode(',',$columns);
    if(is_array($val))$val=implode(',',$val);
    $str="INSERT INTO project(project_name,project_description,authZval,FinishID,visibility) VALUES ('{$proj_name}','{$proj_desc}','{$proj_auth}',{$proj_finish},{$proj_visible});";?>

   <!-- <h3> <?php echo $str;?></h3> -->
   <?php 
   $r= mysqli_query($con,$str) ;

   $r2=$func->select_with_condition("project_id","project","project_name='$proj_name' and FinishID=$proj_finish and project_description='$proj_desc'");
   $r2=mysqli_fetch_array($r2);

   $sql="insert into user_project values('$proj_finish',".$r2["project_id"].",'".$proj_name."');";
   $result=mysqli_query($con,$sql);
    mysqli_close($con);
    if($r==false){
    ?>  
   <?php echo "<h2 class='error'>Creation Failed</h2>";
        include_once "animation-cross.php";?>
   <?php
    } else{
        
    ?>
    <h2> <?php echo "<h2 class='succ'>Successfully Created</h2>";
        include_once "animation-tick.php";?></h2>
<?php
}
}


?>
            
        	<div id="top_header">
          		<h3>Create Project</h3>
        	</div>
    
            <div id="inputs">
        <form id='login' method="post">
			<input type='hidden' name='submitted' id='submitted' value='1'/>

            <div class="container">
                <label for="proj_name">Project name</label>
                <!-- <input type="text" id="proj_name" name="proj_name"/> -->
					<input required type='text' id="proj_name" name="proj_name" placeholder="Name"/><br/>

            </div>

            <div class="container">
                <label for="proj_desc">Project Description</label>
                <!-- <input type="textarea" id="proj_desc" name="proj_desc"/> -->
                <input required type='textarea' id="proj_desc" name="proj_desc" placeholder="Description" /><br/>
			    

            </div>
        <div class="container">
            <label for="visibility">Make public</label>
            <input type="checkbox" id="proj_name" name="visibility"/>
        </div>
        <div class="container">

            <label for="authval">Authorization:</label>
            <select  id="authval" name="authval" required >
        
        <option value="" disabled selected hidden>Club member position</option>
    <?php
    while($row=mysqli_fetch_array($r23)){
        $u=$row['zval'];
        $name=$row['position'];
    ?>
       <option value="<?php echo $u?>" ><?php echo $name ?></option>
       
    <?php }
    ?>
    </select> 
    </div>
    <div class="container">
        <input type=submit name=sub value=create> 
    </div>   

        

            </form>
            </div>
        </div>
    </div>

</body>
</html>