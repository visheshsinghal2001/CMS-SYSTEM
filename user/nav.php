
<div class="navbar">
        <div class="container1">
            <ul>
                <li>
                <h1>
                    <img src="../logo/logo.png" alt="logo" width=60px height=60px style="vertical-align:middle;" >
                </h1>
                </li>

                <!-- <li class="home">
                    <a href="#home">Home</a>
                </li> -->

                <li class="home"><a href="userhome.php?userid=<?php echo $_SESSION['user_id'];?> ">Home</a></li>


                <?php
                if($_SESSION['zval']<11){
                    ?>
                    <li class="profile"><a href="newuser.php">Add User</a></li>
                <?php
                }
                ?>

<li class="profile"><a href="userinfo.php?userid=<?php echo $_SESSION['user_id']?> ">Profile</a></li>

                <!-- <li class="about"><a href="#about">About</a></li> -->
<!--                 
                <li class="contact"><a href="#contact">Contact</a></li> -->

                <li class="contact"><a href="confirm.php?> ">Update Profile</a></li>


            </ul>
            <a href="../logout.php">
                Logout</a>
        </div>
</div>