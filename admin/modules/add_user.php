<?php require_once "../connection/connection.php" ?>
<?php
if(isset($_POST["create_user"])){

    $first_Name        = $_POST['first_Name'];
    $last_Name         = $_POST['last_Name'];
    $user_role         = $_POST['user_role'];
    $user_Name         = $_POST['user_Name'];
    $user_iamge        = $_FILES['image']['name'];
    $user_iamge_temp   = $_FILES['image']['tmp_name'];
    $user_email        = $_POST['user_email'];
    $user_password     = $_POST['user_password'];
    $post_date         = date('y-m-d');
    // $post_comment_count = 5;
    move_uploaded_file($user_iamge_temp,"../images/$user_iamge");


    global $connect;
    $query = "INSERT users SET `firstName` = ?, `lastName` = ? ,`userName` = ? ,`email` = ? ,`password` = ? ,`image` = ? ,`role` = ? ";
    $result = $connect->prepare($query);
    $result->bindValue(1, $first_Name);
    $result->bindValue(2, $last_Name);
    $result->bindValue(3, $user_Name);
    $result->bindValue(4, $user_email);
    $result->bindValue(5, hash("md5",$user_password));
    $result->bindValue(6, $user_iamge);
    $result->bindValue(7, $user_role);
    $result->execute();
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
         <label for="title">firstName</label>
          <input type="text" class="form-control" name="first_Name">
      </div>

      <div class="form-group">
         <label for="title">lastName</label>
          <input type="text" class="form-control" name="last_Name">
      </div>

      <div class="form-group">
       <label for="category">role</label>
       <select name="user_role" class="form-control" id="post_category">
<option value="2">select Options</option>
<option value="1">admin</option>
<option value="2">subscriber</option>
       </select>
        
            

      
      </div>
      <div class="form-group">
         <label for="title">userName</label>
          <input type="text" class="form-control" name="user_Name">
      </div>

       <div class="form-group"> 
         <label for="post_image">Avatar</label>
          <input type="file"  name="image">
      </div>

      <div class="form-group">
         <label for="post_tags">Email</label>
          <input type="email" class="form-control" name="user_email">
      </div>
      
      <div class="form-group">
         <label for="post_tags">password</label>
          <input type="password" class="form-control" name="user_password">
      </div>
      
      

       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="create_user" value="submit">
      </div>


</form>
    