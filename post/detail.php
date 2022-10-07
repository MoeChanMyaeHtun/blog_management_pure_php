<?php
include_once "../common/init.php";
include "../common/db.php";

$id = $_GET['id'];
$_SESSION['post_id'] = $id;
$sql = "SELECT * FROM post WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);



?>

<?php
include "../common/header.php";
include "../common/nav.php"
?>
<section class="post-detail">
  <div class="linner">
    <div class="detailbox clearfix">
      <?php
      if (isset($_POST['send'])) {
        $id = $_GET['id'];
        $errors = [];
        $cmn = $_POST['cmn'];
        $userid = $_SESSION['user_id'];
        $username =  $_SESSION['name'];
        $dt = new DateTime("now", new DateTimeZone('Asia/Yangon'));
        $created_date = $dt->format('Y.m.d , h:i:s');
        $updated_date = $dt->format('Y.m.d , h:i:s');
        if ($cmn == '') {
          $errors['cmn'] = "Comment must be enter";
        }
        if (count($errors) == 0) {
          $comment = "INSERT INTO comment (`pid`,`uid`,`body`,`created_date`,`updated_date`) VALUES ('$id','$userid','$cmn','$created_date','$updated_date')";

          $cmnres = mysqli_query($conn, $comment);

          if ($cmnres) {

            header("location:detail.php?id=$id");
          }
        }
      }
      ?>
      <div class="detail-txt">
        <h2 class="cmn-ttl">Post Detail</h2>
        <ul>
          <li class="clearfix">
            <div class="ttl">User</div>
            <div class="space">:</div>
            <?php
            $usql = "SELECT * FROM user WHERE id={$row['user_id']}";
            $uquery = mysqli_query($conn, $usql);

            $user = mysqli_fetch_assoc($uquery);
            ?>
            <div class="txt"><?php echo $user['name'] ?></div>
          </li>
          <li class="clearfix">
            <div class="ttl">Image</div>
            <div class="space">:</div>
            <div class="txt"><img src="<?php echo $row['image'] ?>" alt="" name="image" class="post-img"></div>
          </li>
          <li class="clearfix">
            <div class="ttl">Title</div>
            <div class="space">:</div>
            <div class="txt"><?php echo $row['title'] ?></div>
          </li>
          <li class="clearfix">
            <?php
            $sql = "SELECT categories.name,post.id FROM categories 
      JOIN post_category ON categories.id = post_category.cat_id
      JOIN post ON post.id = post_category.post_id
      WHERE post.id = '$row[id]'";
            $query = mysqli_query($conn, $sql);
            ?>
            <div class="ttl">Category</div>
            <div class="space">:</div>
            <div class="txt"><?php

            while ($out = mysqli_fetch_assoc($query)) {
                if ($id = $out['id']) {
                echo "<span style='color:#000000'>{$out['name']}&nbsp;&nbsp;</span>";
             }
              } ?></div>
          </li>
          <li class="clearfix">
            <div class="ttl">Description</div>
            <div class="space">:</div>
            <div class="txt"><?php echo $row['description'] ?></div>
          </li>
          <li class="clearfix">
            <div class="ttl">Created_date</div>
            <div class="space">:</div>
            <div class="txt"><?php echo $row['created_date'] ?></div>
          </li>
        </ul>
      </div>
      <div class="comment">
        <div>
          <form action="" method="post" class="clearfix">
            <div class="txt-cmn clearfix">
              <div class="comdiv">
                <input type="text" class="commentBox " placeholder="Place your comments here " name="cmn" value="<?php echo isset($cmn) ? $cmn : '' ?>">
                <span class="danger"><?php echo isset($errors['cmn']) ? $errors['cmn'] : ''; ?> </span>
              </div>
  
              <button type="submit" class="s" name="send">SEND</button>
            </div>

          </form>
        </div>
        <div class="more clearfix">
          <a href="#" class="comment-btn">more comment...</a>

          <ul class="clearfix comments" id="comment-list">
            <?php
            $pID = $_SESSION['post_id'];
            $pcm = "SELECT * FROM comment where pid=$pID";

            $res = mysqli_query($conn, $pcm);
            while ($rows = mysqli_fetch_assoc($res)) {
              $user = "SELECT * FROM user JOIN comment ON user.id=comment.uid WHERE comment.uid={$rows['uid']}";
              $cquery = mysqli_query($conn, $user);
              $cresult = mysqli_fetch_assoc($cquery);
            ?>
              <li class='clearfix'>
                <p><?php echo $cresult['name'] ?></p>
                <p style='float:left;color:#000000;'><?php echo $rows['body'] ?></p>
                <?php if (isset($_SESSION['user_id'])) {
                  if ($_SESSION['name']  == $cresult['name']) {
                ?>
                    <div style='float:right'> <a href='cmn-edit.php?id=<?php echo $rows['id'] ?>'><i class='fa fa-edit' style='font-size:18px;color:black;margin-right:20px'></i></a>
                      <a href='cmn-delete.php?id=<?php echo $rows['id'] ?>' style='float:right'><i class='fa fa-close' style='font-size:18px;color:red;'></i></a>
                    </div>


        </div>
        </li>
  <?php
                  }
                }
              }
  ?>

  </ul>


      </div>
    </div>
  </div>
</section>
<script>
  $(document).ready(function() {


    $(".comment-btn").click(function() {
      $("#comment-list").fadeToggle();
    });
  });
</script>
<?php
include "../common/footer.php";
?>