<?php
include "../common/db.php";

if (isset($_POST['submit'])) {
  $errors = [];
  $cat_name =  $_POST['cat-name'];
  $dt = new DateTime("now", new DateTimeZone('Asia/Yangon'));
  $created_date = $dt->format('Y.m.d , h:i:s');
  $updated_date = $dt->format('Y.m.d , h:i:s');

  if ($cat_name == '') {
    $errors['cat-name'] = "Category name must be enter";
  }
  if (count($errors) == 0) {
    $sql = "INSERT INTO categories (`name`,`created_date`,`updated_date`)values('$cat_name','$created_date','$updated_date')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      header("location:create.php");
    }
  }
}
?>
<?php include "../common/header.php"; ?>
<?php include "../common/nav.php"; ?>
<section class="sec-cat">
  <div class="linner clearfix">
    <h2 class="cmn-ttl">Categories</h2>

    <form action="" method="post" class="clearfix">

      <?php
      if (!empty($_SESSION['name'])) {
      ?>
        <div class="cat-box clearfix">
          <label for="" class="cat-ttl">Name</label>
          <div class="input-gp">
            <input type="text" class="cat-input" name="cat-name" value="<?php echo isset($cat_name) ? $cat_name : '' ?>" placeholder="Enter category name">
            <span class="danger"><?php echo isset($errors['cat-name']) ? $errors['cat-name'] : ''; ?> </span>
          </div>
        </div>
        <div class="cat-box2">
          <input type="submit" value="Submit" class=" cmn-btn cat-btn" name="submit">
        </div>
      <?php
      }
      ?>


    </form>

    <?php
    $sql = "SELECT * FROM categories";
    $result = mysqli_query($conn, $sql);
    ?>

    <table class="cat-table">
      <tr>
        <th>No</th>
        <th>Name</th>
        <th>Created-date</th>
        <th>Update-date</th>
        <?php
        if (!empty($_SESSION['name'])) {
        ?>
          <th>Action</th>
        <?php
        }
        ?>

      </tr>
      <tr>
        <?php
        $a = isset($_GET['page']) ? $_GET['page'] : 1;
        $i = ($a - 1);
        while ($out = mysqli_fetch_array($result)) {
          echo "<tr>";
          echo "<td>" . ++$i . "</td>";
          echo "<td>$out[name]</td>";
          echo "<td>$out[created_date]</td>";
          echo "<td>$out[updated_date]</td>";
        ?>
          <?php
          if (!empty($_SESSION['name'])) {
          ?>
            <td><a href='edit.php?id=<?php echo $out['id'] ?>'><i class='fa fa-edit' style='font-size:18px;color:black;margin-right:10px'></i></a>
              <a href='delete.php?id=<?php echo $out['id'] ?>'><i class='fa fa-close' style='font-size:18px;color:red'></i></a>
            </td>
          <?php
          }
          ?>

        <?php echo "</tr>";
        }
        ?>
      </tr>
    </table>



  </div>
</section>

<?php include "../common/footer.php"; ?>