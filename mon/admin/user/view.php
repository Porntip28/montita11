<?php
$query = $db->prepare("SELECT * FROM user WHERE user_id=:id");
$query->execute(['id'=>$_GET['id']]);
$row = $query->fetch();

?>
<div class="container">
  <center><h3>ข้อมูลลูกค้า</h3></center>
  <!-- <div class="card border-primary">
    <div class="card-body"> -->
<!-- <div class="row">
  <center>
  <div class="col-xs-12"><img src="images/<?=$row["images"]?>" alt="" width="200" /></div>
</div> -->
<br>
<div class="row justify-content-center">
  <div class="col-4" >รหัสลูกค้า</div>
  <div class="col-4">: <?=$row["user_id"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >ชื่อ</div>
  <div class="col-4">: <?=$row["name"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4">นามสกุล</div>
  <div class="col-4">: <?=$row["surname"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4">ที่อยู่</div>
  <div class="col-4">: <?=$row["address"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4">เบอร์ติดต่อ</div>
  <div class="col-4">: <?=$row["tel"]?></div>
</div>
<hr>
<div class="row justify-content-center">
  <div class="col-4">ชื่อผู้ใช้</div>
  <div class="col-4">: <?=$row["username"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4">Password</div>
  <div class="col-4">: <?=$row["password"]?></div>
</div>


<a  onclick="window.location.href=document.referrer;">Back</a>
</div>
</div>
</div>
