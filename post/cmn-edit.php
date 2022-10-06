<?php 
include "../common/db.php";
include_once "../common/init.php";
$id = $_GET['id'];
$pid = $_SESSION['post_id'];
$cmn_id = $_GET['id'];
$sqls = "SELECT * FROM comment WHERE id=$cmn_id";
$results = mysqli_query($conn, $sqls);
$rows = mysqli_fetch_assoc($results);

if (isset($_POST['edit'])) {
  $errors = [];
  $cmnid = $_POST['id'];
  $cmn = $_POST['cmn'];
  if ($cmn== '') {
    $errors['cmn'] = "comment must be enter";
  }
  if (count($errors) == 0) {
  $sql = "UPDATE comment SET body='$cmn' WHERE id=$cmnid";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    header("Location: detail.php?id=$pid");
  }
}
}
if($rows['pid']!= $_SESSION['post_id']){
  header("Location: detail.php?id=$pid");
}
?>

<?php 
include "../common/header.php";
include_once "../common/nav.php";
?>
<section class="post-detail">
  <div class="linner">
    <div class="detailbox clearfix">
     
      <div class="comment">
        <div>
        <form action="" method="post" class="clearfix">
        <div class="txt-cmn clearfix">
        <input type="hidden" name="id" value="<?php echo $cmn_id ?>">
      <input type="text" class="upcmn commentBox " placeholder="Place your comments here "  name="cmn" value="<?php echo $rows['body']?>">
      <button type="submit" class="s" name="edit">Update</button>
      </div>
     
        </form>
        </div>
      
    </div>
  </div>
</section>
<!-- <script>
$(document).ready(function() {

$(".comment-btn").click(function(){
  $("#comment-list").fadeToggle();
  });
});
  </script> -->
<?php 
include "../common/footer.php";
?>