<?php 
include "../common/db.php";
$id = $_GET['id'];
$sql = "DELETE FROM categories WHERE id = '$id'";


$result = $conn->query($sql);

if(mysqli_query($conn, $sql)){
    header("location:categories.php");
}

?>