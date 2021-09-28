<?php require_once "modules/functions.php" ?>

<?php require_once "modules/admin_header.php" ?>

<?php

if(isset($_SESSION["userInfo"]["username"])){
global $connect;
$username = $_SESSION["userInfo"]["username"];

$query = "SELECT * FROM users WHERE `userName` = ? ";
$result = $connect->prepare($query);
$result->bindValue(1,$username);
$result->execute();
$row = $result->fetchAll(PDO::FETCH_ASSOC);
foreach($row as $rows){
    $user_id = $rows["user_id"];
    $userName = $rows["userName"];
    $firstName = $rows["firstName"];
    $lastName = $rows["lastName"];
    $email = $rows["email"];
    $image = $rows["image"];
    $role = $rows["role"];
}
}
?>

<?php

if(isset($_POST["edit_user"])){
    $username = $_SESSION["userInfo"]["username"];

    $first_Name        = $_POST['first_Name'];
    $last_Name         = $_POST['last_Name'];
    $user_role         = $_POST['user_role'];
    $user_Name         = $_POST['user_Name'];
    $user_iamge        = $_FILES['image']['name'];
    $user_iamge_temp   = $_FILES['image']['tmp_name'];
    $user_email        = $_POST['user_email'];
    $user_password        = $_POST['user_password'];
    $post_date         = date('y-m-d');
    // $post_comment_count = 5;
    move_uploaded_file($user_iamge_temp,"../images/$user_iamge");


    global $connect;
     $query = "UPDATE users SET `firstName` = ?,`lastName` = ?,`userName` = ?,`email` = ?,`password` = ?,`image` = ?,`role` = ? WHERE `userName` = ?";
     $result = $connect->prepare($query);
     $result->bindValue(1,$first_Name);
     $result->bindValue(2,$last_Name);
     $result->bindValue(3,$user_Name);
     $result->bindValue(4,$user_email);
     $result->bindValue(5,md5($user_password));
     $result->bindValue(6,$user_iamge);
     $result->bindValue(7,$user_role);
     $result->bindValue(8,$username);
 
     $result->execute();
     if($result->rowCount()){
         return $result;
     }
     return false;



}



?>
    <div id="wrapper">
        <!-- Navigation -->
<?php require_once "modules/admin_navigation.php" ?>
        

        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>
                         
                        <form action="" method="post" enctype="multipart/form-data">    
    
    <div class="form-group">
         <label for="title">firstName</label>
          <input type="text" value= <?php echo $firstName ?> class="form-control" name="first_Name">
      </div>

      <div class="form-group">
         <label for="title">lastName</label>
          <input type="text" value="<?php echo $lastName ?> " class="form-control" name="last_Name">
      </div>

      <div class="form-group">
       <label for="category">role</label>
       <select name="user_role" class="form-control" id="post_category">
           <?php
           if($role == 1){
               echo "<option value='2'>subscriber</option>";
           }else{

            echo "<option value='1'>admin</option>";
           }
           
           ?>


       </select>
        
        
      </div>
      <div class="form-group">
         <label for="title">userName</label>
          <input type="text" value=<?php echo $username ?> class="form-control" name="user_Name">
      </div>

       <div class="form-group"> 
         <label for="post_image">Avatar</label>
         <img src="../images/<?php echo $image ?>" width="100" height="auto" alt="">
          <input type="file"  name="image">
      </div>

      <div class="form-group">
         <label for="post_tags">Email</label>
          <input type="email" value=<?php echo $email ?>  class="form-control" name="user_email">
      </div>
      
      <div class="form-group">
         <label for="post_tags">password</label>
          <input type="password"  class="form-control" name="user_password">
      </div>
      


       <div class="form-group">
          <input class="btn btn-primary" type="submit" name="edit_user" value="update profile">
      </div>


</form>
                        <?php
 
  
                        ?>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        <?php require_once "modules/admin_footer.php" ?>