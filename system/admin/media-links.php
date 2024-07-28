<?php  
session_start();
error_reporting(0);
if(!isset($_SESSION['admin'])){
    header('location:login.php');
}
?>
<?php 
include ('includes/connection.php');
if(isset($_GET['delid'])){
    $delid= $_GET['delid'];
    $delete = mysqli_query($con, "DELETE  FROM  media_links  WHERE id='$delid'");
    if($delete){
        echo "<script>alert('Media Link deleted successfully');</script>";
        header('location:media-links.php');
    }
    else {
        echo "<script>alert('Failed to delete, somethig went wrong please try again');</script>";
    }

}
?>

<?php include ('includes/header.php');?>
    <main>
        <div>
            <br><br><br>
        <?php include ('includes/sidebar.php');?>
        </div>
       







        <div>
            <?php include ('includes/asidebar.php');?>
        </div>
       <h2 style="color:black; font-weight:bold;font-size:20px;"> <a href="add-media-links.php">Add New Media Link</a></h2>
        <table>
            <thead><tr>
                <th>#</th>
                <th>MEDIA IMAGE</th>
                <th>MEDIA NAME</th>
                <th>MEDIA LINK</th>
                <th>ACTION</th>
                <th><button><a href="add-media-links.php">Add New media link</a></button></th>
            </tr>
            </thead>
         <?php 
        include  ('includes/connection.php');
        $sql=mysqli_query($con,"SELECT * FROM media_links");
        $cnt= 1;
        while($row=mysqli_fetch_array($sql)){
        ?><tbody><tr>
            <th scope="row"><?php echo $cnt; ?></th>
            <td><img src="images/<?php echo $row['media_image'];?> " height="60px" weight="60px"></td>
            <td><?php echo $row['media_name'];?></td>
            <td><?php echo $row['media_link'];?></td>
            <td><button><a href="update-media-links.php?updateid=<?php echo $row['id'];?>" onlick="return confirm ('Are you sure you want to update media links');">Update</a></button></td>
            <td><button><a href="media-links.php?delid=<?php echo $row['id'];?>" onlick="return confirm ('Are you sure you want to delete media links');">Delete</a></button></td>
        </tr></tbody>


        <?php $cnt = $cnt++;
    }  ?>
        </table>

        
        
    </main>
    <?php include ('includes/footer.php');?>
