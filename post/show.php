
<?php include "../common/db.php" ;
 $results_per_page =5;  

 $query = "select *from post";  
 $result = mysqli_query($conn, $query);  
 $number_of_result = mysqli_num_rows($result);  

 $number_of_page = ceil ($number_of_result / $results_per_page);  

 if (!isset ($_GET['page']) ) {  
  $page = 1;  
} else {  
  $page = $_GET['page'];  
}  
$page_first_result = ($page-1) * $results_per_page;  
$query = "SELECT *FROM post LIMIT " . $page_first_result . ',' . $results_per_page;  
$result = mysqli_query($conn, $query);  

if (isset($_POST['search-btn'])) {
$search = $_POST['search'];
$sqls = "select * from post where title like '%$search%'";
$res= mysqli_query($conn,$sqls);
}
?>

<?php include "../common/header.php" ;
    include "../common/nav.php";
?>  
<section class="sec-post">
  <div class="linner">
    <div class="clearfix">
    <div class="search-container">
    <form action="" method="POST">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit" name="search-btn"><i class="fa fa-search"></i></button>
    </form>
  </div>
    <a href="create.php" class="create">Create</a>
    </div>

   <table class="post-table">
      <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Category</th>
        <th>Title</th>
        <th>Description</th>
        <th>Created-date</th>
        <th>Action</th>
      </tr>
      <tr>
     <?php
      $sql = "SELECT * FROM post ORDER BY ID ASC ";
      $result = mysqli_query($conn, $query);
        while ($out = mysqli_fetch_array($result)) {
          echo "<tr>";
          echo "<td>$out[id]</td>";
          echo "<td><img src='{$out['image']}' style='width:100px;height:100px'></td>";
          $sql = "SELECT categories.name,post.id FROM categories 
          JOIN post_category ON categories.id = post_category.cat_id
          JOIN post ON post.id = post_category.post_id
          WHERE post.id = '$out[id]'";
          
          $query = mysqli_query($conn,$sql);

          echo "<td>";
          while($row = mysqli_fetch_assoc($query)){
              if($id = $row['id']){
                  echo "<span style='color:#000000'>{$row['name']}&nbsp;&nbsp;</span>";

              }
            }
          echo "<td>$out[title]</td>";
          echo "<td>$out[description]</td>";
          echo "<td>$out[created_date]</td>";
          echo "<td><a href='edit.php?id={$out['id']}'><i class='fa fa-edit' style='font-size:18px;color:black;margin-right:10px'></i></a>
              <a href='delete.php?id={$out['id']}'><i class='fa fa-close' style='font-size:18px;color:red'></i></a></td>";
          echo "</tr>";
        }
        ?> 

      </tr>

    </table>

    <div class="container">

      <div class="link-container">
        <?php
        for($page = 1; $page<= $number_of_page; $page++) {  
        echo '<a href = "show.php?page=' . $page . '" class="page--link">' . $page . ' </a>';  
    }  
    ?>
      </div>

    </div>
    </div>
    </section>
<?php include "../common/footer.php"; ?>