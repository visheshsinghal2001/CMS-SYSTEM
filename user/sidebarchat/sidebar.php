<?php

// include_once "config.php";
include_once '../init.php';
$func = new operation();
?>
<div class="search">
        <!-- <spanclass="text">Select an user to start chat</span> -->
        <br>
        <input  id="bar" type="text" placeholder="Enter name to search...">
        <button hidden id="searchbutton">search</i></button >
</div>
<div class="users-list">
</div>

<script src="javascript/users.js"></script>