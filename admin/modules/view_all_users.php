<table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>FirstName</th>
                                    <th>LastName</th>
                                    <th>userName</th>
                                    <th>Email</th>
                                    <th>Avatar</th>
                                    <th>Role</th>
                                
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                function allUsers(){
                                    global $connect;
                                    $query = "SELECT * FROM users";
                                    $result = $connect->prepare($query);
                                    $result->execute();
                                    if($result->rowCount()){
                                        return $result;
                                    }
                                    echo "<h1>No users</h1>";
                                }
        
        $row = allUsers()->fetchAll(PDO::FETCH_ASSOC);
        foreach($row as $rows ){
     $user_id = $rows["user_id"];
     $userName = $rows["userName"];
     $firstName = $rows["firstName"];
     $lastName = $rows["lastName"];
     $email = $rows["email"];
     $image = $rows["image"];
     $role = $rows["role"];
     switch ($role) {
         case '1':
            $role = "Admin";
             break;
         case '2':
            $role = "Subscriber";
            break;
     }
     echo "<tr>";
echo "<td>$user_id</td>";
echo "<td>$firstName</td>";
echo "<td>$lastName</td>";

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


      echo "<td>$userName</td>";
      echo "<td>$email</td>";
      echo "<td><img src='../images/$image'></td>";
      echo "<td>$role</td>";
   

  
     

      echo "<td><a href='users.php?change_to_admin=$user_id' class='text-success' >
       <button class='btn btn-small admin btn-success'>make Admin</button>
      </a></td>";

      echo " <td><a href='users.php?change_to_subscriber=$user_id' class='text-danger'>
      <button class='btn btn-small sub btn-primary'>make Subscriber</button>
      </a></td>";

      echo " <td><a href='users.php?source=edit_user&edit_user=$user_id' class='text-primary'>Edit</a></td>";

      echo " <td><a href='users.php?delete=$user_id'    class='text-danger'>Delete</a></td>";
     
                                            
    echo "</tr>";

    if($role == "Admin" ){?>

<script>

$(function(){
    alert()
})

</script>
  
 <?php }  else {?> 
 
    <script>

</script>

<?php } ?>

<?php } ?>

                         
   





                            </tbody>
                        </table>
<?php
if(isset($_GET["change_to_admin"])){
global $connect;
$the_user_id = $_GET["change_to_admin"];
 $query = "UPDATE users SET `role` = '1' WHERE `user_id` = $the_user_id ";
 $result = $connect->prepare($query);
 $result->execute();
 header("Location: users.php");
 if($result->rowCount()){
     return $result;
 }else{
    return false;

 }
}
 ?>




<?php
if(isset($_GET["change_to_subscriber"])){
global $connect, $tbl_posts;
$the_user_id = $_GET["change_to_subscriber"];
 $query = "UPDATE users SET `role` = '2' WHERE `user_id` = $the_user_id ";
 $result = $connect->prepare($query);
 $result->execute();
 header("Location: users.php");
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
$the_user_id = $_GET["delete"];
 $query = "DELETE FROM users WHERE `user_id` = ?";
 $result = $connect->prepare($query);
 $result->bindValue(1,$the_user_id);
 $result->execute();
 header("Location: users.php");
 if($result->rowCount()){
     return $result;
 }else{
    return false;

 }
}

 ?>