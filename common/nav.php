<?php include "header.php";
include_once "init.php";


?>

<section class="sec-header ">
  <div class="linner clearfix">

    <header class="header-mv">
      <a href="../index.php">BLOG</a>
    </header>
    <?php if (empty($_SESSION['name'])) : ?>
      <nav class="gnav">
        <ul class="clearfix">
          <li><a href="../categories/create.php">Category</a></li>
          <li><a href="../post/show.php">Post</a></li>
          <li>
            <div class="dropdown">
              <span><i class="fa fa-user-o" style="font-size:24px,"></i> &nbsp;</span>
              <div class="dropdown-content">
                <ul>
                  <li class="droplist"><a href="../login/login.php">Login</a></li>

                </ul>
              </div>
            </div>
          </li>
        </ul>
      </nav>
    <?php else : ?>

      <nav class="gnav">
        <ul class="clearfix">
          <li><a href="../categories/create.php">Category</a></li>
          <li><a href="../post/show.php">Post</a></li>
          <li>
            <div class="dropdown">
              <span><i class="fa fa-user-o" style="font-size:24px,"></i> &nbsp;
                <?php
                if (!empty($_SESSION['name'])) {
                  echo $_SESSION['name'];
                } else {
                  $_SESSION['name'] = "";
                }
                ?>
              </span>
              <div class="dropdown-content">
                <ul>
                  <li class="droplist"><a href="../login/logout.php">Logout</a></li>

                </ul>
              </div>
            </div>
          </li>
        </ul>
      </nav>
    <?php endif; ?>
  </div>
</section>


<?php include "footer.php" ?>