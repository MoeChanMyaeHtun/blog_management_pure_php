<?php
 include_once '../common/init.php';
 include '../common/db.php';
 unset($_SESSION['name']);
    unset($_SESSION['id']);
    
    header("location:../index.php");

?>