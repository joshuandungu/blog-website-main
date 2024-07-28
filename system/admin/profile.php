<?php
session_start();
error_reporting(0);

if (!isset($_SESSION['admin'])) {
    header('location:login.php');
    exit(); // Stop script execution after header redirect
}

if (isset($_POST['submit'])) {
    include('includes/connection.php');

    $user = $_SESSION['admin'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $image = $_FILES['profile_image'];
    $image_name = $_FILES['profile_image']['name'];
    $tmp_name = $image['tmp_name'];
    $destination = "images/" . $image_name;
    move_uploaded_file($tmp_name, $destination);

    if (empty($firstname) || empty($lastname) || empty($email) || empty($username) || empty($password)) {
        echo "<script>alert('Empty fields');</script>";
    } else {
        $query = mysqli_query($con, "UPDATE admin SET firstname='$firstname', lastname='$lastname', email='$email', username='$username', password='$password', profile_image='$image_name' WHERE email='$user'");
        if ($query) {
            echo "<script>alert('User account updated successfully');</script>";
            header('location:logout.php');
            exit(); // Stop script execution after header redirect
        } else {
            echo "<script>alert('Failed to update account');</script>";
        }
    }
}
?>
<?php include ('includes/header.php');?>
<?php 
include ('includes/connection.php');
$user = $_SESSION['admin'];
$cnt = 1;
$sql=mysqli_query($con,"select * from admin where email='$user' ");
while($row=mysqli_fetch_assoc($sql)){
    ?>
    <main>
        <br><br><br><br>
    <form action="profile.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="firstname">FIRST NAME</label>
            <input type="text" name="firstname" id="firstname"  value="<?php echo $row['firstname'];?>"placeholder="Enter your Firstname" required>
            <hr>
        </div>
        <div class="form-group">
            <label for="lastname">LAST NAME</label>
            <input type="text" name="lastname" id="lastname" value="<?php echo $row['lastname'];?>" placeholder="Enter your Last name" required>
            <hr>
        </div>
        <div class="form-group">
            <label for="email">EMAIL</label>
            <input type="email" name="email" id="email" value="<?php echo $row['email'];?>" placeholder="Enter your email" required>
            <hr>
        </div>
        <div class="form-group">
            <label for="username">USERNAME</label>
            <input type="text" name="username" id="username"  value="<?php echo $row['username'];?>"placeholder="Enter your Username" required>
            <hr>
        </div>
        <div class="form-group">
            <label for="password">PASSWORD</label>
            <input type="password" name="password" id="password" value="<?php echo $row['password'];?>" placeholder="Enter your password" required><br>
            <label for="profile_image">PROFILE IMAGE</label>
            <input type="file" name="profile_image" id="profile_image"  placeholder="Upload Your profile Image" required><br>
        </div>
        <div class="form-group">
            <button type="submit" name="submit" value="update">Update Profile</button>
        </div>
    </form>
    </main>
<?php } $cnt= $cnt +1; ?>



   <?php include ('includes/footer.php'); ?>
