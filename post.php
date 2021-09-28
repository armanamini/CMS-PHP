<?php require_once "connection/connection.php" ?>
<?php require_once "modules/header.php" ?>
<?php require_once "modules/navigation.php" ?>
<?php 

if(isset($_GET["p_id"])){
    $the_post_id = $_GET["p_id"];
}



function posts(){
    $the_post_id = $_GET["p_id"];

global $connect,$tbl_posts;
$sql = ("SELECT * FROM $tbl_posts WHERE `post_id` = $the_post_id ");
$result = $connect->prepare($sql);
    $result->execute();
    if($result->rowCount()){
        return $result;
    }
    return false;
}

$row = posts()->fetchAll(PDO::FETCH_ASSOC);
foreach ($row as $rows){ 
 $post_tile = $rows["post_title"];
 $post_author = $rows["post_author"];
 $post_date = $rows["post_date"];
 $post_image = $rows["post_image"];
 $post_content = $rows["post_content"];
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



<?php } ?>

<?php


if(isset($_POST["create_comment"])){
    
    global $connect,$tbl_comments;
date_default_timezone_set("Asia/Tehran");
$the_post_id = $_GET["p_id"];
$comment_author = $_POST["comment_author"];
$comment_email = $_POST["comment_email"];
$comment_content = $_POST["comment_content"];


if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content) )   {
    $sql = "INSERT INTO $tbl_comments SET `comment_post_id` = ? , `comment_author` = ?,`comment_email` = ? , `comment_content` = ?,`comment_status` = ?,`comment_date` = ? ";
$result = $connect->prepare($sql);
$result->bindValue(1,$the_post_id);
$result->bindValue(2,$comment_author);
$result->bindValue(3,$comment_email);
$result->bindValue(4,$comment_content);
$result->bindValue(5,'unapproved');
$result->bindValue(6,date("Y-m-d,h:i:s"));
$result->execute();
    if($result->rowCount()){
        return $result;
    }
    return false;
    $query = "UPDATE posts SET `post_comment_count` = post_comment_count + 1 WHERE `post_id` = $the_post_id ";
$result = $connect->prepare($query);
$result->execute();
}else{
?>

<script>
 Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'please fill out fileds'

})
</script>
<?php
}


    }

?>


                   <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post" action="">
                    <div class="form-group">
                            <input type="text" class="form-control" name="comment_author" placeholder="name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control"
                            placeholder="Email"
                            name="comment_email">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="comment_content" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
<?php
function approveComment(){
        $the_post_id = $_GET["p_id"];
global $connect;
 $query = "SELECT * FROM comments WHERE `comment_post_id` = $the_post_id AND `comment_status` = 'Approved' ORDER BY `comment_id` DESC ";
 $result = $connect->prepare($query);
 $result->execute();
 if($result->rowCount()){
     return $result;
 }else{
    return false;
 }
}

 
 $row = approveComment()->fetchAll(PDO::FETCH_ASSOC);
 foreach ($row as $rows){
    $comment_author = $rows["comment_author"];
    $comment_email = $rows["comment_email"];
    $comment_date = $rows["comment_date"];
    $comment_content = $rows["comment_content"];
?>
    <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <p>
                        <?php echo $comment_content; ?>
                        </p>
                    </div>
 <?php } ?>











        
                
                </div>

            
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

        <?php require_once "connection/connection.php" ?>
<?php require_once "modules/header.php" ?>
<?php require_once "modules/navigation.php" ?>
