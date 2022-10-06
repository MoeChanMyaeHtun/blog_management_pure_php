<?php 
include "../common/db.php";
$id = $_GET['id'];

$post = "SELECT * FROM post WHERE id=$id";
$query = mysqli_query($conn,$post);
$row = mysqli_fetch_assoc($query);
unlink($row['image']);

$sql = "DELETE FROM post WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
      if ($result) {
        header("Location:show.php");
      }
?>
