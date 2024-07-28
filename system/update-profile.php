<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['userid'])) {
    header('location: login.php');
}
?>

<?php
session_start();
error_reporting(0);

if (!isset($_SESSION['userid'])) {
    header('location: login.php');
}

if (isset($_POST['submit'])) {
    include('includes/connection.php'); // Make sure to include your database connection file here.

    $updateid = $_GET['profileid'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    
    $newimage = '';

    if ($_FILES["profile_image"]["name"]) {
        $image = $_FILES["profile_image"]["name"];
        $extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");

        if (in_array($extension, $allowed_extensions)) {
            $newimage = md5($image) . time() . $extension;
            move_uploaded_file($_FILES["profile_image"]["tmp_name"], "images/" . $newimage);
        } else {
            echo "<script>alert('Invalid format. Only jpg / jpeg / png / gif format allowed');</script>";
        }
    }

    $sql = mysqli_query($con, "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', username='$username', profile_image='$newimage' WHERE userid='$updateid' ");

    if ($sql) {
        echo "<script>alert('Profile updated successfully');</script>";
        header('location: login.php');
    } else {
        echo "<script>alert('Failed to update profile');</script>";
    }
}
?>

<div class="container">
<?php include ('includes/header.php');?>
<div class="sidebar"><?php include ('includes/sidebar.php');?></div>   
<div class="aside"><?php include ('includes/aside.php');?></div>

<main>
  
    <?php
    include('includes/connection.php');
    if (isset($_GET['updateid'])) {
        $updateid = $_GET['updateid'];
        $query = mysqli_query($con, "SELECT * FROM users WHERE userid = '$updateid'");
        $cnt = 1;
        while ($row = mysqli_fetch_array($query)) {
            ?>
            <div style="height: 600px; width: 500px; border-style: groove; overflow: scroll; align-items: center;">
                <form action="update-profile.php?profileid=<?php echo $updateid; ?>" method="POST"
                    enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="firstname">FIRST NAME</label>
                        <input type="text" name="firstname" id="firstname" placeholder="Enter your Firstname"
                            value="<?php echo $row['firstname']; ?>">
                        <hr>
                    </div>
                    <div class="form-group">
                        <label for="lastname">LAST NAME</label>
                        <input type="text" name="lastname" id="lastname" placeholder="Enter your Last name"
                            value="<?php echo $row['lastname']; ?>">
                        <hr>
                    </div>
                    <div class="form-group">
                        <label for="email">EMAIL</label>
                        <input type="email" name="email" id="email" placeholder="Enter your email"
                            value="<?php echo $row['email']; ?>">
                        <hr>
                    </div>
                    <div class="form-group">
                        <label for="username">USERNAME</label>
                        <input type="text" name="username" id="username" placeholder="Enter your Username"
                            value="<?php echo $row['username']; ?>">
                        <hr>
                    </div>
                    <div class="form-group">
                        <label for="profile_image">Profile Image</label>
                        <input type="file" name="profile_image" id="profile_image"
                            accept=".jpg, .jpeg, .png, .gif">
                        <hr>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" value="submit">Update</button>
                    </div>
                </form>
            </div>
    <?php
        }
    }
    ?>

</main>
<?php include('includes/footer.php'); ?>
