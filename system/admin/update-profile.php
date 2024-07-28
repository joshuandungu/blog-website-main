
<?php
session_start();
error_reporting(0);
if(!isset($_SESSION['userid'])){
    header('location:login.php');
}
include('includes/connection.php');
if (isset($_GET['profileid'])) {
    $profileid = $_GET['profileid'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $image = $_FILES["profile_image"]["name"];
    // get the image extension
    $extension = substr($image, strlen($image) - 4, strlen($image));
    // allowed extensions
    $allowed_extensions = array(".jpg", "jpeg", ".png", ".gif");
    // Validation for allowed extensions .in_array() function searches an array for a specific value.
    if (!in_array($extension, $allowed_extensions)) {
        echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
    } else {
        //rename the image file
        $newimage = md5($image) . time() . $extension;
        // Code for move image into directory
        move_uploaded_file($_FILES["image"]["tmp_name"], "images/" . $newimage);
    }


    $sql = mysqli_query($con, "UPDATE users SET firstname= '$firstname', lastname= '$lastname', email='$email',username='$username' profile_image= '$newimage'  WHERE userid='$profileid' ");
    if ($sql) {
        echo "<script>alert('Profile updated successfully');</script>";
        header('location:lofin.php');
    } else {
        echo "<script>alert('Failed to to update profile');</script>";
    }
} else {
    echo "<script>alert('Something wrong happened');</script>";
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
    <?php
    include('includes/connection.php');
    $usermail = $_SESSION['usermail'];
    $query = mysqli_query($con, "SELECT * FROM users WHERE email = '$usermail'");
    $cnt = 1;
    while ($row = mysqli_fetch_array($query)) {
    ?>

        <form action="update-profile.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="firstname">FIRTS NAME</label>
                <input type="text" name="firstname" id="firstname" placeholder="Enter your Firstname" value="<?php $row['firstname']; ?>">
                <hr>
            </div>
            <div class="form-group">
                <label for="lastname">LAST NAME</label>
                <input type="text" name="lastname" id="lastname" placeholder="Enter your Last name" value="<?php $row['lastname']; ?>">
                <hr>
            </div>
            <div class="form-group">
                <label for="email">EMAIL</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" value="<?php $row['email']; ?>">
                <hr>
            </div>
            <div class="form-group">
                <label for="username">USERNAME</label>
                <input type="text" name="username" id="username" placeholder="Enter your Username" value="<?php $row['username']; ?>">
                <hr>
            </div>
            <div class="form-group">
                <label for="profileimage">Profile Image</label>
                <input type="file" name="profile_image" id="profileimgage" placeholder="Upload profile image" accept="image/*">
                <hr>
            </div>
            <div class="form-group">
                <button><a href="update-profile.php?profileid=<?php echo $row['userid']; ?>">Update Profile</a></button>
            </div>
        </form>


    <?php }
    $cnt = $cnt + 1;
    ?>


</main>
<?php include('includes/footer.php'); ?>