<?php
session_start(); 
if(!isset($_SESSION['user_id']))
{
//   session_destroy();
//   header("location:../Logout.php");
// $_SESSION['user_id']=69;
  
}
$send_id=$_SESSION['user_id'];
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
</head>

<style>
  *{
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }
  body{
    background:
    linear-gradient(
        rgba(0, 0, 0, 0.7), 
        rgba(0, 0, 0, 0.7)
        ),
        url("../background.jpg");
    /* background-repeat: no-repeat; */
    background-size: cover;
    background-attachment: fixed;
        /* width: 100vw; */
    height: 100vh;
  font-family: "Roboto", Helvetica, Arial, sans-serif;
  font-weight: 100;
  /* font-size: 12px; */
  line-height: 30px;
  color: #777;
  }
img{
  display: inline;
  vertical-align: middle;
}

  .chatIs{
    width:75%;
    position:fixed;
    right:0px;
    padding: 20px;
  }
  .outgoing{
    /* border: 2px solid #dedede; */
  /* background-color: #333; */
  /* border-radius: 5px; */
    /* opacity: 1; */
    /* border-color: #ccc; */
  /* background-color: #ddd; */
  /* background-color: #313236; */
  /* border: 2px solid #dedede; */
  /* background-color: #f1f1f1; */
  border-radius: 5px;
  /* padding: 10px; */
  padding:  0 px;
  /* margin: 0px 0; */
  }
.incoming{
  /* border: 2px solid #dedede; */
  /* background-color: greenyellow; */
  border-radius: 5px;
  /* padding: 10px; */
  padding: 0px;

  margin: 0px 0;
}
.details{
  color: #a2a3a7;
  height: fit-content;
  display: inline;
  vertical-align: middle;
}

.chat-area header{
  display: flex;
  align-items: center;
  padding: 18px 30px;
}
.chat-area header .back-icon{
  color: #333;
  font-size: 18px;
}
.chat-area header img{
  height: 45px;
  width: 45px;
  margin: 0 15px;
}
.chat-area header .details span{
  font-size: 17px;
  font-weight: 500;
}
.chat-box{
  position: relative;
  /* min-height: 200px;
  max-height: 75%; */
  height: 75%;

  overflow-y: scroll;
  /* padding: 10px 30px 20px 30px; */
  /* background: #f7f7f7; */
  box-shadow: inset 0 32px 32px -32px rgb(0 0 0 / 5%),
              inset 0 -32px 32px -32px rgb(0 0 0 / 5%);
}
.chat-box .text{
  position: absolute;
  top: 45%;
  left: 50%;
  width: calc(100% - 50px);
  text-align: center;
  transform: translate(-50%, -50%);
}
.chat-box .chat{
  margin: 4px;
}
.chat-box .chat p{
  word-wrap: break-word;
  padding: 8px 16px;
  box-shadow: 0 0 32px rgb(0 0 0 / 8%),
              0rem 16px 16px -16px rgb(0 0 0 / 10%);
}
.chat-box .outgoing{
  display: flex;
}
.chat-box .outgoing .details{
  margin-left: auto;
  max-width: calc(100% - 130px);
}
.outgoing .details p{
  /* background: #333; */
  background: green;
  color: #fff;
  border-radius: 18px 18px 0 18px;
}
.chat-box .incoming{
  display: flex;
  align-items: flex-end;
}
.chat-box .incoming img{
  height: 35px;
  width: 35px;
}
.chat-box .incoming .details{
  margin-right: auto;
  margin-left: 10px;
  max-width: calc(100% - 130px);
}
.incoming .details p{
  background: #fff;
  color: #333;
  border-radius: 18px 18px 18px 0;
}
.typing-area{
  padding: 18px 30px;
  display: flex;
  justify-content: space-between;
}
.typing-area input{
  height: 45px;
  /* width: calc(100% - 58px); */
  font-size: 16px;
  padding: 0 13px;
  border: 1px solid #e6e6e6;
  outline: none;
  /* border-radius: 5px; */
  border-radius: 5px 0 0 5px;
  width: inherit;
}
.typing-area button{
  color: #fff;
    width: 55px;
    border: none;
    outline: none;
    background: #333;
    font-size: 19px;
    cursor: pointer;
    opacity: 0.7;
    pointer-events: none;
    border-radius: 0 5px 5px 0;
    transition: all 0.3s ease;
    height: 45px;
    /* width: calc(100% - 58px); */
    font-size: 16px;
    /* padding: 0 13px; */
    border: 1px solid #e6e6e6;
    outline: none;
    border-radius: 0 5px 5px 0;
}
.typing-area button.active{
  opacity: 1;
  pointer-events: auto;
}

/* Responive media query */
@media screen and (max-width: 450px) {
  .form, .users{
    padding: 20px;
  }
  .form header{
    text-align: center;
  }
  .form form .name-details{
    flex-direction: column;
  }
  .form .name-details .field:first-child{
    margin-right: 0px;
  }
  .form .name-details .field:last-child{
    margin-left: 0px;
  }

  .users header img{
    height: 45px;
    width: 45px;
  }
  .users header .logout{
    padding: 6px 10px;
    font-size: 16px;
  }
  :is(.users, .users-list) .content .details{
    margin-left: 15px;
  }

  .users-list a{
    padding-right: 10px;
  }

  .chat-area header{
    padding: 15px 20px;
  }
  .chat-box{
    min-height: 400px;
    padding: 10px 15px 15px 20px;
  }
  .chat-box .chat p{
    font-size: 15px;
  }
  .chat-box .outogoing .details{
    max-width: 230px;
  }
  .chat-box .incoming .details{
    max-width: 265px;
  }
  .incoming .details img{
    height: 30px;
    width: 30px;
  }
  .chat-area form{
    padding: 20px;
  }
  .chat-area form input{
    height: 40px;
    width: calc(100% - 48px);
  }
  .chat-area form button{
    width: 45px;
  }
}
.color{
  /* background-color: #333; */
  display: flex;
  flex-direction: column;

  align-items: center;
  max-width: 25%;
  min-width: 25%;
  min-height: 640px;
  background-color: #313236;
}
.flexbox{
  height: 100%;
  display: flex;
}
.search {
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  margin-top: 20px;
}
#bar{
  background-color: #323338;
  border-radius: 10px;
  font-size: 1rem;
  border-color: #fff !important;
  /* margin: auto; */
  width: fit-content;
  padding: 10px 1rem;
  border: 1px solid green;
  color: white;
  margin-bottom: 1rem;

}
h3{
  font-family: "Poppins", sans-serif;
    font-size: 1.6rem;
    font-weight: 500;
    color: #fff;
    -webkit-text-stroke: 0.5px;
    margin-bottom: 0;
    margin-left: 10px;
}
.chatIs{
  height:100vh;
}
.chatIs .details span{
  font-weight: 600;
  font-size: 40px;
  opacity: 100%;
}
.wrap{
  vertical-align: middle;
}
.chatting .details .span{
  font-size: 14px !important;
}
.content{
  margin: 10px;
}
.sending{
  position: fixed;
    /* width: 500px; */
    bottom: 3%;
    left: 38%;
    width: 75%;
}
.sendit{
  /* position:fixed; */
  bottom:0;
  display:inline;
}
.content {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
}
.content span, .content p {
  text-align: center;
}
.chating .content .details {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
}
.text {
  font-size: large;
  color: white;
}
</style>

<div class="flexbox">
<div class="color"><br>
<div class="chat">
  <h3>Chats</h3>

</div>
<?php include_once "sidebarchat/sidebar.php";?>
  </div>
    <div class=chatIs>
    <?php 

          $user_id = $_GET['user_id'];
          $sql=$func->select_with_condition("*","user","user_id=$user_id");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_array($sql);
          }else{
            // header(F"location: ../logout.php");
          }
        ?>
        <!-- <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a> -->
          <div class="wrap">

        <img src="<?php echo $row['user_image']; ?>" alt="" width="50" height="50" style="vertical-align:middle;border-radius:50%">
        <div class="details">
          <span><?php echo $row['user_fname']. " " . $row['user_lname'] ?></span>
          <!-- <p><?php echo $row['status']; ?></p> -->
        </div>
      </div>

      <div class="chat-box">
      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" class="outgoing_id" name="outgoing_id" value="<?php echo $send_id; ?>" hidden>

        <div class="sending">
        <input id="sendit"  type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button>Send</i></button>

        </div>

      </form>
        </div>
  </div>
</div>
  

  <script src="javascript/chat.js"></script>
</body>
</html>

