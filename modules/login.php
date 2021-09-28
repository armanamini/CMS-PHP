<?php include_once "../connection/connection.php"; ?>
<?php session_start(); ?>
<?php include_once "../admin/session.php"?>
<?php
if(isset($_POST["login"])){
 
        global $connect;
        $userName =  $_POST["username"];
        $password =  $_POST["password"];
     
     addslashes($userName);
     addslashes($password);
     
     $query = "SELECT * FROM users WHERE `userName` = ? AND `password`=?";
     $result = $connect->prepare($query);
     $result->bindValue(1,$userName);
     $result->bindValue(2,md5($password));
     $result->execute();
     if($result->rowCount()){
        header("Location: ../admin/index.php");
           $row = $result->fetchAll(PDO::FETCH_ASSOC); 
        foreach($row as $rows){
            $dbuserId   = $rows["user_id"];
            $dbfirstName = $rows["firstName"];
            $dbpass     = $rows["password"];
            $dblastName = $rows["lastName"];
            $dbuserName = $rows["userName"];
            $dbrole     = $rows["role"];
         echo "welcome " . $dbfirstName;
         
        }
$sessionInfo = array(
    "username" => $dbuserName,
    "firstName"=> $dbfirstName,
    "lastname" => $dblastName,
    "userrole" => $dbrole,
    "expire" => time() + 60*60,    
);


        $_SESSION["userInfo"] = $sessionInfo;
        
      
          
      
        }else{
            header("Location: ../index.php");

        }







}
?>