<?php  
session_start();
error_reporting(0);
if(!isset($_SESSION['admin'])){
    header('location:login.php');
}
?>


<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include ('includes/connection.php');
    // Get values from the form
    $company_name = $_POST['company_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $about = $_POST['about'];

    // Handle file upload for the company logo
    $file_name = $_FILES['logo']['name'];
    $file_tmp = $_FILES['logo']['tmp_name'];
    $file_destination = "uploads/" . $file_name;

    if (move_uploaded_file($file_tmp, $file_destination)) {
        // File uploaded successfully
        // Insert data into the database
        $sql = "INSERT INTO about-us (company_name, email, address, about, logo) 
                VALUES ('$company_name', '$email', '$address', '$about', '$file_name')";

        if ($conn->query($sql) === TRUE) {
            // Data inserted successfully
            echo "<script>alert('Data inserted successfully');</script>";
        } else {
            // Error inserting data
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // File upload failed
        echo "<script>alert('Failed to upload');</script>";
    }

    // Close the database connection
    $conn->close();
}
?>


<?php include ('includes/header.php');?>
    <main>
        <div>
            <br><br><br>
        <?php include ('includes/sidebar.php');?>
        </div>
         <?php 
        include  ('includes/connection.php');
        $sql=mysqli_query($con,"SELECT * FROM about_us");
        $cnt= 1;
        while($row=mysqli_fetch_array($sql)){
        ?>
            <h1> More details about your company</h1>
            <form action="about-us.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                <label for="company-name">COMPANY NAME</label>
                <input type="text" name="company_name" placeholder="Enter your company name" id="company-name" required>
                </div>
                <div class="form-group">
                <label for="company-email">COMPANY EMAIL</label>
                <input type="email" name="email" placeholder="Enter your company name" id="company-email" required>
                </div>
                <div class="form-group">
                <label for="company-address">COMPANY ADDRESS></label>
                <input type="text" name="address" placeholder="Enter your company address" id="company-address" required>
                </div>
                <div class="form-group">
                <label for="about-us">COMPANY BACKGROUND</label>
                <textarea rows="10" cols="5" style="resize:none; background-color:beige;" input type="text" name="about" placeholder="Give background information about your company" id="about-us" required>
                </div>
                <div class="form-group">
                <label for="company-logo">COMPANY logo</label>
                <input type="file" name="logo" placeholder="Upload your company logo" id="company-logo" required>
                </div>
                <div class="form-group">
                <button > <input type="submit" value="submit" name="submit">Submit</button>
                </div>
            </form>
            


        <?php } ?>

        
        
    </main>
    <?php include ('includes/footer.php');?>
