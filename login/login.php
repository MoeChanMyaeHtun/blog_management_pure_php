<?php
include "../common/db.php";
include_once "../common/init.php";

if (isset($_POST['submit'])) {
  $errors = [];
  $email = $_POST['email'];
  $pw = $_POST['pw'];
  if (!$email) {
    $errors['email'] = 'Email is required.';
  }

  if (!$pw) {
    $errors['pw'] = 'Password is required';
  }
  if ($pw != $_SESSION['password']) {
    $errors['pw'] =  'Password is wrong';
  }
  $query = "SELECT * FROM user";
  $result = mysqli_query($conn, $query);
  while ($out = mysqli_fetch_array($result)) {
    if ($out) {
      if (password_verify($pw, $out['password'])) {
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $out['name'];
        $_SESSION['user_id'] = $out['id'];

        header("Location:../post/show.php");
      }
    }
  }
}

?>
<?php include "../common/header.php" ?>
<section class="sec-login">
  <div class="linner">
    <div class="login-box">
      <h1 class="cmn-ttl">Sign In</h1>

      <form action="" class="login-form" method="POST">
        <div class="formbox">
          <input type="email" placeholder="Enter your email" name="email" class="form-input" value="<?php echo isset($email) ? $email : '' ?>">
          <span class="danger"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?> </span>
        </div>

        <div class="formbox">
          <input type="password" placeholder="Enter your password" name="pw" class="form-input" value="<?php echo isset($pw) ? $pw : '' ?>">
          <span class="danger"><?php echo isset($errors['pw']) ? $errors['pw'] : ''; ?> </span>
        </div>
        <input type="submit" value="Sign In" class="cmn-btn" name="submit">

      </form>
      <div class="txt-box clearfix">
        <a href="forgot.php" class="forgot">Forgot password</a>
        <a href="../register/register.php" class="create">Create new account</a>
      </div>

    </div>
  </div>
</section>



<?php include "../common/footer.php" ?>