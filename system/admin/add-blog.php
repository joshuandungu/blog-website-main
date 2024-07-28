
<?php
session_start();
error_reporting(0);
include ('includes/connection.php');
if(!isset($_SESSION['admin'])){
    header('location:login.php');
}
?>
<?php
session_start();
error_reporting(0);
include('includes/connection.php');

if (!isset($_SESSION['admin'])) {
    header('Location: login.php', true, 303);
    exit();
}

if (isset($_POST['submit'])) {
    $uploader = mysqli_real_escape_string($con, $_SESSION['admin']);
    $blog_title = mysqli_real_escape_string($con, $_POST['blog_title']);
    $cat_title = mysqli_real_escape_string($con, $_POST['cat_title']);
    $details = mysqli_real_escape_string($con, $_POST['details']);

    // File Upload Handling
    $image_name = $_FILES['blog_image']['name'];
    $tmp_name = $_FILES['blog_image']['tmp_name'];
    $destination = "images/" . $image_name;

    // Validate uploaded file
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $file_extension = pathinfo($image_name, PATHINFO_EXTENSION);

    if (!in_array(strtolower($file_extension), $allowed_extensions)) {
        echo "<script>alert('Invalid file format. Only JPG, JPEG, PNG, and GIF files are allowed.');</script>";
    } elseif (move_uploaded_file($tmp_name, $destination)) {
        // Check if a blog with the same title already exists
        $check_query = mysqli_query($con, "SELECT * FROM blogs WHERE blog_title = '$blog_title'");
        if (mysqli_num_rows($check_query) > 0) {
            echo "<script>alert('Blog with this title already exists');</script>";
        } else {
            $insert_query = mysqli_query($con, "INSERT INTO blogs (uploader, blog_title, cat_title, details, blog_image) VALUES ('$uploader', '$blog_title', '$cat_title', '$details', '$image_name')");
            if ($insert_query) {
                echo "<script>alert('Blog inserted successfully');</script>";
                header('Location: manage-blogs.php', true, 303);
                exit();
            } else {
                echo "<script>alert('Failed to upload, something went wrong');</script>";
            }
        }
    } else {
        echo "<script>alert('File upload failed');</script>";
    }
}
?>

<!-- Your HTML form here (no changes needed) -->



<?php include('includes/header.php'); ?>
<main>
    <br><br><br><br>
    <div>
        <?php include ('includes/sidebar.php');?>

    </div>
    <div>
        <?php include ('includes/asidebar.php');?>
    </div>


    <form action="add-blog.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Blog Title</label>
            <input type="text" name="blog_title" id="title" placeholder="Enter blog title" required>
        </div>
        <div class="form-group">
            <label for="category">Choose blog category</label>
            <select name="cat_title">
            <option>Select category</option>
            <?php
            include('includes/connection.php');
            $query = mysqli_query($con, "SELECT * FROM blog_cat");
            while ($row = mysqli_fetch_array($query)) {
                $cat_id = $row['cat_id'];
                $blog_cat = $row['cat_title'];
                ?>
            <option value="<?php echo $blog_cat;?>"><?php echo $blog_cat;?> </option>";
           <?php } ?>
            
            </select>
        </div>
        <div class="form-group">
            <label for="description"> Blog Details</label>
            <textarea type="text" name="details" id="details"  rows="10"cols="40" Placeholder="Give some description about the blog" required></textarea>
        </div>
        <div class="form-group">
            <lable for="image">Blog Image</lable>
            <input type="file" name="blog_image" accept="image/*" placeholder="Upload a blog image of your choice" required>

        </div>
        <div class="form-group">
            <input type="submit"  name="submit" value="submit" placeholder="Upload"> 
        </div>
    </form>


</main>
<?php include('includes/footer.php'); ?>