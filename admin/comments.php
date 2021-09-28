<?php require_once "modules/functions.php" ?>

<?php require_once "modules/admin_header.php" ?>
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
                         

                        <?php
  if(isset($_GET["source"])){
 $source = $_GET["source"];
 
}
global $source;
  switch ($source) {
      case "addPost":
        include_once "modules/add_Post.php";
          break;
      case "edit_post":
            include_once "modules/edit_post.php";
          break;
      default:
      include_once "modules/view_all_comments.php";

          break;
  }
 
  
  
                        ?>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        <?php require_once "modules/admin_footer.php" ?>