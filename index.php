<?php require_once "connection/connection.php" ?>
<?php require_once "modules/header.php" ?>
<?php require_once "modules/navigation.php" ?>
<div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
<?php 

if(isset($_GET["page"])){
$page = $_GET["page"];
}else{
    $page = "";
}
if ($page == "" || $page == 1){
    $page_1 = 0;
}else{
    $page_1 = ($page * 2) - 2 ;

}

global $connect,$tbl_posts;
$select_post_count = "SELECT * FROM $tbl_posts WHERE `post_status` = 'published' "; 
$result = $connect->prepare($select_post_count);
    $result->execute();
  $count = $result->rowCount();
$count = ceil($count / 2) ;





function posts(){
global $connect,$tbl_posts,$page_1;
$sql = ("SELECT * FROM $tbl_posts WHERE `post_status` = 'published' LIMIT $page_1 ,2 ");
$result = $connect->prepare($sql);
    $result->execute();
    if($result->rowCount()){
        return $result;
    }
    return false;
}

$row = posts()->fetchAll(PDO::FETCH_ASSOC);
foreach ($row as $rows){ 
 $post_id = $rows["post_id"];
 $post_title = $rows["post_title"];
 $post_author = $rows["post_author"];
 $post_date = $rows["post_date"];
 $post_image = $rows["post_image"];
 $post_content = substr($rows["post_content"],0,200);
 $post_status = $rows["post_status"];
 if($post_status !== 'published'){


echo "<h1> NO post here </h1>";


 }
 else{
?>

    <!-- Page Content -->
  

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
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                 <img class="img-responsive" src="images/<?php
                echo $post_image
                ?>" alt="">   
                </a>
                
                <hr> 
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

<?php } }?>

                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="<?php
                  if(isset($_GET["page"])){
$page = $_GET["page"] - 1;
echo "./index.php?page=$page";

                  }else{
                    echo "./index.php";
                  }
                        ?>
                        ">&larr; Older</a>
                    </li>
           <?php
 
for ($i = 1; $i <= $count; $i++){
if (isset($_GET["page"])) {
    $page = $_GET["page"];
    }
     if($i == $page ){
        echo "<li><a class='active' href='./index.php?page=$i'>$i</a></li>";

    }else{
    echo "<li><a href='./index.php?page=$i'>$i</a></li>";
        
    }

   

}

           ?>
                    <li class="next">
                        <a href="<?php
                  if(isset($_GET["page"])){
$page = $_GET["page"] + 1;
echo "./index.php?page=$page";

                  }else{
                    echo "./index.php?page=2";
                  }

             
                        ?>">Newer &rarr;</a>
                    </li>
                </ul>
             </div>

            <!-- Blog Sidebar Widgets Column -->
            
            <?php require_once "modules/sidebar.php" ?>

        </div>
        <!-- /.row -->
        <hr>
           
        <?php require_once "modules/footer.php" ?>

