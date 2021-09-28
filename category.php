<?php require_once "connection/connection.php" ?>
<?php require_once "modules/header.php" ?>
<?php require_once "modules/navigation.php" ?>
<?php 

if(isset($_GET["category"])){

$the_cat_id = $_GET["category"];

}
function categoriess(){
$the_cat_id = $_GET["category"];
global $connect,$tbl_posts;
$sql = ("SELECT * FROM $tbl_posts WHERE `post_category_id` = $the_cat_id");
$result = $connect->prepare($sql);
    $result->execute();
    if($result->rowCount()){
        return $result;
    }
    echo "<h2> NOTHING FOUND SORRY.. </h2>";
}

$row = categoriess()->fetchAll(PDO::FETCH_ASSOC);
foreach ($row as $rows){ 
 $post_id = $rows["post_id"];
 $post_title = $rows["post_title"];
 $post_author = $rows["post_author"];
 $post_date = $rows["post_date"];
 $post_image = $rows["post_image"];
 $post_content = substr($rows["post_content"],0,200);
?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title?></a>
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
<?php } ?>
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

