
<?php
include "../common/db.php";

$id = $_GET['id'];
$sql = "SELECT * FROM post WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


if (isset($_POST['edit'])) {
  $errors = [];
  // $image = $_POST['image'];
  $title = $_POST['title'];
  $description = $_POST['description'];
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

  if ($title == '') {
    $errors['title'] = "title  must be enter";
  }
  if ($description == '') {
    $errors['description'] = "description  must be enter";
  }

  if (count($errors) == 0) {
  $sql = "UPDATE post SET title='$title',description='$description', image= '$fileDestionation' WHERE id=$id";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    header("Location:show.php");
  }
  }
}
?>


<?php 
include "../common/header.php";
include "../common/nav.php";
?>
<section class="post-mv">
  <div class="linner">
    <h2 class="cmn-ttl">Post Edit</h2>
    <Form method="POST" class="post-form" enctype="multipart/form-data">
      <label for="" class="post-ttl">Image</label>
      <div class="post-inputgp">
     <img src="<?php echo $row['image']?>" alt="" name="image" class="post-img">
     <input type="file" name="file" id="" class="post-input" >
      </div>

      <label for="" class="post-ttl">Category</label>
      <div class="post-inputgp">
      <select name="catname[]" class="post-input" multiple>
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
      <input type="text" name="title" id="" class="post-input" value="<?php echo $row['title'];?>" placeholder="Enter post title">
          <span class="danger"><?php echo isset($errors['title']) ? $errors['title'] : ''; ?> </span>
          </div>
      <label for="" class="post-ttl">Description</label>
      <div class="post-inputgp">
      <input type="text" name="description" id="" class="post-input" value="<?php echo $row['description']; ?>" placeholder="Enter post description">
          <span class="danger"><?php echo isset($errors['description']) ? $errors['description'] : ''; ?> </span>
      </div>

      <input type="reset" value="Clear" name="reset" class="cmn-btn clear">
      <input type="submit" value="Update" name="edit" class="cmn-btn create">
      
    </Form>
  </div>
</section>

<?php include "../common/footer.php";?>