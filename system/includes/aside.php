<div class="aside">

<form style="margin-right:5px; width: 150px; height: 200px;" class="form-search" action="./index.php" method="GET">
<h2 style="margin-left:23px; font-style: oblique; font-weight:bold;text-decoration:aliceblue; float:center;">SEARCH</h2>
        <input type="text" placeholder="Search..." name="search">
        <button style="width:141px" class = "search_button.button" type="submit" name="submit" value="search">Search</button>
    </form>
    <hr><br><br>
<h3 style="margin-left: 30px; font-style: oblique; font-size:18px; font-weight:bold;text-decoration:aliceblue; float:center;">RECENT POSTS</h3>

<?php 
        include ('connection.php');
        $sql=mysqli_query($con, "SELECT * FROM blogs WHERE status = '1' ORDER BY blog_id  DESC LIMIT 4");
        $cnt= 1;
        while($row=mysqli_fetch_array($sql)){
            ?>
            <a href="./view-blog.php?viewid=<?php echo $row['blog_id'];?>">
            <div class="img"> <img src="./images/<?php echo $row['blog_image'];?>" width="25px" height="30px">
            <h4 style="margin-left:30px;color:black; font-weight:bold; text-decoration:none; font-family:arial;"><?php echo $row['blog_title'];?></h4>
        </div>
            </a>

        <?php } ?>
</div>