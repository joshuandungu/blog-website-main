<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('includes/connection.php');
    $email = $_POST['email'];
    $password =SHA1( $_POST['password']);

    $sql = "select * from users where email='$email' and password='$password'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            echo "<script>alert('Logged in Successfully');</script>";
            session_start();
            $_SESSION['userid'] = $email;
            header('location:index.php');
        } else {
            echo "<script>alert('Something Went Wrong. Please try again.');</script>";
            header('location:login.php');
        }
    }
}

?>


<div class="container">
<?php include ('includes/header.php');?>
<div class="sidebar"><?php include ('includes/sidebar.php');?></div>
<div class="aside"><?php include ('includes/aside.php');?></div>
<main>
    <!-- Your login form HTML here -->
    <div style="margin-left:200px; margin-top:150px; border: 3px solid black;height: 400px; width:fit-content; float:center; align-items:center;">

            <form action="login.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="email">EMAIL</label>
                    <input type="email" name="email" id="email" placeholder="Enter your Email" required>
                    <hr>
                </div>
                <div class="form-group">
                    <label for="password">PASSWORD</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required><br>
                    <button type="submit" name="submit" value="login">Login</button>
                    <button><a href="signup.php">Signup</a></button>
                    <button> <a href="forgot-password.php">Forgot Password</a></button>
                </div>
            </form>
    </div>




</main>

<?php include('includes/footer.php'); ?>