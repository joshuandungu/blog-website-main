<?php
session_start();
error_reporting(0);

if (!isset($_SESSION['userid'])) {
    header('location: login.php');
}

?>
<div class="container">
<?php include ('includes/header.php');?>
<div class="sidebar"><?php include ('includes/sidebar.php');?></div>
<div class="aside"><?php include ('includes/aside.php');?></div>
  
<main >
    <?php
    include('includes/connection.php');
    
    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $sql = "SELECT * FROM blogs WHERE (blog_title LIKE '%$search%' OR cat_title LIKE '%$search%' OR uploaded_date LIKE '%$search%' OR uploader LIKE '%$search') AND status = '1'";
    } elseif (isset($_GET['category'])) {
        $cat = $_GET['category'];
        $sql = "SELECT * FROM blogs WHERE cat_title = '$cat' AND status = '1'";
    } else {
        $sql = "SELECT * FROM blogs WHERE status = '1'";
    }

    $result = mysqli_query($con, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
    ?>
            <!-- <div class="view-box"> -->
                <a href="view-blog.php?viewid=<?php echo $row['blog_id']; ?>">
                    <div class = "view-box img">
                        <img src="images/<?php echo $row['blog_image']; ?>" width="400px" height="400px">
                        <div class ="view-box h1">
                        <h2 style="color: black; font-weight: bold; text-decoration: none; font-family: arial;">
                            <?php echo $row['blog_title']; ?>
                        </h2></div>
                    </div>
                    <!-- </div> -->
                </a>
    <?php
        }
    } else {
        echo "<h3 style='color:red;'>No blogs found.</h3>";
    }
    ?>
</main>

<?php include('includes/footer.php'); ?>
</div>
