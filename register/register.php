<?php 
include "../common/db.php" ;

if(isset($_POST['submit']))
{
  $errors = [];
  $user_name = $_POST['name'];
  $email = $_POST['email'];
  $pw_hash = password_hash($_POST['pw'],PASSWORD_DEFAULT);
  $pw = $_POST['pw'];
  $conf_pw = $_POST['conf-pw'];
  $dt = new DateTime("now", new DateTimeZone('Asia/Yangon')); 
  $created_date = $dt->format('Y.m.d , h:i:s');
  $updated_date = $dt->format('Y.m.d , h:i:s');

  if($user_name==''){
    $errors['name']='User name must be enter';
  }

  if($email==''){
    $errors['email']='user email must be empty';
  }

  if($pw==''){
    $errors['pw']='User password must be enter';
  }

  if ($conf_pw == '') {
    $errors['conf-pw'] = 'User confirm-password  must be enter';
    } else {
    if ($pw != $conf_pw) {
        $errors['pw'] = 'Password do not match';
    }
}
  if(count($errors) == 0){
  $sql = "INSERT INTO user (`name`,`email`,`password`,`created_date`,`updated_date`)values('$user_name','$email','$pw_hash','$created_date','$updated_date')";
  $result = mysqli_query($conn , $sql);
  if($result){
    header("location:../login/login.php");
  }
  }
}

?>
<?php
 include "../common/header.php" 
 ?>
  <section class="sec-create">
  <div class="linner">
      <h1 class="cmn-ttl">Create Account</h1>
      <form action="" class="form-create" method="POST">

      <div class="box clearfix">
        <label for="" class="form-ttl">Name</label>
        <div class="input-gp">
        <input type="text" placeholder="Enter your name" name="name" class="form-input" value="<?php echo isset($user_name)?$user_name:'' ?>">
        <span class="danger"><?php echo isset($errors['name']) ? $errors['name']:''; ?> </span>
        </div>
      </div>

        <div class="box clearfix">
        <label for="" class="form-ttl">Email</label>
        <div class="input-gp">
        <input type="email" placeholder="Enter your email" name="email" class="form-input" value="<?php echo isset($email)?$email:'' ?>">
        <span class="danger"><?php echo isset($errors['email']) ? $errors['email']:''; ?> </span>
        </div>
        </div>

        <div class="box clearfix">
        <label for="" class="form-ttl">Password</label>
        <div class="input-gp">
        <input type="password" placeholder="Enter your password" name="pw"  class="form-input" >
        <span class="danger"><?php echo isset($errors['pw']) ? $errors['pw']:''; ?> </span>
        </div>
        </div>

        <div class="box clearfix">
        <label for="" class="form-ttl">Confirm Password</label>
        <div class="input-gp">
        <input type="password" placeholder="Enter your confirm password" name="conf-pw" onpaste="return false;" class="form-input" value="<?php echo isset($conf_pw)?$conf_pw:'' ?>">
        <span class="danger"><?php echo isset($errors['conf-pw']) ? $errors['conf-pw']:''; ?> </span>
        </div>
        </div>

        <div class="box clearfix">
          <label for="" class="form-ttl"></label>
          <input type="submit" value="Submit" class="cmn-btn" name="submit">
        </div>
      </form>
  </div>
  </section>
  
<?php include "../common/footer.php" ?>