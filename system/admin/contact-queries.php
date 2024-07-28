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
    $sql=mysqli_query($con,"DELETE * FROM contact_messages where id ='$delid'");
    if($sql){
        echo "<script>alert('Message Deleted Successfully');</script>";
        header('location:contact-queries.php');
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
                <th>NAME</th>
                <th>EMAIL</th>
                <th>MESSAGE</th>
                <th>ENQUIRY DATE</th>
                <th>ACTION</th>
                </tr></thead> <tbody>
    <?php 
    include ('includes/connection.php');
    $sql=mysqli_query($con,"SELECT * FROM contact_messages");
    $cnt= 1;
    while($row=mysqli_fetch_array($sql)){
        ?> 
           
                <tr><th scope="row"><?php echo $cnt; ?></th>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><textarea><?php echo $row['message'];?></textarea></td>
                <td><?php echo $row['sent_date'];?></td>
                <td><a href="manage-users.php?delid=<?php echo $row['id'];?>" Onlick="return confirm('Are you sure you want to delete this message')"> DELETE</a></td>
            </tr>
            <?php $cnt = $cnt +1; }  ?>
            </tbody>
        </table>
   

    
</main>
<?php include ('includes/footer.php');?>

