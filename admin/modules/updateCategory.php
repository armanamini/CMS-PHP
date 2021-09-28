
                                    <?php 
    if(isset($_GET["edit"])) {
function updateCat(){
    global $connect, $tbl_cat;


        $cat_id = $_GET["edit"]; 
        $query = "SELECT * FROM $tbl_cat WHERE cat_id = $cat_id";
        $result = $connect->prepare($query);
        $result->execute();
        if($result->rowCount()){
            return $result;
        }
         return false;
    }
       
 $row = updateCat()->fetchAll(PDO::FETCH_ASSOC);
    foreach($row as $rows ){
        $cat__title = $rows["cat_title"];
        $cat__id = $rows["cat_id"];
?>
                                <form action="" method="post">
                                <div class="form-group">
                              <label for="cat-title">Edit Category</label>
                   <input type="text" value="<?php if(isset($cat__title)) {echo $cat__title;} ?>" name="cat_title" class="form-control">


<?php

if(isset($_POST["update_category"])){
function update(){

    $theCat_title = $_POST["cat_title"];
    $theCat_id = $_GET["edit"];
    global $connect, $tbl_cat;
    $query = "UPDATE $tbl_cat SET `cat_title` = ? WHERE `cat_id` =  ? ";
    $result = $connect->prepare($query);
    $result->bindValue(1,$theCat_title);
    $result->bindValue(2,$theCat_id);
    $result->execute();
    header("Location: categories.php");
    if($result->rowCount()){
        return $result;
    }
    return false;
}

update();
}
?>



                             </div>
                                <div class="form-group">
                                    <input type="submit" name="update_category" class="btn btn-small btn-primary" value="Update">
                                </div>
                            </form>
<?php } ?>

<?php } ?>
   
