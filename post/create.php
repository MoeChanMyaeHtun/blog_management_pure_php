<?php
      include "../common/db.php";
      include_once '../common/init.php';
      if(isset($_POST['create'])){
        $errors = [];
        $file = $_FILES['file'];
                $fileName= $_FILES['file']['name'];
                $fileTmpName= $_FILES['file']['tmp_name'];
                $fileSize= $_FILES['file']['size'];
                $fileError= $_FILES['file']['error'];
                $fileType= $_FILES['file']['type'];

                $fileExt = explode('.', $fileName);
                $fileActualExt = strtolower(end($fileExt));
                $allowed = array('jpg','jpeg','png','gif');
                if (in_array($fileActualExt, $allowed)){
                    if($fileError === 0){
                        if($fileSize < 1000000){
                            $fileNameNew = uniqid(rand(),true).".".$fileActualExt;
                            $fileDestionation = '../img/posts/'.$fileNameNew;
                            move_uploaded_file($fileTmpName,$fileDestionation);
                        }
                        else{
                            echo "Your file is too big!";
                        }
                    }
                        else{
                            echo "There was an error uploading your file!";
                        }
                    }
                else{
                    echo"You cannot upload files of this type!";
                }
        $title = $_POST['title'];
        $description = $_POST['description'];
        $dt = new DateTime("now", new DateTimeZone('Asia/Yangon'));
        $created_date = $dt->format('Y.m.d , h:i:s');
        $updated_date = $dt->format('Y.m.d , h:i:s');
        $user_id = $_SESSION['user_id'];       
        if ($title == ''){
          $errors['title'] = "Post title must be empty";
        }
        if ($description == ''){
          $errors['description'] = "Post description must be empty";
        }

        if (count($errors) == 0) {
          $sql = "INSERT INTO post (`image`,`title`,`description`,`created_date`,`updated_date`,`user_id`)VALUES('$fileDestionation','$title','$description','$created_date','$updated_date','$user_id')";
          $result = mysqli_query($conn, $sql);
          if ($result) {
            header("location:show.php");
          }
        }

        if(isset($_POST["catname"])) { 
          foreach ($_POST['catname'] as $cat) {
              $sl = "select last_insert_id()";
              $query = mysqli_query($conn,$sl);
              $row = mysqli_fetch_assoc($query);
              $li = $row['last_insert_id()'];
              $cat_post = "INSERT INTO post_category (post_id,cat_id) VALUES ('$li','$cat')";
              if(mysqli_query($conn,$cat_post)){
                  echo "<p>post_category success</p>";
              }else{
                  echo "Query Fail : ".mysqli_error($conn);
              }
             }
             }
      }
      
?>
<?php include "../common/header.php";
    include "../common/nav.php"
?>

<section class="post-mv">
  <div class="linner">
    <h2 class="cmn-ttl">Post Create</h2>
    <Form method="POST" class="post-form" enctype="multipart/form-data">
      <label for="" class="post-ttl">Image</label>
      <div class="post-inputgp">
      <input type="file" name="file" id="" class="post-input" >
      </div>

      <label for="" class="post-ttl">Category</label>
      <div class="post-inputgp">
      <select name="catname[]" class="post-input" id="categories"  multiple>
      <?php 
         $cat = "SELECT * FROM categories";
         $query = mysqli_query($conn,$cat);
         while($out = mysqli_fetch_array($query))
         {
         echo "<option value='{$out['id']}'>{$out['name']}</option>";
         }
      ?> 
</select>
      </div>
      <label for="" class="post-ttl">Title</label>
      <div class="post-inputgp">
      <input type="text" name="title" id="" class="post-input" value="<?php echo isset($title) ? $title : '' ?>" placeholder="Enter post title">
          <span class="danger"><?php echo isset($errors['title']) ? $errors['title'] : ''; ?> </span>
          </div>
      <label for="" class="post-ttl">Description</label>
      <div class="post-inputgp">
      <input type="text" name="description" id="" class="post-input" value="<?php echo isset($description) ? $description : '' ?>" placeholder="Enter post description">
          <span class="danger"><?php echo isset($errors['description']) ? $errors['description'] : ''; ?> </span>
      </div>
        <div class="clearfix">
      <input type="reset" value="Clear" name="reset" class="cmn-btn clear">
      <input type="submit" value="Create" name="create" class="cmn-btn create">
        </div>
    </Form>
  </div>
</section>
<script type="text/javascript" src="../js/jquery-2.2.4.min.js"></script>
    <script type="text/javascript" src="../js/jquery.multi-select.js"></script>
    <script type="text/javascript">
    $(function(){
      
        $('#categories').multiSelect({
            noneText: 'All categories' ,
          
        });
      
    });
    </script>

<?php include "../common/footer.php"?>