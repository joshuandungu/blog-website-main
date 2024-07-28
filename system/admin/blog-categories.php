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
    $delete = mysqli_query($con, "DELETE  FROM  blog_cat  WHERE cat_id='$delid'");
    if($delete){
        echo "<script>alert('Blog category deleted successfully');</script>";
        header('location:blog-categories.php');
    }
    else {
        echo "<script>alert('Failed to delete, somethig went wrong please try again');</script>";
    }

}
?>
<?php include ('includes/header.php');?>
<br><br><br><br><br>
<main>
<div> <?php include ('includes/sidebar.php');?> </div>
<table>
            <thead><tr>
                <th>#</th>
                <th>Blog Category</th>
                <th>Update </th>
                <th>Delete</th>
                </tr>
            </thead>
<?php 
include ('includes/connection.php');
    $query=mysqli_query($con, "SELECT * FROM blog_cat");
    $cnt=1;
    while($row=mysqli_fetch_array($query)){
        ?>
            <tbody>
                <tr>
            <th scope="row"><?php echo $cnt; ?></th>
            <td><?php echo $row['cat_title'];?></td>
            <td><button onclick="return confirm('Are you sure you want to update')"> <a href="update-blog-cat.php?updateid=<?php echo $row['cat_id'];?>">Update</a></button></td>
            <td><button onclick="return confirm('Are you sure you want to delete')"> <a href="blog-categories.php?delid=<?php echo $row['cat_id'];?>">Delete</a></button></td>
                </tr> <?php  $cnt=$cnt+1;} ?>
            </tbody>
        </table>
        
    </main>
    <?php include ('includes/footer.php');?>
