<?php 
    session_start();
    if(isset($_SESSION['user_id'])){
        include_once "init.php";
        $outgoing_id = $_POST['user_id'];
        $incoming_id = $_POST['incoming_id'];
        $message = $_POST['message'];
        if(!empty($message)){
            $conn=$func->connect();
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die("dead");
        }
    }else{
        header("location: ../logout.php");
    }


    
?>