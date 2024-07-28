<?php 
session_start();
error_reporting(0);
if(!isset($_SESSION['admin'])){
    header('location:login.php');
}
?>

<?php 
if(isset($_GET['delid'])){
    include ('includes/connection.php');
    $delid= $_GET['delid'];
    $sql=mysqli_query($con,"DELETE * FROM users where userid ='$delid'");
    if($sql){
        echo "<script>alert('User Deleted Successfully');</script>";
        header('location:manage-users.php');
    }
    else {
        echo "<script>alert('Failed to delete, something went wrong');</script>";
    }
}
?>
<?php include ('includes/header.php');?>
<main><br><br><br><br><br>
    <div>
        <?php include('includes/sidebar.php');?>
    </div>
    
    <table>
            <thead>
                <tr>
                <th>#</th>
                <th>FIRSTNAME</th>
                <th>LASTNAME</th>
                <th>EMAIL</th>
                <th>USERNAME</th>
                <th>ACTION</th>
                </tr></thead> <tbody>
    <?php 
    include ('includes/connection.php');
    $sql=mysqli_query($con,"SELECT * FROM users");
    $cnt= 1;
    while($row=mysqli_fetch_array($sql)){
        ?> 
           
                <tr><th scope="row"><?php echo $cnt; ?></th>
                <td><?php echo $row['firstname'];?></td>
                <td><?php echo $row['lastname'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['username'];?></td>
                <td><a href="manage-users.php?delid=<?php echo $row['userid'];?>" Onlick="return confirm('Are you sure you want to delete this user account')"> DELETE</a></td>
            </tr>
            <?php $cnt = $cnt +1; }  ?>
            </tbody>
        </table>
   

    
</main>
<?php include ('includes/footer.php');?>

