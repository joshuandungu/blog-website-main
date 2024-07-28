<?php 
session_start();
error_reporting(0);
if(!isset($_SESSION['userid'])){
    header('location:login.php');
}
?>
<div class="container">
<?php include ('includes/header.php');?>
<div class="sidebar"><?php include ('includes/sidebar.php');?></div>   
<div class="aside"><?php include ('includes/aside.php');?></div>
<main>
 
    <form action="update-profile.php" method="POST" enctype="multipart/form-data">
        <div clas="form-group">
        <label for="image">Update Profile Image</label>
        <input type="file" name="profile_image" accept="image/*" placeholder="Upload a profile image">
        </div>
        <div class="form-group">
            <button type="submit" value="submit" name="submit">Update</button>
        </div>

    </form>
</main>
<?php include ('includes/footer.php');?>
?>













<?php 
include ('includes/connection.php');
if(isset($_POST['submit'])){
    $imageid = $_GET['imageid'];
    $image= $_FILES['profile_image'];
    $image_name= $_FILES['profile_image'] ['name'];
    $tmp_name = $image['name'];
    $destination = "images/" . $image_name;
    move_uploaded_file($image, $destination);
    if(empty($image_name)){
        echo "<script>alert('Empty profile image');</script>";
    }
    else {

    $sql=mysqli_query($con," update users set profile_image='$image_name' WHERE userid='$imageid'");
    if($sql){
        echo "<script>alert('Profile image updated successfully');</script>";
        header('location:profile.php');
    }
    else {
        echo "<script>alert('Failed to update profile image');</script>";
    }
    }
}
else {
    echo "<script>alert('Error something wrong happened');</script>";

}
?>
