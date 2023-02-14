<?php
  session_start();
    if(!isset($_SESSION['user_id']))  // user check
    {
      header("location:../Logout.php");    
    }
    require '../init.php';
    $func = new operation();
    
    $user_id=$_SESSION['user_id'];
    // $user_id=1;
    
 
  $r=$func->selectall("club_heir");
  
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add user</title>
    <link rel="stylesheet" href="newuser-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="animation.css">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
  </head>
<body>

<?php include_once 'nav.php';?>




<div id="wrapper">
    	<div id="box">
        <br>
      <?php 
    // if(isset($_POST['createuser'])){
      if($_SERVER["REQUEST_METHOD"] == "POST"){
      
      $conn=$func->connect();

      $fname=$_POST["fname"];
      $lname=$_POST["lname"];
      $email=$_POST["email"];
      $password=$_POST['password'];
      $gender=$_POST['gender'];    
      
      $image="../images/".basename($_FILES['profile']['name']);
      $position=(isset($_POST['addnew']))?$_POST['newpos']:$_POST["position"];
      $uploaddir = '../images/';
      $uploadfile = $uploaddir . basename($_FILES['profile']['name']);
  
      error_reporting(E_ALL);
      echo "<p>";
      if (move_uploaded_file($_FILES['profile']['tmp_name'], $uploadfile)) // upload user image
      {
        echo "<h2 class='succ'>Successfully Added</h2>";
        include_once "animation-tick.php";
      }
      else {
        
        echo "<h2 class='error'>Upload Failed</h2>";
       include_once "animation-cross.php";
     }
  
     echo "</p>";
    
  
      if(isset($_POST['addnew'])){
        $sql="insert into club_heir (position,zval) values('".$_POST['newpos']."',".$_POST['newzval'].");";
        mysqli_query($conn,$sql);
        $position=$_POST["newpos"];
      }
      $password = password_hash($password,PASSWORD_ARGON2ID);

        $sql="insert into user (user_fname,user_lname,user_email,user_password,user_gender,user_image,position) values(";
       $sql.='"'.$fname.'","'.$lname.'","'.$email.'","'.$password.'","'.$gender.'","'.$uploadfile.'","'.$position.'")';
       $k=mysqli_query($conn,$sql);
       $temp=basename($_FILES["profile"]["tmp_name"]);
       $name = basename($_FILES["profile"]["name"]);
      //  $k=move_uploaded_file($temp, "../images/");
       if($k==false){
        ?>
        <?php
       }
       else {
       }
      }
    ?>
        	<div id="top_header">
          		<h3>Create New User</h3>
        	</div>
        
        <div id="inputs">
        	<form enctype="multipart/form-data" id='login' method='post' accept-charset='UTF-8'>
				
				<input type='hidden' name='submitted' id='submitted' value='1'/>

				<div class='container'>
        <label>First Name</label>
        <input type="text" placeholder="First Name" name="fname" required=""/><br/>
				</div>
				
				<div class='container'>
          <label>Last Name</label>
          <input type="text" placeholder="Last Name" name="lname"  required=""/>
				</div>
				
				<div class='container'>
        <label>Email</label>
              <input type="email" placeholder="Email" name="email"  required=""/>
				</div>
                
        <div class='container'>
        <label>Password</label>
              <input type="password" placeholder="password" name="password" required="" />   
				</div>

        <div class='container'>
       <label >Gender :</label> 
       <div class="choices">
       <label class="inline">Male</label><input   type="radio" name="gender" value="male" checked>
               <label class="inline" >Female</label> <input type="radio" name="gender" value="female">
       </div> 
       
       
              <br> 
        </div>
        
        <div class='container'>
        <label class="switch">
              Position:</label>
              <select name="position" >
                <option value="president"  selected hidden>select</option>

<?php
while($row=mysqli_fetch_array($r)){
  $pos=$row['position'];

  ?>
  <option value="<?php echo $pos?>"><?php echo $pos ?></option>
<?php
}
?>
              </select>      
        </div>
        <div class='container'>
        <label>Create New</label>
          <input type="checkbox" name="addnew" value="1"> 
          
        </div>
        <div class='container'>
        <label>Enter position name</label>
            <input type="text" name="newpos" id="hidinp">       
        </div>
        <div class='container'>
        <label>Zval (the lower the higher in heirarchy)</label>
            <input type="number" name="newzval" id="hidinz">     
        </div>
        <div class="container">
        <label>Image</label>
              <input type="file" name="profile" />
        </div>
        <div class='container'>
        <input  type="submit" class="btn" name="createuser" value="Create" />  
        </div>
        </form>

    </div>

<?php
if(isset($_POST['promote'])){
  $email=$_POST['emailTouodate'];
  $position=$_POST['position'];
  $func->update("user","postion='".$position."'","user_email='$email'");
}
?>
		
    </div>
  </div>
</div>


</body>
</html>

<?php 
//}
?>