<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
</head>
<body>

<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['userid'])) {
    header('location:login.php');
}

include('includes/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($con, $_POST["name"]);
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $message = mysqli_real_escape_string($con, $_POST["message"]);

    // Validate form data
    if (empty($name) || empty($email) || empty($message)) {
        echo "<script>alert('Please fill in all the fields.');</script>";
    } else {
        // Insert data into the database
        $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";

        if (mysqli_query($con, $sql)) {
            echo "<script>alert('Thank you for contacting us!');</script>";
        } else {
            echo "<script>alert('Failed, something wrong happened. Please try again later.');</script>";
        }
    }
}

?>
<div class="container">
<?php include ('includes/header.php');?>
<div class="sidebar"><?php include ('includes/sidebar.php');?></div>   
<div class="aside"><?php include ('includes/aside.php');?></div>

<main>
    
    <div style="margin-left: 250px; margin-top: 20px; border: 3px solid black; width: 500px;">
        <h1>Contact Us</h1>
        <?php 
        if(isset($_SESSION['userid'])){
            $user = $_SESSION['userid'];
            $query=mysqli_query($con, "SELECT * FROM users WHERE email ='$user'");
            while($row=mysqli_fetch_array($query)){
        ?>
        <form action="contact.php" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $row['firstname'] . ' ' . $row['lastname'];?>" class="form-control" required readonly>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo $row['email'];?>" class="form-control" required readonly>

            <label for="message">Message:</label>
            <textarea name="message" rows="4" class="form-control" required></textarea>

            <input type="submit" value="Submit">
        </form>
        <?php 
            }
        }
        ?>
    </div>
</main>

<?php
include('includes/footer.php');
mysqli_close($con); // Close the database connection
?>

</body>
</html>
