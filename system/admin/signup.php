<?php 
if (isset($_POST['submit'])) {
    include('includes/connection.php');
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statements
    $stmt = mysqli_prepare($con, "SELECT email FROM admin WHERE email=? AND password=?");
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    if (mysqli_stmt_num_rows($stmt) > 0) {
        echo "<script>alert('This email or Contact Number already associated with another account!.');</script>";
    } else {
        $stmt = mysqli_prepare($con, "INSERT INTO users (firstname, lastname, email, username, password) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $email, $username, $password);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('You have successfully registered.');</script>";
            header('location:login.php');
        } else {
            echo "<script>alert('Something Went Wrong. Please try again.');</script>";
        }
    }
}
?>
<?php include('includes/header.php'); ?>
<main>
    <div class="sidebar">
        <p>sidebar</p>

    </div>
    <div class="aside">
        <p>aside</p>
    </div>
    <br><br><br><br>

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
            <button><a href="../login.php.php"> Bach Home</button>
        </div>
        </div>
    </form>


</main>
<?php include('includes/footer.php'); ?>