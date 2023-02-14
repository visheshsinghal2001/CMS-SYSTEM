<?php
session_start(); 
if(!isset($_SESSION['user_id']))  // check admin or not
{
    header("location:../Logout.php");    
}

require '../init.php';
$proj_id=$_REQUEST['proj_id'];
$func=new Operation();
$uid=$_SESSION["user_id"];
$zval=$_SESSION['zval'];
$r=$func->select_with_join_condition("*","user","inner join","club_heir","user.position=club_heir.position","zval>=$zval");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task assign</title>
    <script src="jso.js"></script> 
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="jso2.js"></script> 
    <script src="final.js"></script> 
    <link rel="stylesheet" href="animation.css">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

</head>

<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:400,300,600,400italic);
* {
  color: #a2a3a7;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  -webkit-font-smoothing: antialiased;
  -moz-font-smoothing: antialiased;
  -o-font-smoothing: antialiased;
  
  /* font-smoothing: antialiased; */
  text-rendering: optimizeLegibility;
  
}
body {
  background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
        url("../background.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    /* width: 100vw; */
    height: 100vh;
    font-family: "Whitney", sans-serif;
    text-rendering: optimizeLegibility;
    user-select: none;
  /* background: #363940; */
  /* background: #4CAF50; */
}

.container {
  width: 100%;
    height: 100%;
    margin: 0 auto;
}

#contact input[type="text"],
#contact input[type="email"],
#contact input[type="tel"],
#contact input[type="url"],
#contact textarea {
  font: 400 12px/16px "Roboto", Helvetica, Arial, sans-serif;
  border-radius: 10px;
}

#contact {
  /* background: #F9F9F9; */
  width: fit-content;
    padding: 2rem;
    height: fit-content;
    margin: 2rem auto;
    -webkit-border-radius: 4px;
    -o-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 10px;
    background-color: #363940;
}

#contact h3 {
  display: block;
  color: white;
  font-size: 30px;
  font-weight: 600;
  text-align: center;
  margin-block-start: 30px;
    margin-block-end: 1em;
    margin-bottom: 40px;
}

#contact h4 {
  margin: 5px 0 15px;
  display: block;
  font-size: 13px;
  font-weight: 400;
}

fieldset {
  border: medium none !important;
  margin: 0 0 10px;
  min-width: 100%;
  padding: 0;
  width: 100%;
}

#contact input[type="text"],
#contact input[type="email"],
#contact input[type="tel"],
#contact input[type="url"],
#contact textarea {
  width: 100%;
  border: 1px solid #ccc;
  /* background: #FFF; */
  margin: 0 0 5px;
  padding: 10px;
}

#contact input[type="text"]:hover,
#contact input[type="email"]:hover,
#contact input[type="tel"]:hover,
#contact input[type="url"]:hover,
#contact textarea:hover {
  -webkit-transition: border-color 0.3s ease-in-out;
  -moz-transition: border-color 0.3s ease-in-out;
  transition: border-color 0.3s ease-in-out;
  border: 1px solid #aaa;
}

#contact textarea {
  height: 100px;
  max-width: 100%;
  resize: none;
}
#contact-submit{
  cursor: pointer;
  width: 100%;
  border: none;
  /* background: #363940; */
  background-color: #405dc3;
  color: #FFF;
  margin: 0 0 5px;
  padding: 10px;
  font-size: 15px;
  font: 400 12px/16px "Roboto", Helvetica, Arial, sans-serif;
  border-radius: 5px;
}
#contact button[type="submit"] {
  cursor: pointer;
  width: 100%;
  border: none;
  /* background: #363940; */
  /* background-color: #363940; */

  color: #FFF;
  margin: 0 0 5px;
  padding: 10px;
  font-size: 15px;
}

#contact button[type="submit"]:hover {
  /* background-color: #363940; */

  /* background: #43A047; */
  -webkit-transition: background 0.3s ease-in-out;
  -moz-transition: background 0.3s ease-in-out;
  transition: background-color 0.3s ease-in-out;
}

#contact button[type="submit"]:active {
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.5);
}

.copyright {
  text-align: center;
}

#contact input:focus,
#contact textarea:focus {
  outline: 0;
  border: 1px solid #aaa;
}

::-webkit-input-placeholder {
  color: #888;
}

:-moz-placeholder {
  color: #888;
}

::-moz-placeholder {
  color: #888;
}

:-ms-input-placeholder {
  color: #888;
}
input[type="text"],
input[type="datetime-local"],
input[type="password"],
input[type="submit"],
select,
label {
    width: 400px;
    font-size: 1rem !important;
    height: 40px;
    position: relative;
    margin: 0 auto;
    display: block;
    margin-bottom: 5px;
    padding: 15px;
    box-sizing: border-box;
    -webkit-text-stroke: 0.1px;
    color: #919296;
}

input[type="text"],
input[type="datetime-local"],
select,
input[type="password"] {
    font-family: "Lato", sans-serif;
    font-weight: 300;
    font-size: 16px;
    border: thin solid #ccc;
    border-radius: 5px;
    color: #c4c3ca;
    background-color: #323338;
}

input[type="text"]:focus,
input[type="datetime-local"]:focus,
select:focus,
input[type="password"]:focus {
    border: thin solid #21d481;
    -webkit-transition: all 0.4s ease;
    -moz-transition: all 0.4s ease;
    -o-transition: all 0.4s ease;
    transition: all 0.4s ease;
}

input[type="text"]:focus,
input[type="datetime-local"]:focus,
select:focus,
input[type="password"]:focus {
    border-left: thin solid #21d481;
}

input[type="submit"] {
    background-color: #7289d9;
    height: 50px;
    color: white;
    cursor: pointer;
    border-radius: 5px;
    font-weight: 300;
    font-size: 16px;
    transition: all 0.3s ease;
    margin-top: 0px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #677bc4;
    box-shadow: 0 8px 24px 0 rgba(16, 39, 112, 0.2);
}
label {
  padding-left: 0;
  padding-right: 0;
}
select {
  height: fit-content;
}
.contact{
  font-size: 19.2px;
}

input[type = "button"]:hover {
    background-color: #677bc4;
    box-shadow: 0 8px 24px 0 #677bc45e;
}
.lead1 {
    font-size: 1rem !important;
    color: white;
    display: block;
}

textarea {
  font-size: 1rem !important;
  background-color: #323338
}
</style>
<body>
<?php include_once 'nav.php';?>
    <div class="container">  
        <form id="contact"  method="post">
        <?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $taskName=$_POST['taskname1'];
    $taskDetail=$_POST['desc'];
    $taskProject=$proj_id;
    $taskDeadLine=$_POST["dead"];
    $userId=$_POST['recv'];
    $myName=$_SESSION['fname'];
    $myProfile= $_SESSION["image"];
    
     $result = $func->insert(array('task_name','task_details','task_project','dead_line','task_receiver','task_sender','task_sender_name','task_sender_image'),"task",array("'$taskName'", "'$taskDetail'","'$taskProject'","'$taskDeadLine'","'$userId'","'$uid'","'$myName'","'$myProfile'"));
   if($result!=false){
    $con=$func->connect();
    $r3=$func->select_with_condition("*","user_project","user_id=$userId and project_id=$taskProject");
    if(!$rown=mysqli_fetch_array($r3)){

      $r2=$func->select_with_condition("project_name","project","project_id=$proj_id");
      $r2=mysqli_fetch_array($r2);
      $sql="insert into user_project values('$userId','$taskProject','".$r2["project_name"]."');";
      $result=mysqli_query($con,$sql);
    }

   echo "<h2 class='succ'>Successfully Created</h2>";
    include_once "animation-tick.php";}
    else{
      echo "<h2 class='error'>Creation Failed</h2>";
        include_once "animation-cross.php";
    }}
?>
          <h3>Assign Task</h3>

          <fieldset>
            <input placeholder="Task Name" type="text" tabindex="1" id = "taskname1" name=taskname1 onblur="validate('taskname',this.value)" required autofocus>
            <div id="taskname"></div>
          </fieldset>

          <fieldset>
            <textarea placeholder="Task Description" tabindex="5" required name = desc id = "desc" onblur="validate('description',this.value)"></textarea>
          </fieldset><div id="description"></div>

          <fieldset>
            <label>Deadline</label>&nbsp;
            <input placeholder="Deadline" name=dead type="datetime-local" id="dead" tabindex="2" onblur="validate('dates',this.value)" required>
            <div id="dates"></div>
          </fieldset>
          
          <fieldset>
            <label>Task Assign to</label>&nbsp;
            <select name=recv id="stem">
            <option value=0 disabled>select</option>

  
    <option value=0 disabled selected hidden>select</option>
    <?php
    while($row=mysqli_fetch_array($r)){
        $u=$row['user_id'];
        $name=$row['user_fname']." ".$row['user_lname'];
    ?>
       <option value="<?php echo $u?>" ><?php echo $name ?></option>
    <?php }
    ?>
    
    </select>
</fieldset>


    <fieldset>
    <div id="assign">
        
        <img id="selectuser" src="#" width=50px height=50px style="border-radius:50%;" alt="not found">
        <span id="selectName"> </span>
        <span id="selectPosition">skjhfsh </span>
        <span id="selectEmail"> </span>
    </div>
    <p id="error" class="error"></p>

  </fieldset>
  
  <fieldset>
    <!-- <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button> -->
    <input name=sub type="button" id="contact-submit" class="lead1" onclick="final()" value="Assign">
  

  </fieldset>
  </form>

<!-- completed bhi likh to show task assigned succesfully  -->

</div>
   
</body>
</html>