<?php
    session_start();
    require_once('connect.php');//ติดต่อฐานข้อมูล
    date_default_timezone_set('Asia/Bangkok');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" href="../../../../favicon.ico"> -->
    <link rel="shortcut  icon" href="image/22.png">
    <title>Montita Farm</title>

    <!-- เรียกใช้ icon fontawesome -->
    <link rel="stylesheet"  href="bootstrap/css/brands.min.css" >
    <link rel="stylesheet"  href="bootstrap/css/solid.min.css" >
    <link rel="stylesheet"  href="bootstrap/css/regular.min.css" >
    <link rel="stylesheet"  href="bootstrap/css/fontawesome.min.css" >

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="bootstrapcss/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="index.php">Home</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <?php if(isset($_SESSION['user'])){ ?>
          <li class="nav-item active">
          </li>
          <?php } ?>
          <?php if(isset($_SESSION['user']) && ($_SESSION['user']['level']==1 || $_SESSION['user']['level']==2)){ ?>
            <li class="nav-item active">
              <a class="nav-link" href="index_admin.php">จัดการฐานข้อมูล</a>
            </li>
          <?php } ?>
        </ul>
        <!-- <form class="form-inline my-2 my-lg-0"> -->
        <?php   include_once('login.php'); ?>
        <!-- </form> -->
      </div>
    </nav>

    <main role="main">
          <img src="image/banner1.png" width="100%" height="100%">
    </main>
<br>
<br>
  </body>
</html>
