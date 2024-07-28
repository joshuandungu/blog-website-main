<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include ('includes/connection.php');
    $email = $_POST['email'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    if (empty($email) || empty($current_password) || empty($new_password)){
        echo "<script>alert('Empty field, please fill in all the fields');</script>";
    }
    else if ($current_password != $new_password){
        $msg = "Current password and New password do not match";
    }
    else {
        $sql = mysqli_query($con, " UPDATE users SET password = '$new_password'");
        if ($sql) {
            echo "<script>alert('Updated user accounts successfully');</script>";
            header('location:login.php');

        }
        else {
            echo "<script>alert('Something Went Wrong. Please try again.');</script>";
        }

    }
} 
?>


<?php include ('includes/header.php');?>
    <main>
        <br><br><br><br>

        <form  action="login.php" method="POST" enctype="multipart/form-data">
        <div style="margin-left:300px; border: 3px solid black;height: fit-content; width:fit-content; float:center; align-items:center;">
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
        </div>
        </form>


    </main>
    <?php include ('includes/footer.php');?>