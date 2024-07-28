<?php
session_start();
error_reporting(0);

if (!isset($_SESSION['admin'])) {
    header('location: login.php');
}

include('includes/connection.php');

if (isset($_GET['delid'])) {
    $delid = $_GET['delid'];
    $sql = "DELETE FROM blogs WHERE blog_id = '$delid'";
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Blog Deleted Successfully');</script>";
        header('location: manage-users.php');
    } else {
        echo "<script>alert('Failed to delete, something went wrong');</script>";
    }
}

if (isset($_GET['approve-id'])) {
    $cid = $_GET['approve-id'];
    $status = 1;
    $update = "UPDATE blogs SET status = '$status' WHERE blog_id = '$cid'";
    if (mysqli_query($con, $update)) {
        echo "<script>alert('Blog approved, status set to 1');</script>";
    } else {
        echo "<script>alert('Failed to approve, please try again');</script>";
    }
}
?>

<?php include('includes/header.php'); ?>
<main>
    <br><br><br><br><br>
    <div>
        <?php include('includes/sidebar.php'); ?>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>OWNER</th>
                <th>IMAGE</th>
                <th>BLOG TITLE</th>
                <th>BLOG CATEGORY</th>
                <th>DATE UPLOADED</th>
                <th>DETAILS</th>
                <th>ACTION</th>
                <th>STATUS</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = mysqli_query($con, "SELECT * FROM blogs WHERE status = '0'");
            $cnt = 1;
            while ($row = mysqli_fetch_array($sql)) {
                $status = $row['status'];
            ?>
                <tr>
                    <th scope="row"><?php echo $cnt; ?></th>
                    <td><?php echo $row['uploader']; ?></td>
                    <td><img src="./images/<?php echo $row['blog_image']; ?>" width="50px" height="50px"></td>
                    <td><?php echo $row['blog_title']; ?></td>
                    <td><?php echo $row['blog_cat']; ?></td>
                    <td><?php echo $row['uploaded_date']; ?></td>
                    <td>
                        <textarea rows="5" cols="5" style="resize:none; overflow:scroll;"><?php echo $row['details']; ?></textarea>
                    </td>
                    <td>
                        <a href="update-blog.php?updateid=<?php echo $row['blog_id']; ?>" Onlick="return confirm('Are you sure you want to update this blog')"> Update</a><br>
                        <a href="manage-blogs.php?delid=<?php echo $row['blog_id']; ?>" Onlick="return confirm('Are you sure you want to delete this blog')"> Delete</a>
                    </td>
                    <td>
                        <?php if ($status == NULL || $status == 0) { ?>
                            <p><a href="approved-blogs.php?approve-id=<?php echo $row['blog_id']; ?>">Not approved</a></p>
                        <?php } else { ?>
                            <p>Approved</p>
                        <?php } ?>
                    </td>
                </tr>
            <?php
                $cnt++;
            }
            ?>
        </tbody>
    </table>
</main>
<?php include('includes/footer.php'); ?>
