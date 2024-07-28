<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WORLD NEWS BLOG</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <header>
            <h1 style="font-size:100px; font-family:'Times New Roman', Times, serif;color:red">WORLD NEWS BLOG</h1>

        </header>
    <nav>
        <?php 
        if(isset($_SESSION['admin'])){
            ?>
             <a class="active" href="index.php">Home</a>
            <a href="add-blog.php">Add Blog</a>
            <a href="manage-blogs.php">Manage Blogs</a>
            <a href="contact.php">Contact us</a>
            <a href="profile.php"><?php echo $_SESSION['admin'];?></a>
            <a href="logout.php">Logout</a>
       <?php }?>
       <?php 
       if(!isset($_SESSION['admin'])){
        ?>
            <a href="signup.php">Signup</a>
            <a href="login.php">Login</a>
            <a href = "../login.php">Main Website</a>
       <?php }?>
           
            
    </nav>
    <div class="search-bar">
        <!-- <div class="search">
        <form  class ="search" action="" method="POST" enctype="multipart/form-data">
            <input type="text" name="search"  placeholder="Enter something to serch">
            <button>Search</button>
        </form>
        </div> -->
    </div>