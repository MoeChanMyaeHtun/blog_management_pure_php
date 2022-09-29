<!-- <?php 

// if (!empty($_REQUEST['term'])) {

// $term = mysql_real_escape_string($_REQUEST['term']);     

// $sql = "SELECT * FROM post WHERE Description LIKE '%".$term."%'"; 
// $r_query = mysql_query($sql); 

// while ($row = mysql_fetch_array($r_query)){  
// echo 'Primary key: ' .$row['PRIMARYKEY'];  
// echo '<br /> Code: ' .$row['Code'];  
// echo '<br /> Description: '.$row['Description'];  
// echo '<br /> Category: '.$row['Category'];  
// echo '<br /> Cut Size: '.$row['CutSize'];   
// }  

// }
?> -->
<?php 
if(!empty($_REQUEST['term'])){
  $term = mysqli_real_escape_string($_POST['term']);
  $sql = "SELECT * FROM post WHERE Description LIKE '%".$term."%'";

}
?>
