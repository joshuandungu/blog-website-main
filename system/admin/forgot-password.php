<?php 
$msg = 0;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include ('includes/connection.php');
    $email = $_POST['email'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    if (empty($email) || empty($current_password) || empty($new_password)){
        $msg = "Empty fields";
    }
    else if ($current_password != $new_password){
        $msg = "Current password and New password do not match";
    }
    else {
        $sql = mysqli_query($con, " UPDATE admin SET password = '$new_password'");
        if ($sql) {
            $msg = "Password Updated successfully";
            header('location:login.php');

        }
        else {
            $msg = " something went wrong please try again";
        }

    }
} 
?>







<?php include ('includes/header.php');?>
    <main>
        <div class= "sidebar">
            <p>sidebar</p>

        </div>
        <div class="aside">
            <p>aside</p>
        </div>


        <br><br><br><br>
        <?php if($msg){
            ?><p style="font-size: small; color:red; align:center;" role="alert"><?php echo $msg ;?></p>
        <?php } ?>
        <form  action="login.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
            <label for="email">EMAIL</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required><hr>
            </div>
            <div class="form-group">
            <label for="currentpassword">Current Password</label>
            <input type="password" name="current_password" id="currentpassword" placeholder="Enter current password" required><br>
            </div>
            <div class="form-group">
            <label for="newpassword">New Password</label>
            <input type="password" name="new_password" id="newpassword" placeholder="Enter  New password" required><br>

            </div>
            <div class="form-group">
            <button type="submit" value="submit">Update Password</button>
            <button><a href="signup.php">Signup</button>
            </div>
        </form>


    </main>
    <?php include ('includes/footer.php');?>