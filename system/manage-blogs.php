<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['userid'])) {
    header('location: login.php');
}
?>

<?php
include('includes/connection.php');

if (isset($_GET['delid'])) {
    $delid = $_GET['delid'];
    $sql = mysqli_query($con, "DELETE FROM blogs WHERE blog_id='$delid'");
    if ($sql) {
        echo "<script>alert('The blog was deleted successfully');</script>";
        header('manage-blogs.php');
    } else {
        echo "<script>alert('Failed to delete blog, please try again');</script>";
    }
}
?>
<div class="container">
<?php include ('includes/header.php');?>
<div class="sidebar"><?php include ('includes/sidebar.php');?></div>   
<div class="aside"><?php include ('includes/aside.php');?></div>
<main>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>IMAGE</th>
                <th>BLOG TITLE</th>
                <th>BLOG CAT</th>
                <th>DESCRIPTION</th>
                <th>UPLOADED DATE</th>
                <th>ACTION</th>
                <th>STATUS</th>
                
            </tr>
        </thead>

        <?php
        if (isset($_SESSION['userid'])) {
            $user = $_SESSION['userid'];
            $sql = mysqli_query($con, "SELECT * FROM blogs where uploader='$user'");
            $cnt = 1;
            while ($row = mysqli_fetch_array($sql)) {
                $status= $row['status'];
        ?>
                <tbody>
                    <tr>
                        <th scope="row"><?php echo $cnt; ?></th>
                        <td><img src="images/<?php echo $row['blog_image']; ?>" width="50px" height="50px"></td>
                        <td><?php echo $row['blog_title']; ?></td>
                        <td><?php echo $row['blog_cat']; ?></td>
                        <td><textarea rows="8" cols="7"><?php echo $row['details']; ?></textarea></td>
                        <td><?php echo $row['uploaded_date']; ?></td>
                        <td>
                            <button><a href="update-blogs.php?updateid=<?php echo $row['blog_id']; ?>" onclick="return confirm('Are you sure you want to update this blog')">Update</a></button>
                            <button><a href="manage-blogs.php?delid=<?php echo $row['blog_id']; ?>" onclick="return confirm('Are you sure you want to delete this blog')">Delete</a></button>
                        </td>
                        <td><?php if ($status == 0)
                         {
                            echo '<p style="color:red;">Waiting approval</p>';
                        }
                        else 
                        {
                            echo '<p style="color:green;">Approved</p>';   
                        }
                        ?></td>
                    </tr>
                </tbody>
        <?php
                $cnt++;
            }
        } else {
            echo '</table>';
            echo '<p style="color: purple; font-size: 20px; font-weight: bold; text-decoration: none;">';
            echo '<a href="add-blog.php">No blogs uploaded</a>';
            echo '</p>';
            echo '<button><a href="add-blog.php">Add Blog</a></button>';
        }
        ?>
    </table>
</main>
<?php include('includes/footer.php'); ?>
