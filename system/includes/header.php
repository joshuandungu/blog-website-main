<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WORLD NEWS BLOG</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="container">
        <header>
            <h1 style="font-size:100px; font-family:'Times New Roman', Times, serif;color:red">WORLD NEWS BLOG</h1>

        </header>
        <nav>
            <?php
            if (isset($_SESSION['userid'])) {
                include 'connection.php';
            ?>
                <a class="active" href="index.php">Home</a>
                <a href="add-blog.php">Add Blog</a>
                <a href="blog-posts.php">Recent Blog Posts</a>
                <a href="manage-blogs.php">My Blogs</a>
                <a href="contact.php">Contact us</a>
                <a href="profile.php"><h3 style="color:gold; font-weigt:bold; font-size:30px; text-decoration:solid;"><?php echo $_SESSION['useRID']; ?>My Account </h3></a>
                <a href="logout.php">logout</a>
            <?php }?>
            <?php
            if (!isset($_SESSION['userid'])) {
            ?>
                <a href="signup.php">Signup</a>
                <a href="login.php">Login</a>
                <a href = "./admin/login.php">Admin</a>
            <?php } ?>
        </nav>