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
        if(isset($_GET['viewid'])){
            $viewid=$_GET['viewid'];
        $sql=mysqli_query($con, "SELECT * FROM blogs WHERE blog_id='$viewid'");
        $cnt= 1;
        while($row=mysqli_fetch_array($sql)){
            $cat = $row['cat_title'];
            $blog_id = $row['blog_id'];
            ?>
            <div class="view-box">
            <img src="images/<?php echo $row['blog_image'];?>" width="300px" height="300px">
            <h2 style="color:black; font-weight:bold; text-decoration:none; font-family:arial;"><?php echo $row['blog_title'];?></h2>
            <h4 style="color:black; font-weight:bold; text-decoration:none; font-family:arial;"><a href="specific-blogs.php?ownerid=<?php echo $row['uploader'];?>">By<?php echo $row['uploader'];?></a></h4>
            <h4 style="color:black; font-weight:bold; text-decoration:none; font-family:arial;"><?php echo $row['uploaded_date'];?></h4>
            <h3 style="color:black; font-weight:bold; text-decoration:none; font-family:arial;"><?php echo $row['blog_cat'];?></h3>
            
            <textarea rows="25" cols="50" style="resize:none; overflow:scroll;"><?php echo $row['details'];?></textarea>
            </div>

        <?php }  }?>
         <br><br>

         <h2 style=" margin-left:130px;font-weight: 100; font-size:20px; color:goldenrod; background-color:black; text-align:center; text-decoration:underline; width:auto; height:auto
         ;">Related Posts</h2>

        <?php 
        include ('includes/connection.php');
        $sql=mysqli_query($con, "SELECT * FROM blogs WHERE cat_title = '$cat' && blog_id != '$blog_id' AND  status = '1' ");
        $cnt= 1;
        while ($row = mysqli_fetch_array($sql)) {
            ?>
                <!-- <div class="floating-box" style="height: 500px;"> -->
                    <a href="view-blog.php?viewid=<?php echo $row['blog_id']; ?>">
                        <div class="img">
                            <img src="images/<?php echo $row['blog_image']; ?>" width="250px" height="80px">
                            <h2 style="color: black; font-weight: bold; text-decoration: none; font-family: arial;">
                                <?php echo $row['blog_title']; ?>
                            </h2>
                            <h3 style="color: black; font-weight: bold; text-decoration: none; font-family: arial;">
                                <?php echo $row['blog_cat']; ?>
        
                            </h3>
                            <h3 style="color: black; font-weight: bold; text-decoration: none; font-family: arial;">
                                <?php echo $row['cat_title']; ?>
        
                            </h3>
                            <h4 style="color: black; font-weight: bold; text-decoration: none; font-family: arial;">
                                <?php echo $row['uploaded_date']; ?>
                            </h4>
                            </h3>
                            
                        </div>
                    </a>
            <?php
            }
            ?>
        


    </main>
    <?php include ('includes/footer.php');?>
    </div>

