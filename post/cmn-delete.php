<?php 
include "../common/db.php";
include_once "../common/init.php";
$id = $_GET['id'];
$sql = "DELETE FROM comment WHERE id = '$id'";
$pid = $_SESSION['post_id'];

$commdel = $conn->query($sql);

if(mysqli_query($conn, $sql)){
    header("Location:detail.php?id=$pid");
}

?>