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
    <br>
<table>
    <thead>
        <tr>
            <th>FIRST NAME</th>
            <th>LAST NAME</th>
            <th>EMAIL</th>
            <th>USERNAME</th>
            <th>PASSWORD</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <?php 
include ('includes/connection.php');
$user = $_SESSION['userid'];
$cnt = 1;
$sql=mysqli_query($con,"select * from users where email='$user' ");
while($row=mysqli_fetch_assoc($sql)){
    ?>
    <tbody>
        <td><?php echo $row['firstname'];?>
        <td><?php echo $row['lastname'];?>
        <td><?php echo $row['email'];?>
        <td><?php echo $row['username'];?>
        <td><?php echo $row['password'];?>
        <td><button class="btn" onclick="return confirm('Are you sure you want to update');"><a href="update-profile.php?updateid=<?php echo $row['userid'];?>">Update</a></button></td>
    </tbody>
<?php } $cnt= $cnt +1; ?>

</table>
</main>
   <?php include ('includes/footer.php'); ?>


   

   