<?php
session_start(); 
if(!isset($_SESSION['user_id']))
{
//   session_destroy();
//   header("location:../Logout.php");
$_SESSION['user_id']=69;
  
}
require '../../init.php';
  $func = new operation();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
  body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.outgoing{
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.chat-box{
  border: 2px solid #dedede;
    background-color: #f1f1f1;
    border-radius: 5px;
    padding: 10px;
    margin: 10px 0;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}
</style>
<body>
    <section>
    <?php 
    session_start();

          $user_id = $_GET['user_id'];
          $sql=$func->select_with_condition("*","users","user_id=$user_id");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_array($sql);
          }else{
            header("location: ../logout.php");
          }
        ?>
        <!-- <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a> -->
        <img src="<?php echo $row['user_image']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['user_fname']. " " . $row['user_lname'] ?></span>
          <!-- <p><?php echo $row['status']; ?></p> -->
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>
    </section>
</body>
</html>