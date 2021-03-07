<?php
$query = $db->prepare("SELECT * FROM suplier WHERE sup_id=:id");
$query->execute(['id'=>$_GET['id']]);
$row = $query->fetch();

?>
<div class="container">
  <center><h3>ข้อมูลร้านค้า</h3></center>
  <!-- <div class="card border-primary">
    <div class="card-body"> -->
<!-- <div class="row">
  <center>
  <div class="col-xs-12"><img src="images/<?=$row["images"]?>" alt="" width="200" /></div>
</div> -->
<br>
<div class="row justify-content-center">
  <div class="col-4" >รหัสร้านค้า</div>
  <div class="col-4">: <?=$row["sup_id"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4" >ชื่อ</div>
  <div class="col-4">: <?=$row["sup_name"]?></div>
</div>

<div class="row justify-content-center">
  <div class="col-4">ที่อยู่</div>
  <div class="col-4">: <?=$row["sup_address"]?></div>
</div>
<div class="row justify-content-center">
  <div class="col-4">เบอร์ติดต่อ</div>
  <div class="col-4">: <?=$row["sup_tel"]?></div>
</div>
<hr>
<a  onclick="window.location.href=document.referrer;">Back</a>
</div>
</div>
</div>
