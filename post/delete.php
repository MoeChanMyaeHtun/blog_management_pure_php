<?php 
include "../common/db.php";
$id = $_GET['id'];
$sql = "DELETE FROM post WHERE id = '$id'";


$result = $conn->query($sql);

if(mysqli_query($conn, $sql)){
    header("location:show.php");
}

?>