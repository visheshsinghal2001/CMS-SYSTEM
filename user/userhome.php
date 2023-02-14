<?php session_start(); 

if(!isset($_SESSION['user_id']))
{
  session_destroy();
  header("location:../Logout.php");
  exit;
  
}
require '../init.php';
  $func = new operation();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<style>
    .chat{
        border-right: solid 2px rgb(104, 104, 104);
        width: 20%;
        padding: 1rem;
        background-color: #313236;
    }
    #bar{
        background-color: #323338;
        color: #c4c3ca;border-radius: 5px;    
        font-family: "Lato", sans-serif;
        font-weight: 300;
        font-size: 16px;
        border: thin solid #ccc;
        margin: auto 5px;
        padding: 0.5rem 0.5rem;
        width: 95%;
        overflow: scroll;
        margin-bottom: 1rem;
        
    }
    .users-list a{
        background-color: #323338;
    }
    .search {
        width: 100%;
    }
    .contact{
        font-size: 19.2px;
    }
</style>
<body>
<?php include_once 'nav.php';?>
<!-- <div class="navbar">
        <div class="container1">
            <ul>
                <li>
                <h1>
                    theCompany
                </h1>
                </li>
                <li class="home">
                    <a href="#home">Home</a>
                </li>
                <li class="profile"><a href="#profile">Profile</a></li>
                <li class="about"><a href="#about">About</a></li>
                
                <li class="contact"><a href="#contact">Contact</a></li>
            </ul>
            <a href="../logout.php">
                Logout</a
            >
        </div>
</div> -->


    <nav>
        <!-- User image name and member status here -->
</nav>
<div class="container">
        <div class="chat"><br><h3>Chats</h3>
<?php include_once "sidebarchat/sidebar.php";?>
    <?php
    $uid=$_SESSION['user_id'];
    $name=$_SESSION["fname"];
    $pos= $_SESSION['position'];
    $img=  $_SESSION["image"];
    ?>
        <!-- <h6>Direct Messages</h6> -->
        <!-- <div class="contact">Vishesh</div> -->
        <!-- <div class="contact">Yash</div> -->
    </div>
    <!-- Tasks you have -->
    <div class="tasklist">
        <br>
    <h3>Task Now</h3>
        <?php
        $q="task_receiver=$uid and task_display=1 order by dead_line desc";
        $r=$func->select_with_condition("*","task",$q);
        if($r==false){
            echo "<h3>All Task Completed!!</h3>";
        }
        else{
        echo "<table>";

            $count=1920;
            while($row=mysqli_fetch_array($r)){
                
                ?>
            <tr id=<?php echo "$count";?>>
            <?php 
            $due=strtotime($row["dead_line"])-time();
            ?>
            <script>
            colorme(<?php echo "$count".$count+=1;?>,<?php echo $due;?>);
        </script>
                <td><image src=" <?php echo $row["task_sender_image"];?>"alt ="sender pic" width=50px height=50px style="border-radius:50%;vertical-align:middle;"> </td>
                <td><?php echo $row["task_sender_name"];?></td> 
                <td><?php echo $row["task_name"]; ?></td> 
                

               <td><a href="UserTaskDetails.php?task_id=<?php echo $row["task_id"]; ?>&proj_id=<?php echo $row["task_project"]; ?>" class="button">SEE DETAILS</a></td>


           <?php }}?>
            </table>
    </div>
    <!-- Active Projects you are part of -->
    <div class="allprojects">
                
    <div class=projects>
    <br>
        <a href="createproject.php" class="butt create">Create New project</a><br>
        <?php
        $r=$func->select_with_join_condition("*","user_project","inner join","project","user_project.project_id=project.project_id","user_id=$uid and project_status=1");
        ?><table><?php
        if($r==false){
            echo "<tr><td>No C ProjecActives</td></tr>";
        }
        else{
            echo "<br><h3>Active Projects</h3>";
            $count2=1980;
            while($row=mysqli_fetch_array($r)){
            $count2++;
             echo "<tr>";
             echo "<td>".$row['project_name']."</td>";
             echo "<td><a class=butt href=project.php?proj_id=".$row['project_id'].">show more</td>";

             echo "</tr>";
            }
        }
        
        ?>
        </table>
          <?php
        $r=$func->select_with_join_condition("*","user_project","inner join","project","user_project.project_id=project.project_id","user_id=$uid and project_status=0");
        if($r==false){
            echo "<tr><td>No Completed Projects</td></tr>";
        }
        else{
            echo "<br><h3>Completed Projects</h3>";
            echo "<table>";
            $count2=1980;
            while($row=mysqli_fetch_array($r)){
            $count2++;
             echo "<tr>";
             echo "<td>".$row['project_name']."</td>";
             echo "<td><a class=butt href=project.php?proj_id=".$row['project_id'].">show more</td>";

             echo "</tr>";
            }
            echo "</table>";
        }

        ?>
        </div>
    </div>
    </div>


</body>
</html>