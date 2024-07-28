<?php  
session_start();
error_reporting(0);
if(!isset($_SESSION['admin'])){
    header('location:login.php');
}
?>

<?php include('includes/header.php');?>

<?php
require_once('includes/connection.php');



$numUsers = mysqli_query($con, " SELECT * FROM users");
$numBlogs = mysqli_query($con, " SELECT * FROM blogs");
$numActiveBlogs = mysqli_query($con, " SELECT * FROM blogs", "WHERE status = '1'");
$numInactiveBlogs = mysqli_query($con, " SELECT * FROM blogs", "WHERE status = '0'");
$nummessages = mysqli_query($con, " SELECT * FROM contact_messages");
?>
<br>

<main>
    <div>
        <br><br><br>
        <?php include('includes/sidebar.php');?>
    </div>

    <div>
        <?php include('includes/asidebar.php');?>

        <a href="manage-users.php">
            <div class="floating-box">
                <h3>TOTAL USERS</h3> <br>
                <?php echo $numUsers;?>
            </div>
        </a>

        <a href="manage-blogs.php">
            <div class="floating-box">
                <h3>TOTAL BLOGS</h3> <br>
                <?php echo $numBlogs;?>
            </div>
        </a>

        <a href="manage-users.php">
            <div class="floating-box">
                <h3>ACTIVE BLOGS</h3> <br>
                <?php echo $numActiveBlogs;?>
            </div>
        </a>

        <a href="manage-users.php">
            <div class="floating-box">
                <h3>UN-ACTIVE BLOGS</h3> <br>
                <?php echo $numInactiveBlogs;?>
            </div>
        </a>
        <a href="contact-queries.php">
            <div class="floating-box">
                <h3>CONTACT QUERIES</h3> <br>
                <?php echo $nummessages;?>
            </div>
        </a>
    </div>
</main>

<?php include('includes/footer.php');?>
