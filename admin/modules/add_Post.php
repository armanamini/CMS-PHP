<?php require_once "../connection/connection.php" ?>

<?php
if(isset($_POST["create_post"])){

    $post_title        = $_POST['post_title'];
    $post_author         = $_POST['post_author'];
    $post_category_id  = $_POST['post_category_id'];
    $post_status       = $_POST['post_status'];
    $post_image        = $_FILES['image']['name'];
    $post_image_temp   = $_FILES['image']['tmp_name'];
    $post_tags         = $_POST['post_tags'];
    $post_content      = $_POST['post_content'];
    $post_date         = date('y-m-d');
    // $post_comment_count = 5;
    move_uploaded_file($post_image_temp,"../images/$post_image");


    global $connect, $tbl_posts;
    $query = "INSERT $tbl_posts SET `post_category_id` = ?, `post_title` = ? ,`post_author` = ? ,`post_date` = ? ,`post_image` = ? ,`post_content` = ? ,`post_tags` = ? ,`post_status` = ? ";
    $result = $connect->prepare($query);
    $result->bindValue(1, $post_category_id);
    $result->bindValue(2, $post_title);
    $result->bindValue(3, $post_author);
    $result->bindValue(4, $post_date);
    $result->bindValue(5, $post_image);
    $result->bindValue(6, $post_content);
    $result->bindValue(7, $post_tags);
    $result->bindValue(8, $post_status);
    $result->execute();
    ?>
 <script>
         Swal.fire({
            title: 'Done',
            text: 'new post Added',
            icon: 'success',
            confirmButtonText: 'Ok'
          })
         </script> 

<?php
    if($result->rowCount()){
     return $result;
     echo "<h3>success</h3>";
 }else{
    return false;

 }


}


?>
    <form action="" method="post" enctype="multipart/form-data">    
    
    <div class="form-group">
         <label for="title">Post Title</label>
          <input type="text" class="form-control" name="post_title">
      </div>

      <div class="form-group">
       <label for="category">Category</label>
       <select name="post_category_id" class="form-control" id="post_category">
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
      <div class="form-group">
         <label for="title">Post Author</label>
          <input type="text" class="form-control" name="post_author">
      </div>
       <div class="form-group">
         <select name="post_status" class="form-control" id="">
             <option value="published">Published</option>
             <option value="draft">Draft</option>
         </select>
      </div>
      
      
      
    
      <div class="form-group">
         <label for="post_image">Post Image</label>
          <input type="file"  name="image">
      </div>

      <div class="form-group">
         <label for="post_tags">Post Tags</label>
          <input type="text" class="form-control" name="post_tags">
      </div>
      
      <div class="form-group">
         <label for="post_content">Post Content</label>
         <textarea class="form-control "name="post_content" id="editor" cols="30" rows="10">
         </textarea>
      </div>
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
      </div>


</form>
    