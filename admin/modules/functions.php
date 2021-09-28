<?php

function insert_categories(){
    function addCategory(){
        if(isset($_POST["submit"])){
            $cat_title = $_POST["cat_title"];
            if($cat_title == "" || empty($cat_title)){
            echo "you should fill this";
                
            }else{
                global $connect, $tbl_cat;
                $query = "INSERT $tbl_cat SET `cat_title` = ?";
                $result = $connect->prepare($query);
                $result->bindValue(1, $cat_title);
                $result->execute();
                if($result->rowCount()){
                 return $result;
             }
             return false;
            }
            
                
            }
    }
    addCategory();
}

function findAllCategories(){
    function categorie(){
        global $connect, $tbl_cat;
        $query = "SELECT * FROM $tbl_cat";
        $result = $connect->prepare($query);
        $result->execute();
        if($result->rowCount()){
            return $result;
        }
        return false;
    }
    $row = categorie()->fetchAll(PDO::FETCH_ASSOC);
    foreach($row as $rows ){
$cat_title = $rows["cat_title"];
$cat_id = $rows["cat_id"];
echo "<tr>";
echo "<td>{$cat_id}</td>";
echo "<td>{$cat_title}</td>";
echo " <td><a href='categories.php?delete={$cat_id}' class='text-danger' >Delete</a></td> ";
echo " <td><a href='categories.php?edit={$cat_id}' class='text-primary' >edit</a></td> ";
echo "</tr>";
}
}

function deleteCategories(){
    function deleteCat(){

        if(isset($_GET["delete"])){
         $theCat_id = $_GET["delete"];

global $connect, $tbl_cat;
$query = "DELETE FROM $tbl_cat WHERE `cat_id` = ? ";
$result = $connect->prepare($query);
$result->bindValue(1,$theCat_id);
$result->execute();
header("Location: categories.php");
if($result->rowCount()){
return $result;
}
return false;


}
} 

deleteCat();
}



