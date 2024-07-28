<?php
session_start();
// Avoid using error_reporting(0) in production for debugging purposes
// error_reporting(0);

require_once('includes/connection.php');

if (!isset($_SESSION['admin'])) {
    header('location:login.php');
    exit(); // Stop script execution after header redirect
}
if (isset($_POST['submit'])) {
    $blog_cat = mysqli_real_escape_string($con, $_POST['blog_cat']);
    $updateid = mysqli_real_escape_string($con, $_POST['updateid']);

    $update = mysqli_query($con, "UPDATE blog_cat SET cat_title ='$blog_cat' WHERE cat_id='$updateid'");

    if ($update) {
        echo "<script>alert('Blog Category updated successfully');</script>";
        header('location:blog-categories.php');
        exit(); // Stop script execution after header redirect
    } else {
        echo "<script>alert('Failed to update, something wrong happened please try again');</script>";
    }
}

include('includes/header.php');
?>

<main>
    <div>
        <br><br><br>
        <?php include('includes/sidebar.php'); ?>
    </div>
    <div>
        <?php include('includes/asidebar.php'); ?>
    </div>
    <br><br><br>

    <?php
    if (isset($_GET['updateid'])) {
        $updateid = mysqli_real_escape_string($con, $_GET['updateid']);
        $query = mysqli_query($con, "SELECT * FROM blog_cat WHERE cat_id='$updateid'");
        while ($row = mysqli_fetch_array($query)) {
    ?>
            <form action="update-blog-cat.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="updateid" value="<?php echo $row['cat_id'];?>">
                <label for="cat">Blog Category</label>
                <input type="text" name="blog_cat" value="<?php echo $row['cat_title']; ?>" required>
                <button type="submit" name="submit">Update</button>
            </form>
    <?php
        }
    }
    ?>
   
</main>

<?php include('includes/footer.php'); ?>
