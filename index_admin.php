<?php
// error_reporting(0);
    session_start();
    require 'connect.php';//ติดต่อฐานข้อมูล
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="bootstrap/js/bootstrap.min.js"></script>

    <link rel="shortcut  icon" href="image/title3.png">
    <title>Montita Farm</title>

    <!-- เรียกใช้ icon fontawesome -->
    <link rel="stylesheet"  href="bootstrap/css/brands.min.css" >
    <link rel="stylesheet"  href="bootstrap/css/solid.min.css" >
    <link rel="stylesheet"  href="bootstrap/css/regular.min.css" >
    <link rel="stylesheet"  href="bootstrap/css/fontawesome.min.css" >
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- การแบ่งหน้า -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <script src="datatables/js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="datatables/js/jquery.dataTables.min.js"></script>
    <script src="datatables/js/dataTables.bootstrap.min.js"></script>
    <link href="datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script >
      $(document).ready(function() {
      $('#mydata').dataTable();
    } );
    </script>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

          <style>
      @import url('https://fonts.googleapis.com/css?family=Kanit');
      *,h1,h2,h3,h4,h5,h6{
        font-family: 'Kanit', sans-serif;
        font-size: 18px;
      }
      .list-group-item {
    position: relative;
    display: block;
    padding: .75rem 1.25rem;
    margin-bottom: -1px;
    background-color: #212529;
    border: 1px solid rgba(0,0,0,.125);
      }
      .list-group-item-action {
    width: 100%;
    color: #a2aab1;
    text-align: inherit;
}

      
      </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark"    style="
    padding-top: 10px;
    padding-bottom: 10px;">



    <img src="image/22.png" class="img-fluid" width="100" height="100">


      
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
          </li>

        <?php if(isset($_SESSION['user']) && ($_SESSION['user']['level']==1 || $_SESSION['user']['level']==2)){ ?>
            <li class="nav-item active">
              <a class="nav-link" href="index_admin.php">ระบบจัดการ ฟาร์มหมูมณฑิตา</a>
            </li>
        <?php } ?>
        </ul>
        <!-- <form class="form-inline my-2 my-lg-0"> -->
        <?php   include_once('login.php'); ?>

      </div>
    </nav>

  

<br>
<br>




        <br>
        <!-- Example row of columns -->
        <div class="row"  style="margin-top:30;"  style="
    padding-top: 25px;
">
          <div class="col-sm-2">
            <div class="list-group border-success">
              <a href="?file=employee/index" class="list-group-item list-group-item-action" style="
    padding-top: 30px;">จัดการข้อมูลพนักงาน</a>
              <a href="?file=user/index" class="list-group-item list-group-item-action">จัดการข้อมูลลูกค้า</a>
              <a href="?file=moo/index" class="list-group-item list-group-item-action">จัดการข้อมูลหมู</a>
              <a href="?file=pill/index" class="list-group-item list-group-item-action">จัดการข้อมูลยา</a>
              <a href="?file=manage/index" class="list-group-item list-group-item-action">จัดการข้อมูลการรักษา</a>
              <a href="?file=food/index" class="list-group-item list-group-item-action">จัดการข้อมูลอาหาร</a>
              <a href="?file=material/index" class="list-group-item list-group-item-action">จัดการข้อมูลอุปกรณ์</a>
              <a href="?file=hybridize/index" class="list-group-item list-group-item-action">จัดการข้อมูลผสมพันธุ์</a>
              <a href="?file=salary/index" class="list-group-item list-group-item-action">ข้อมูลค่าตอบแทน</a>
              <a href="?file=salling/index" class="list-group-item list-group-item-action">ข้อมูลการขาย</a>
            </div>
          </div>

          <div class="col-8" style="margin-center" font-size: 18px; > 
            
         
              <div class="card-body">
                  <?php
                  if(isset($_GET['file'])){
                     $app_file = 'admin/'. $_GET['file'].'.php'; //$app_fileคือการกำหนดตัวแปรเพื่อรับไฟล์
                      if(is_file($app_file)){
                        include_once($app_file);
                      }else{
                        echo 'ไม่พบเนื้อหา 404';   //กรณีพาทไม่ตรงหรือไม่มีไฟล์นั้นจริง
                      }
                  }
                  else{
                    // include_once('index.php');
                    echo '<img src="image/banner1.png"" width="100%" height="100%">';
                  }
                  ?>
                </div>
              </div>
        </div>
      </div>
    </main>
<br>
<br>
    <footer class="container">
      <center>
        <hr>
      <p> @ Montita Farm ระบบจัดการ ฟาร์มหมูมณฑิตา</p></center>
    </footer>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-slim.min.js"><\/script>')</script>
  </body>
</html>
