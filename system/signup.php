<?php 

if (isset($_POST['submit'])) {
    include('includes/connection.php');
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password =SHA1($_POST['password']);
    $msg = '';
    $userid = mt_rand(1000000, 9999999);
    // Use prepared statements
    $stmt = mysqli_prepare($con, "SELECT email FROM users WHERE email=? AND password=?");
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        echo "<script>alert('This email or Contact Number already associated with another account!.');</script>";
    } else {
        $stmt = mysqli_prepare($con, "INSERT INTO users (userid,firstname, lastname, email, username, password) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "isssss", $userid, $firstname, $lastname, $email, $username, SHA1($password));

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('You have successfully registered.');</script>";

            header('location:login.php');
        } else {
            echo "<script>alert('Something Went Wrong. Please try again.');</script>";
        }
    }
}
?>
<div class="container">
<?php include ('includes/header.php');?>
<div class="sidebar"><?php include ('includes/sidebar.php');?></div>
<div class="aside"><?php include ('includes/aside.php');?></div>
<main>
    
    <div style="margin-left:200px; overflow-y:scroll; border: 3px solid black;height: fit-content; width:fit-content; float:center; align-items:center;">

    <form action="signup.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="firstname">FIRTS NAME</label>
            <input type="text" name="firstname" id="firstname" placeholder="Enter your Firstname" required>
            <hr>
        </div>
        <div class="form-group">
            <label for="lastname">LAST NAME</label>
            <input type="text" name="lastname" id="lastname" placeholder="Enter your Last name" required>
            <hr>
        </div>
        <div class="form-group">
            <label for="email">EMAIL</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
            <hr>
        </div>
        <div class="form-group">
            <label for="username">USERNAME</label>
            <input type="text" name="username" id="username" placeholder="Enter your Username" required>
            <hr>
        </div>
        <div class="form-group">
            <label for="password">PASSWORD</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required><br>
            <button type="submit" name="submit" value="signup">Signup</button>
            <button><a href="login.php">Login</button>
        </div>
    </form>
    </div>


</main>
<?php include('includes/footer.php'); ?>