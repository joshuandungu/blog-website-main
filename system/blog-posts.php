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
    

        <?php 
        include ('includes/connection.php');
        $sql=mysqli_query($con, "SELECT * FROM blogs WHERE status = '1'");
        $cnt= 1;
        while($row=mysqli_fetch_array($sql)){
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
            </a>

        <?php } ?>
        


    </main>
    <?php include ('includes/footer.php');?>

