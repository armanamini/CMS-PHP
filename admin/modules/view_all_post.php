<?php
if(isset($_POST["checkBoxArray"])){

foreach ($_POST["checkBoxArray"] as $postValue_id ) {
  
  $bulk_option = $_POST["bulk_option"];

 switch ($bulk_option) {
     case 'published':
        global $connect;
         $query = "UPDATE posts SET `post_status` = '$bulk_option' WHERE `post_id` = $postValue_id";
         $result = $connect->prepare($query);
         $result->execute();
         break;
         case 'draft':
            global $connect;
             $query = "UPDATE posts SET `post_status` = '$bulk_option' WHERE `post_id` = $postValue_id";
             $result = $connect->prepare($query);
             $result->execute();
             break;
             case 'delete':
                global $connect;
                 $query = "DELETE FROM posts WHERE `post_id` = $postValue_id";
                 $result = $connect->prepare($query);
                 $result->execute();
                 break;
     default:
         
         break;
 }
}
}
?>
<form action="" method='post'>
<table class="table table-bordered table-hover">

<div id="bulkOption" class="col-md-4">

<select name="bulk_option" class="form-control" id="">
    <option value="">Select Option</option>
    <option value="published">Publish</option>
    <option value="draft">Draft</option>
    <option value="delete">Delete</option>
</select>

</div>
<div class="col-md-8 ">

<input type="submit" name="submit" class="btn btn-small btn-success" value="Apply" >
<a href="posts.php?source=addPost" class="btn btn-primary">Add New</a>
</div>
                            <thead>
                                <tr>
                                   <th><input type="checkbox" id="selectAllBoxes"></th>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <!-- <th>Content</th> -->
                                    <th>Tags</th>
                                    <th>Comments</th>
                                    <th>Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                function allPosts(){
                                    global $connect, $tbl_posts;
                                    $query = "SELECT * FROM $tbl_posts";
                                    $result = $connect->prepare($query);
                                    $result->execute();
                                    if($result->rowCount()){
                                        return $result;
                                    }
                                    return false;
                                }
        
        $row = allPosts()->fetchAll(PDO::FETCH_ASSOC);
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
     echo "<tr>";
     ?>
      <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>

      <?php
echo "<td>$post_id</td>";
echo "<td>$post_author</td>";
echo "<td>$post_title</td>";

?>
<?php
if(!function_exists("showCat")){
    function showCat(){
        global $connect, $tbl_cat,$post_category_id;
            $query = "SELECT * FROM $tbl_cat WHERE `cat_id` = $post_category_id";
            $result = $connect->prepare($query);
            $result->execute();
            if($result->rowCount()){
                return $result;
            }else{
                return false;  
            }
    }

     

}
$cats = showCat()->fetchAll(PDO::FETCH_ASSOC);
        foreach($cats as $cat ){
            $cat_title = $cat["cat_title"];
            $cat_id = $cat["cat_id"];
       echo "<td>$cat_title</td>";

        }


      echo "<td>$post_status</td>";
      echo "<td><img width='100' height='auto' src='../images/$post_image' alt=''></td>";
    //   echo " <td>$post_content</td>";
      echo "<td>$post_tags</td>";
      echo "<td>$post_comment_count</td>";
      echo "<td>$post_date</td>";
      echo "<td><a href='../post.php?p_id=$post_id' class='text-primary' >view post</a></td>";
      echo "<td><a href='posts.php?source=edit_post&p_id=$post_id 'class='text-success' >Edit</a></td>";
      echo " <td><a href='posts.php?delete=$post_id '       class='text-danger' onClick=\"javascript : return confirm('Are you Sure?')  \" >Delete</a></td>";
        }
        echo "</tr>";
        showCat();
     ?>
                                      
                            </tbody>
                        </table>
                        </form>

                        <?php
if(isset($_GET["delete"])){
global $connect, $tbl_posts;
$post_delete = $_GET["delete"];
 $query = "DELETE FROM $tbl_posts WHERE `post_id` = ?";
 $result = $connect->prepare($query);
 $result->bindValue(1,$post_delete);
 $result->execute();
 header("Location:../admin/posts.php");
 if($result->rowCount()){
     return $result;
 }
 return false;
}

 ?>