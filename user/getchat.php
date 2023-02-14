<?php 
// echo "yes";
     session_start();
    if(isset($_SESSION['user_id'])){
        include_once "../init.php";
        $func2=new operation();

        $incoming_id = $_POST['incoming_id'];
        $outgoing_id = $_POST['outgoing_id'];
        $output = " ";
        $sql = "( outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id} ) OR ( outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id} ) ORDER BY msg_id";
        // echo($sql);
        // echo $sql;
        $query=$func2->select_with_join_condition("*","messages","LEFT OUTER JOIN","user","user.user_id = messages.outgoing_msg_id",$sql);
      
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_array($query)){
                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }else{
                    $output .= '<div class="chat incoming">
                                <img '.'width="50" height="50" style="border-radius:50%" '.'src="'.$row['user_image'].'" alt="">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ../logout.php");
    }

?>