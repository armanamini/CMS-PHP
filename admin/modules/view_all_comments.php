<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comments</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In Response to</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Decline</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                function allComments(){
                                    global $connect, $tbl_comments;
                                    $query = "SELECT * FROM $tbl_comments";
                                    $result = $connect->prepare($query);
                                    $result->execute();
                                    if($result->rowCount()){
                                        return $result;
                                    }
                                    echo "<h1>No Comments</h1>";
                                }
        
        $row = allComments()->fetchAll(PDO::FETCH_ASSOC);
        foreach($row as $rows ){
     $comment_id = $rows["comment_id"];
     $comment_post_id = $rows["comment_post_id"];
     $comment_author = $rows["comment_author"];
     $comment_email = $rows["comment_email"];
     $comment_date = $rows["comment_date"];
     $comment_content = $rows["comment_content"];
     $comment_status = $rows["comment_status"];
     echo "<tr>";
echo "<td>$comment_id</td>";
echo "<td>$comment_author</td>";
echo "<td>$comment_content</td>";

?>
<?php
// if(!function_exists("showCat")){
//     function showCat(){
//         global $connect, $tbl_cat,$post_category_id;
//             $query = "SELECT * FROM $tbl_cat WHERE `cat_id` = $post_category_id";
//             $result = $connect->prepare($query);
//             $result->execute();
//             if($result->rowCount()){
//                 return $result;
//             }else{
//                 return false;  
//             }
//     }

     

// }
// $cats = showCat()->fetchAll(PDO::FETCH_ASSOC);
//         foreach($cats as $cat ){
//             $cat_title = $cat["cat_title"];
//             $cat_id = $cat["cat_id"];
//        echo "<td>$cat_title</td>";

//         }


      echo "<td>$comment_email</td>";
      echo "<td>$comment_status</td>";

      $sql = "SELECT * FROM posts WHERE `post_id` = $comment_post_id";
      $result = $connect->prepare($sql);
      $result->execute();
      $rows = $result->fetchAll(PDO::FETCH_ASSOC);

      foreach($rows as $row){

          $post_id = $row["post_id"];
          $post_title = $row["post_title"];
      echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";

      }
        

      


      echo "<td>$comment_date</td>";



      echo "<td><a href='comments.php?Approved=$comment_id' class='text-success' >
      <button class='btn btn-small btn-success'>Approve</button>
     </a></td>";

      echo " <td><a href='comments.php?Declined=$comment_id'    class='text-danger'>
      <button class='btn btn-small btn-danger'>Decline</button>
      </a></td>";

      echo " <td><a href='comments.php?delete=$comment_id'       class='text-danger' >Delete</a></td>";
        }
        echo "</tr>";
        allComments();
     ?>
                            
                                    
                                       
                                              
                     
                            </tbody>
                        </table>
<?php
if(isset($_GET["Approved"])){
global $connect;
$the_comment_id = $_GET["Approved"];
 $query = "UPDATE comments SET `comment_status` = 'Approved' WHERE `comment_id` = $the_comment_id ";
 $result = $connect->prepare($query);
 $result->execute();
 header("Location: comments.php");
 if($result->rowCount()){
     return $result;
 }else{
    return false;

 }
}
 ?>




<?php
if(isset($_GET["Declined"])){
global $connect, $tbl_posts;
$the_comment_id = $_GET["Declined"];
 $query = "UPDATE comments SET `comment_status` = 'Declined' WHERE `comment_id` = $the_comment_id ";
 $result = $connect->prepare($query);
 $result->execute();
 header("Location: comments.php");
 if($result->rowCount()){
     return $result;
 }else{
    return false;

 }
}
 ?>





<?php
if(isset($_GET["delete"])){
global $connect, $tbl_posts;
$the_comment_id = $_GET["delete"];
 $query = "DELETE FROM comments WHERE `comment_id` = ?";
 $result = $connect->prepare($query);
 $result->bindValue(1,$the_comment_id);
 $result->execute();
 header("Location: comments.php");
 if($result->rowCount()){
     return $result;
 }else{
    return false;

 }
}

 ?>