<?php
  include_once "../common/init.php";
  include "../common/db.php";
  $id = $_GET['id'];
  $sql = "SELECT * FROM post WHERE id=$id";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);


  if (isset($_POST['edit'])) {
    $errors = [];
    $image = $_POST['image'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($fileActualExt, $allowed)) {
      if ($fileError === 0) {
        if ($fileSize < 1000000) {
          $fileNameNew = uniqid(rand(), true) . "." . $fileActualExt;
          $fileDestionation = '../img/posts/' . $fileNameNew;
          move_uploaded_file($fileTmpName, $fileDestionation);
        }
      }
    } else {
      $fileDestionation = $row['image'];
    }

    if ($title == '') {
      $errors['title'] = "title  must be enter";
    }
    if ($description == '') {
      $errors['description'] = "description  must be enter";
    }
    if (count($errors) == 0) {
      $sql1 = "UPDATE post SET image='$fileDestionation',title='$title',description='$description' WHERE id=$id";
      $result = mysqli_query($conn, $sql1);
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
         <img src="<?php echo $row['image'] ?>" alt="" name="image" class="post-img">
         <input type="file" name="file" id="" class="post-input">
       </div>

       <label for="" class="post-ttl">Category</label>
       <div class="post-inputgp">
         <select name="catname[]" id="categories" multiple class="post-cat">
           <?php
              if (isset($_POST["catname"])) {
                $cat_post  = "DELETE FROM post_category WHERE post_id=$id";
                $del_result = mysqli_query($conn,$cat_post);
                foreach ($_POST['catname'] as $cat) {
                  $cat_post = "INSERT INTO post_category(post_id,cat_id) VALUES ('$id','$cat')";
                  $cat_result = mysqli_query($conn,$cat_post);
                }
              }

            $sql = "SELECT post_category.cat_id,categories.name,post.id FROM categories 
              JOIN post_category ON categories.id = post_category.cat_id
              JOIN post ON post.id = post_category.post_id
              WHERE post.id = '$id'";
            $q = mysqli_query($conn, $sql);
            while ($result = mysqli_fetch_array($q)) {
              $oldcat[] = $result['cat_id'];
            };
            $cat = "SELECT * FROM categories";
            $query = mysqli_query($conn, $cat);
            while ($out = mysqli_fetch_array($query)) {
            ?>

             <option value="<?php echo $out['id'] ?>" <?php echo in_array($out['id'], $oldcat) ? "selected" : "" ?>><?php echo $out['name'] ?></option>

           <?php
            }
            ?>
         </select>

       </div>

       <label for="" class="post-ttl">Title</label>
       <div class="post-inputgp">
         <input type="text" name="title" id="" class="post-input" value="<?php echo $row['title']; ?>" placeholder="Enter post title">
         <span class="danger"><?php echo isset($errors['title']) ? $errors['title'] : ''; ?> </span>
       </div>
       <label for="" class="post-ttl">Description</label>
       <div class="post-inputgp">
         <input type="text" name="description" id="" class="post-input" value="<?php echo $row['description']; ?>" placeholder="Enter post description">
         <span class="danger"><?php echo isset($errors['description']) ? $errors['description'] : ''; ?> </span>
       </div>
       <input type="submit" value="Update" name="edit" class="cmn-btn create">

     </Form>
   </div>
 </section>
 <script type="text/javascript" src="../js/jquery-2.2.4.min.js"></script>
 <script type="text/javascript" src="../js/jquery.multi-select.js"></script>
 <script type="text/javascript">
   $(function() {

     $('#categories').multiSelect({
       alert: '#categories',

     });

   });
 </script>
 <?php include "../common/footer.php"; ?>