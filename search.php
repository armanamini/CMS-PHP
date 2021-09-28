<?php require_once "connection/connection.php" ?>
<?php require_once "modules/header.php" ?>
<?php require_once "modules/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <?php 
    global $connect,$tbl_posts;
    if(isset($_POST["submit"])){
        $search = $_POST["search"]; 
       $sql = ("SELECT * FROM $tbl_posts WHERE `post_tags` LIKE '%$search%' ");
       $result = $connect->prepare($sql);
       $result->execute();
       if($result->rowCount() >= 1){
        $row = $result->fetchAll(PDO::FETCH_ASSOC);
        ?>
       <?php foreach ($row as $rows){
         $post_tile = $rows["post_title"];
         $post_author = $rows["post_author"];
         $post_date = $rows["post_date"];
         $post_image = $rows["post_image"];
         $post_content = $rows["post_content"];
         ?>   
         
                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>
                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?php echo $post_tile?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo  $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php
                        echo $post_image
                        ?>" alt="">
                        <hr>
                        <p><?php echo $post_content ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                        <hr>


                          <?php }  ?>

   <?php
    }
      else{
         echo "<h1>NO RESULT</h1>"; 
      } 
    }
    ?>






























                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            
            <?php require_once "modules/sidebar.php" ?>

        </div>
        <!-- /.row -->
        <hr>

        <?php require_once "modules/footer.php" ?>

