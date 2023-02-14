<?php
    include_once '../init.php';
    $func = new operation();
    $outgoing_id = $_SESSION['user_id'];
    $searchTerm =$_POST['searchTerm'];
    $query=$func->select_with_condition("*","user","NOT user_id=$outgoing_id AND (user_fname LIKE '%{$searchTerm}%' OR user_lname LIKE '%{$searchTerm}%')");
    $output = "";
    if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_array($query)){
            $query2=$func->select_with_condition("*","messages","(incoming_msg_id = {$row['user_id']}
            OR outgoing_msg_id = {$row['user_id']}) AND (outgoing_msg_id = {$outgoing_id} 
            OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1");

            if($query!=false){
                
            
            // $query2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_array($query2);
            (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No message available";
            (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
            if(isset($row2['outgoing_msg_id'])){
                ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
            }else{
                $you = "";
            }
            ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
            ($outgoing_id == $row['unique_id']) ? $hid_me = "hide" : $hid_me = "";
    
            $output .= '<a href="chat.php?user_id='. $row['unique_id'] .'">
                        <div class="content">
                        <img src="'. $row['user_image'] .'" alt="">
                        <div class="details">
                            <span>'. $row['user_fname']. " " . $row['user_lname'] .'</span>
                            <p>'. $you . $msg .'</p>
                        </div>
                        </div>
                    </a>';
        }}
    }else{
        $output .= 'No user found related to your search term';
    }
    echo $output;
?>