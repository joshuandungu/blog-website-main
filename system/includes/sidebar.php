<div class="sidebar" style="position:absolute; height:970px; ">
        <h2 style="font-style: oblique; font-size: 20px; font-weight: bold; text-decoration: aliceblue;">CATEGORIES</h2>
        <?php
        include('includes/connection.php');
        $query = mysqli_query($con, "SELECT * FROM blog_cat");
        $cnt = 1;
        while ($row = mysqli_fetch_array($query)) {
            $cat_id = $row['cat_id'];
            $blog_cat = $row['cat_title'];
        ?>
            <h6 style="  padding-left:20px; padding-right:20px;  padding-top:5px; inline: spacing 10px; font-size:20px; align-items:center; color: black; font-family: Arial, Helvetica, sans-serif; font-weight: bold">
                <a href="./index.php?category=<?php echo $blog_cat; ?>"><?php echo $blog_cat; ?></a>
            </h6>
        <?php
            $cnt = $cnt + 1;
        }
        ?>
    </div>
