<?php
if(isset($_GET["p_id"])){
    $the_post_id = $_GET["p_id"];
}
function editPosts(){
    $the_post_id = $_GET["p_id"];
    global $connect, $tbl_posts;
    $query = "SELECT * FROM $tbl_posts WHERE `post_id` = $the_post_id";
    $result = $connect->prepare($query);
    $result->execute();
    if($result->rowCount()){
        return $result;
    }
    return false;
   

}

$row = editPosts()->fetchAll(PDO::FETCH_ASSOC);
foreach($row as $rows ){
$post_id = $rows["post_id"];
$post_category_id = $rows["post_category_id"];
$post_title = $rows["post_title"];
$post_author = $rows["post_author"];
$post_date = $rows["post_date"];
$post_image = $rows["post_image"];
$post_content = $rows["post_content"];
$post_tags = $rows["post_tags"];
$post_comment_count = $rows["post_comment_count"];
$post_status = $rows["post_status"];


}

if(isset($_POST["create_post"])){
 
    $the_post_id       = $_GET["p_id"];
    $post_title        = $_POST['post_title'];
    $post_author       = $_POST['post_author'];
    $post_category_id  = $_POST['post_category'];
    $post_status       = $_POST['post_status'];
    $post_image        = $_FILES['image']['name'];
    $post_image_temp   = $_FILES['image']['tmp_name'];
    $post_tags         = $_POST['post_tags'];
    $post_content      = $_POST['post_content'];
    date_default_timezone_set('Asia/Tehran');
    $post_date         = date('d-m-y');
    // $post_comment_count = 5;

     move_uploaded_file($post_image_temp,"../images/$post_image");

     if(empty($post_image)){
     $the_post_id = $_GET["p_id"];
        global $connect, $tbl_posts;
        $query = "SELECT * FROM $tbl_posts WHERE `post_id` = $the_post_id";
        $result = $connect->prepare($query);
        $result->execute();

         
   
  
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $post_image = $row["post_image"];
    }



     global $connect, $tbl_posts;
     $query = "UPDATE $tbl_posts SET `post_title` = ?,`post_category_id` = ?,`post_date` = ?,`post_author` = ?,`post_status` = ?,`post_tags` = ?,`post_content` = ?,`post_image` = ? WHERE `post_id` = ?";
     $result = $connect->prepare($query);
     $result->bindValue(1,$post_title);
     $result->bindValue(2,$post_category_id);
     $result->bindValue(3,$post_date);
     $result->bindValue(4,$post_author);
     $result->bindValue(5,$post_status);
     $result->bindValue(6,$post_tags);
     $result->bindValue(7,$post_content);
     $result->bindValue(8,$post_image);
     $result->bindValue(9,$the_post_id);
     $result->execute();
    
?>
  <script>
         Swal.fire({
            title: 'Done',
            text: 'your post successfully updated',
            icon: 'success',
            confirmButtonText: 'Ok'
          })
         </script> 
     
<?php

     if($result->rowCount()){
         return $result;
        
     }
     return false;



}

?>




<form action="" method="post" enctype="multipart/form-data">     
    <div class="form-group">
         <label for="title">Post Title</label>
          <input type="text" class="form-control" value="<?php echo $post_title; ?>"  name="post_title">
      </div>
         <div class="form-group">
       <label for="category">Category</label>
       <select name="post_category" class="form-control" id="post_category">
<?php
function selectCat(){
    global $connect, $tbl_cat;
 $cat_id = $_GET["edit"]; 
 $query = "SELECT * FROM $tbl_cat ";
 $result = $connect->prepare($query);
 $result->execute();
 if($result->rowCount()){
     return $result;
 }
  return false;
  }
$row = selectCat()->fetchAll(PDO::FETCH_ASSOC);
foreach($row as $rows ){
 $cat__title = $rows["cat_title"];
 $cat__id = $rows["cat_id"];
?>
<option value='<?php echo $cat__id ?>'><?php echo $cat__title  ?></option>
 

<?php } ?>
       </select>
       </div>

       <!-- <div class="form-group">
       <label for="users">Users</label>
       <input type='text'  name="post_user" id="">
      </div> -->

      <div class="form-group">
         <label for="title">Post Author</label>
          <input type="text" value="<?php echo $post_author; ?>" class="form-control" name="post_author">
      </div>
       <div class="form-group">
         <select class="form-control" name="post_status" id="">
             <option value="published">Published</option>
             <option value="draft">Draft</option>
         </select>
      </div>
      
      
      
    
      <div class="form-group">
         <label for="post_image">Post Image</label>
          <img src="../images/<?php echo $post_image ?>" width="100" height="auto" alt="">
          <input type="file"  name="image">

      </div>

      <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input type="text" class="form-control" value="<?php echo $post_tags; ?>" class="form-control" name="post_tags">
      </div>
      
      <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea class="form-control "name="post_content" id="" cols="30" rows="10">
         <?php echo $post_content; ?>
         </textarea>
      </div>
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_post" value="update Post">
      </div>


</form>