<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "cms";
$tbl_cat = "categories"; 
$tbl_posts = "posts";
$tbl_comments = "comments";
try {
    $connect = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
 

} catch (PDOException $error) {
    echo "Erroe while Connection " . $error->getMessage();
}


