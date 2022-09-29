<?php include "header.php"; 
session_start();
?>
<section class="sec-header ">
  <div class="linner clearfix">
    <header class="header-mv">
      <a href="../index.php">BLOG</a>
    </header>
    <nav class="gnav">
      <ul class="clearfix">
        <li><a href="../index.php" >Home</a></li>
        <li><a href="../categories/create.php" >Category</a></li>
        <li><a href="../post/show.php">Post</a></li>
        <li>  
        <div class="dropdown">
        <span><i class="fa fa-user-o" style="font-size:24px,"></i> &nbsp;
        <?php if(isset($_SESSION['name'])){ echo $_SESSION['name']; } ?></span>
         <div class="dropdown-content">
          <ul>
            <li class="droplist"><a href="../login/login.php">Login</a></li>
            <li> <a href="../login/logout.php">Logout</a></li>
          </ul>
         </div>
         </div>
        </li>
      </ul>
    </nav>
    </div>
  </section>
  <?php include "footer.php"; ?>