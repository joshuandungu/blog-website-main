<?php  
session_start();
error_reporting(0);
if(!isset($_SESSION['admin'])){
    header('location:login.php');
}
?>


<?php


if (isset($_POST['submit'])) { // Changed 'submit'
    // require_once('includes/connection.php');
    require_once('includes/connection.php');
    $blog_cat = mysqli_real_escape_string($con, $_POST['blog_cat']); // Sanitize user input

    if (empty($blog_cat)) {
        echo "<script>alert('Empty field');</script>";
    } else {
        $sql = mysqli_query($con, "SELECT * FROM blog_cat WHERE cat_title='$blog_cat'");
        if ($sql) {
            $num = mysqli_num_rows($sql);
            if ($num > 0) {
                echo "<script>alert('Blog category already exists');</script>";
            } else {
                $cat_id= mt_rand(1000, 99999);
                $ret = mysqli_query($con, "INSERT INTO  blog_cat (cat_id, cat_title) VALUES( '$cat_id','$blog_cat')");
                if ($ret) {
                    echo "<script>alert('Blog category inserted successfully');</script>";
                    header('location: blog-categories.php');
                } else {
                    echo "<script>alert('Failed to insert blog category');</script>";
                }
            }
        } else {
            echo "<script>alert('Error in the SQL query: " . mysqli_error($con) . "');</script>"; // Handle SQL query error
        }
    }
}
?>

<?php include ('includes/header.php');?>
    <main>
        <div>
            <br><br><br>
        <?php include ('includes/sidebar.php');?>
        </div>
        <form action="add-blog-cat.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
            <label for="cat">Blog Category</label>
            <input type="text" name="blog_cat" id="cat" placeholder="Add blog category" required>
             </div>
             <div class="form-group">
             <button type="submit" name="submit" value="submit">Add</button>
              </div>
        </form>
        <div>
            <?php include ('includes/aside.php');?>

        </div>


    </main>
    <?php include ('includes/footer.php');?>
    
    
