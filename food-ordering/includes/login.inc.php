<?php


if(isset($_POST["btnSubmit"]) or isset($_POST["submitted"])){
   
    $username = $_POST["username"];
    $password = $_POST["password"];
    // do verification here
    require_once('functions.inc.php');
    require_once('db.inc.php');
    loginUser($conn, $username, $password);
} 
else{
    $a =$_POST['username'];
    header("location: ../frontend/index.php");
    exit();
}
