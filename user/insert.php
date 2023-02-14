<?php 
    session_start();
    if(isset($_SESSION['user_id'])){
        include_once "../init.php";
        $func=new operation();
        // $outgoing_id = $_SESSION['user_id'];
        $incoming_id = $_POST['incoming_id'];
        $outgoing_id = $_POST['outgoing_id'];
        $message = $_POST['message'];

        if(!empty($message)){
            $conn=$func->connect();
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')") or die();
        }
    }else{

    echo "teri maa ka";
    }


    
?>