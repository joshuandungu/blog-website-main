<?php
$login=0;
$invalid=0;

if($_SERVER['REQUEST_METHOD']=='POST'){
     include ('includes/connection.php');
     $email=$_POST['email'];
     $password=$_POST['password'];

     $sql="select * from admin where email='$email' and password='$password'";
     $result=mysqli_query($con,$sql);
     if($result){
        $num=mysqli_num_rows($result);
        if($num>0){
            $login=1;
            session_start();
            $_SESSION['admin']= $email;
            header('location:index.php');

        }
        else{
          $invalid=1;
          header('location:login.php');
        } 
     }   
}

?>

<?php 

if($invalid){
    echo'<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong> <center> Oh no sorry</strong> invalid credentials</center> <button type="button"  class="close" data_dismiss="alert" aria-label="close">
    <span aria-hidden="true"></span>
    </button
    </div>';
     }
    ?>

<?php 

if($login){
    echo'<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>You have successfully logged in </strong>  <button type="button"  class="close" data_dismiss="alert" aria-label="close">
    <span aria-hidden="true"></span>
    </button
    </div>';}

?>
<?php include ('includes/header.php');?>
<br><br><br><br>
<main>
    <!-- Your login form HTML here -->
    <form action="login.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="email">EMAIL</label>
            <input type="email" name="email" id="email" placeholder="Enter your Email" required><hr>
        </div>
        <div class="form-group">
            <label for="password">PASSWORD</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required><br>
            <button type="submit" name="submit" value="login">Login</button>
        </div>
    </form>
    
    <button><a href="signup.php">Signup</a></button><hr>
   <button> <a href="forgot-password.php">Forgot Password</a></button>
   <button> <a href="../login.php">Back Home</a></button>
</main>

<?php include('includes/footer.php'); ?>
