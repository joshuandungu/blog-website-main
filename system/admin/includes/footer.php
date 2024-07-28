

<footer>
        <div class="footer-container">
            <div class="footer-logo">
                <img src="logo.png" alt="Company Logo">
                <h1>Company Name</h1>
            </div>
            <div class="footer-links">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manage-blogs.php">Manage Blogs</a></li>
                    <li><a href="media-links.php">Media Links</a></li>
                    <li><a href="blog-posts.php">Recent Posts</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            <?php include ('connection.php');
            $ret=mysqli_query($con," SELECT * FROM media_links");
            $cnt = 1;
            while($row=mysqli_fetch_array($ret)){
                ?>
            <div class="footer-social">
                <a href="<?php echo $row['media_link'];?>"><img src="images/<?php echo $row['media_image'];?>" width="50px" height="50px" alt="<?php echo $row['media_name'];?>" target="_blank"><br>
                <h4><?php echo $row['media_name'];?></a>
            </div>
        </div>
        <?php } ?>
        <div class="footer-info">
            <p>&copy; 2023 Company Name. All Rights Reserved.</p>
            <p>123 Street Address, City, Country</p>
            <p>Email: info@example.com</p>
        </div>

    </footer>
    </div>
    
    
</body>
</html>