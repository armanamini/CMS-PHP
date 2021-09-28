<?php require_once "modules/admin_header.php" ?>
    <div id="wrapper">
        <!-- Navigation -->
        <script src="js/jquery.js"></script>

<?php require_once "modules/admin_navigation.php" ?>
<?php include_once "session.php" ?>
        
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $_SESSION["userInfo"]["firstName"] ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

       
                <!-- /.row -->
                
                <div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="text-right col-xs-9">
<?php
global $connect;
$query = "SELECT * FROM posts";
$result = $connect->query($query);
$result->execute();
if($result->rowCount()){
    $num_post = $result->rowCount();
    echo " <div class='huge'>{$num_post}</div>";
}
?>

                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="posts.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="text-right col-xs-9">
                    <?php
global $connect;
$query = "SELECT * FROM comments";
$result = $connect->query($query);
$result->execute();
if($result->rowCount()){
    $num_comment = $result->rowCount();
    echo " <div class='huge'>{$num_comment}</div>";
}
?>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="comments.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x"></i>
                    </div>
                    <div class="text-right col-xs-9">
                    <?php
global $connect;
$query = "SELECT * FROM users";
$result = $connect->query($query);
$result->execute();
if($result->rowCount()){
    $num_user = $result->rowCount();
    echo " <div class='huge'>{$num_user}</div>";
}
?>
              
                        <div> Users</div>
                    </div>
                </div>
            </div>
            <a href="users.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-list fa-5x"></i>
                    </div>
                    <div class="text-right col-xs-9">
                    <?php
global $connect;
$query = "SELECT * FROM categories";
$result = $connect->query($query);
$result->execute();
if($result->rowCount()){
    $num_cat = $result->rowCount();
    echo " <div class='huge'>{$num_cat}</div>";
}
?>
                       
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="categories.php">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
                <!-- /.row -->
<div class="row">
<?php
global $connect;
$query = "SELECT * FROM posts WHERE `post_status` = 'draft'";
$result = $connect->query($query);
$result->execute();
if($result->rowCount()){
    $num_post_draft = $result->rowCount();

}
?>
<script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["data", "value" ],
      <?php
global $num_post_draft ;
          
$element_text = ['active posts','categories','users','comments'];
$element_count = [$num_post ,$num_cat ,$num_user, $num_comment];
for($i = 0; $i < sizeof($element_text); $i++){
echo "['{$element_text[$i]}'".  ","  ."{$element_count[$i]}],";



}
?>
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
<div id="columnchart_material" style="width: auto; height: 500px;"></div>
</div>   

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        <?php require_once "modules/admin_footer.php" ?>