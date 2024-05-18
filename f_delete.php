<?php 

include_once "./Auth/config.php";

if(!isset($_GET['id'])){
    header("Location: ./index.php");
}
$id = $_GET['id'];

$sql = mysqli_query($conn, " DELETE FROM import WHERE furnitureid = '{$id}' " );
if($sql == true){
    $sql = mysqli_query($conn, " DELETE FROM export WHERE furnitureid = '{$id}' " );
    if($sql == true){
        $sql = mysqli_query($conn, "DELETE FROM furniture WHERE furnitureid = '{$id}' " );
        if($sql == true){
            header("Location: ./index.php");
        }
    }else{
        $sql = mysqli_query($conn, "DELETE FROM furiture WHERE furnitureid = '{$id}' " );
        if($sql == true){
            header("Location: ./index.php");
        }
    }
    
}else{
    $sql = mysqli_query($conn, "DELETE FROM furniture WHERE furnitureid = '{$id}' " );
        if($sql == true){
            header("Location: ./index.php");
        }
}


?>