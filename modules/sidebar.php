<div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="./search.php" method="post">
                     <div class="input-group">
                        <input name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                        
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>


    <!-- login -->
    <div class="well">
                    <h4>Login</h4>
                    <form action="modules/login.php" method="post">
                     <div class="form-group">
                        <input name="username" placeholder="Enter Username" type="text" class="form-control">         
                    </div>

                    <div class="form-group">
                        <input name="password" placeholder="Enter password" type="password" class="form-control"> 
                        <span class="input-group-btn">
                            <button class="btn btn-small btn-primary" name="login" type="submit">Login</button>
                            
                        </span>        
                    </div>

                    </form>
                    <!-- /.input-group -->
                </div>


                <!-- Blog Categories Well -->
                <div class="well">
<?php                
function categories(){
    global $connect, $tbl_cat;
    $query = "SELECT * FROM $tbl_cat";
    $result = $connect->prepare($query);
    $result->execute();
    if($result->rowCount()){
        return $result;
    }
    return false;
}
 ?>
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">

<?php
$row = categories()->fetchAll(PDO::FETCH_ASSOC);
foreach($row as $rows ){
    $cat_title = $rows["cat_title"];
    $cat_id = $rows["cat_id"];
echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a>
</li>";
}
?>
  </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
               <?php require_once "widget.php" ?>

            </div>