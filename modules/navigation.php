<?php require_once "./connection/connection.php" ?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Home Page</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
<?php 

function navTitle(){
    global $connect, $tbl_cat;
    $query = "SELECT `cat_title` FROM $tbl_cat";
    $result = $connect->prepare($query);
    $result->execute();
    if($result->rowCount()){
        return $result;
    }
    return false;
}

$row = navTitle()->fetchAll(PDO::FETCH_ASSOC);
foreach($row as $rows ){
    echo " <li><a href=''>{$rows['cat_title']}</a></li>";
}

?>

                 
                     <li>
                        <a href="admin">Admin</a>
                    </li>
                    <!-- <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>  -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>