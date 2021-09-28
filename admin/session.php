<?php
 if(!isset($_SESSION)){
    session_start();

}
if (isset($_SESSION["userInfo"])) {
if(time() - $_SESSION["userInfo"]["expire"]  > 1){
session_destroy();
session_unset();
header("Location:../index.php");
}
}