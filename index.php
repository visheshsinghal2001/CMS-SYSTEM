<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="animation.css">
<script>
    let ele=document.querySelector('#error_txt');   
</script>
</head>
<body>



    <div id="wrapper">
    	<div id="box">
        <?php
if(isset($_POST['sub'])){
    require 'init.php';
    $uid=$_POST['uid'];
    $pass=$_POST['pass'];
    $cond="user_email='$uid'";
    $func = new operation();
    $r=$func->select_with_condition("*","user",$cond);
    if($row=mysqli_fetch_array($r)){
        // $row=mysqli_fetch_array($r);
        
        if(password_verify($pass, $row['user_password'])){

            
            session_start();
            $_SESSION['user_id']=$row["user_id"];
            $_SESSION['position']=$row["position"];
            $r2=$func->select_with_condition("zval","club_heir","position=\"".$row["position"]."\"");
            $r3=mysqli_fetch_array($r2);
            $_SESSION['zval']=$r3["zval"];
            $_SESSION["fname"]=$row["user_fname"]." ".$row["user_lname"];
            
            $_SESSION["image"]=$row["user_image"];
            
            header("location: user/userhome.php");
        }
        else{
            echo "<h2 class='error'>Wrong Password</h2>";
            include_once "animation-cross.php";
        }
    }
    else{
        echo "<h2 class='error'>Wrong Email</h2>";
        include_once "animation-cross.php";
       
    }

}
    ?>
        	<div id="top_header">
          		<h3>Club Management System</h3>
        	</div>
        
        <div id="inputs">
        	<form id='login' method='post' accept-charset='UTF-8'>
				
				<input type='hidden' name='submitted' id='submitted' value='1'/>

				<div class='container'>
                    <label for="uid">User Email</label>
					<input type='text' id="uid" name="uid" placeholder="User Email"/><br/>
				</div>
				
				<div class='container'>
                    <label for="password">Password</label>
					<input type='password' id="password" name="pass" placeholder="Password" /><br/>
				</div>
				
				<div class='container'>
					<input type='submit' name="sub" value="Login" />
				</div>

			</form>

        </div>
    	</div>
    </div>

</body>
</html>