<?php
session_start();
if(!isset($_SESSION['user_id']))  // user check
    {
      header("location:../Logout.php");    
    }
    require '../init.php';
    $func = new operation();
    $uid=$_SESSION['user_id'];
    // $uid=1;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="confirm-style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="animation.css">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
<?php include_once 'nav.php';?>
<div id="wrapper">
    	<div id="box">
        <?php
if(isset($_POST["sub"])){
    $pass=$_POST['pass'];
    if(!empty($pass)){
        $r=$func->select_with_condition("user_password","user","user_id=$uid");
        if($row=mysqli_fetch_array($r)){
            
            if(password_verify($pass, $row["user_password"])){
                header("location: updateuser.php");
                
            }
            else{
                echo "<h2 class='error'>Wrong Password</h2>";
                include_once "animation-cross.php";
            }
        }else{
            echo "<h2 class='error'>No Such User</h2>";
            include_once "animation-cross.php";
        }

    }else{
        echo "<h2 class='error'>Missing Password</h2>";
        include_once "animation-cross.php";
    }
}
?>
        	<div id="top_header">
          		<h3>Confirm Yourself</h3>
        	</div>
        
        <div id="inputs">
        	<form  method='post' accept-charset='UTF-8'>
				
				<div class='container'>
        <label>Confirm Password</label>
        <input type="password" name="pass" required><br/>
				</div>
				
                <div class='container'>
                    <input type="submit" name="sub" value="Go in"/><br/>
				</div>
                
            </form>
    </div>
  </div>
</div>


</body>
</html>