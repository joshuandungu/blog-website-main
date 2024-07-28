<?php
session_start();
error_reporting(0);

if (!isset($_SESSION['admin'])) {
    header('location: login.php');
    exit(); // Added exit to stop further execution
}

include('includes/connection.php');

if (isset($_POST['submit'])) {
    $media_name = mysqli_real_escape_string($con, $_POST['media_name']);
    $media_link = mysqli_real_escape_string($con, $_POST['media_link']);
    $image = $_FILES['media_image']; // Corrected variable name

    $image_name = $_FILES['media_image']['name'];
    $tmp_name = $_FILES['media_image']['tmp_name'];
    $destination = "images/" . $image_name;

    if (empty($media_name) || empty($media_link) || empty($image_name)) {
        echo "<script>alert('Empty fields');</script>";
    } else {
        // Check if the media link already exists
        $sql = mysqli_query($con, "SELECT * FROM media_links WHERE media_name='$media_name' OR media_link='$media_link'");
        if ($sql) {
            $num = mysqli_num_rows($sql);
            if ($num > 0) {
                echo "<script>alert('Media link already exists!!');</script>";
            } else {
                // File Upload Handling
                if (move_uploaded_file($tmp_name, $destination)) {
                    $insert_query = mysqli_query($con, "INSERT INTO media_links (media_name, media_link, media_image) VALUES ('$media_name', '$media_link', '$image_name')");
                    if ($insert_query) {
                        echo "<script>alert('Media link inserted successfully');</script>";
                        header('location: media-links.php');
                        exit(); // Added exit to stop further execution
                    } else {
                        echo "<script>alert('Failed to upload media link, please try again');</script>";
                    }
                } else {
                    echo "<script>alert('File upload failed');</script>";
                }
            }
        } else {
            echo "<script>alert('Database error');</script>";
        }
    }
} else {
    echo "<script>alert('Error !! Something wrong happened, please try again');</script>";
}
?>

<?php include('includes/header.php'); ?>
<main>
    <div>
        <br><br><br>
        <?php include('includes/sidebar.php'); ?>
    </div>
    <form action="add-media-links.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="media-name">MEDIA NAME</label>
            <input type="text" name="media_name" id="media-name" placeholder="Enter Media Name">
        </div>
        <div class="form-group">
            <label for="link">MEDIA LINK</label><br>
            <input type="text" name="media_link" id="link" placeholder="Enter media link">
        </div>
        <div class="form-group">
            <label for="image">MEDIA IMAGE</label>
            <input type="file" name="media_image" id="image" accept="image/*" placeholder="Enter media image">
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Submit">
        </div>
    </form>
</main>
<?php include('includes/footer.php'); ?>
