<?php
include "../common/db.php";

$id = $_GET['id'];
$sql = "SELECT * FROM categories WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['edit'])) {
  $errors = [];
  $id = $_POST['id'];
  $cat_name = $_POST['cat-name'];
  if ($cat_name == '') {
    $errors['cat-name'] = "Category name must be enter";
  }
  if (count($errors) == 0) {
  $sql = "UPDATE categories SET name='$cat_name' WHERE id=$id";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    header("Location: create.php");
  }
}
}
?>
<?php include "../common/header.php"; ?>

<section class="sec-cat">
  <div class="linner clearfix">
    <h2 class="cmn-ttl">Categories</h2>

    <form action="" method="post" class="clearfix">
      <input type="hidden" name="id" value="<?php echo $id ?>">
      <div class="cat-box clearfix">
        <label for="" class="cat-ttl">Name</label>
        <div class="input-gp">
          <input type="text" class="cat-input" name="cat-name" value="<?php echo $row['name'] ?>" placeholder="Enter category name">
          <span class="danger"><?php echo isset($errors['cat-name']) ? $errors['cat-name'] : ''; ?> </span>
        </div>
      </div>
      <div class="cat-box2">
        <input type="submit" value="Update" class=" cmn-btn cat-btn" name="edit">
      </div>

    </form>

    <?php
    $sql = "SELECT * FROM categories";
    $result = mysqli_query($conn, $sql);
    ?>

    <table class="cat-table">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Created-date</th>
        <th>Update-date</th>
        <th>Action</th>
      </tr>
      <tr>
        <?php
        while ($out = mysqli_fetch_array($result)) {
          echo "<tr>";
          echo "<td>$out[id]</td>";
          echo "<td>$out[name]</td>";
          echo "<td>$out[created_date]</td>";
          echo "<td>$out[updated_date]</td>";
          echo "<td><a href='edit.php'><i class='fa fa-edit' style='font-size:18px;color:black;margin-right:10px'></i></a>
              <a href=''><i class='fa fa-close' style='font-size:18px;color:red'></i></a></td>";
          echo "</tr>";
        }
        ?>
      </tr>
    </table>



  </div>
</section>

<?php include "../common/footer.php"; ?>